<?php

namespace App\Http\Controllers\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Tag;
use App\Models\Dashboard\City;
use App\Models\Dashboard\Agent;
use App\Models\Dashboard\Comment;
use App\Models\Dashboard\Contact;
use App\Models\Dashboard\Campaign;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\LeadStoreRequest;
use Symfony\Component\HttpFoundation\Response;

class LeadsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('lead_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $query = Contact::orderBy('name')->orderBy('priority');
        $query->where('is_lead' , "yes");
        if ($search = request()->search)
            $query->where('name' , 'like' , "%$search%")
            ->orWhere('email' , 'like' , "$search%")
            ->orWhere('mobile' , 'like' , "%$search%")
            ->orWhere('country' , 'like' , "%$search%")
            ->orWhere('city' , 'like' , "%$search%")
            ->orWhere('preferred_languages' , 'like' , "%$search%")
            //->orWhere('campaign_id' , 'like' , "%$search%")
            ;
        if(auth()->user()->isAgent){
            $items = $query
            ->whereRelation('agents', 'id', auth()->user()->id)
            ->paginate(100)->appends([
                'search' => $search
            ]);
        }else{
            $items = $query->paginate(100)->appends([
                'search' => $search,
            ]);
        }

        $local_title = __('Leads');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('fullwidth.leads.index', compact('search','local_title', 'breadcrumbs', 'items'));
    }

    public function create()
    {
        abort_if(Gate::denies('lead_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $agents = $this->getAgents();
        $cities = City::orderBy('name')->pluck('name', 'id')->all();
        $resident    = $this->getResident();
        $looking_for = $this->getLookingFor();
        $client_type = $this->getClientType();
        $campaigns = Campaign::pluck('name' , 'id')->prepend(__('-Choose') , '');
        $tags = $this->getTags('interests');
        $languages = $this->getTags('languages');
        $Financial = $this->getFinancing();
        $leadPriority = $this->getPriority();
        $LeadQuality = $this->getLeadQuality();
        $countries = array_merge([''=>'- Choose Country'], $this->countries);
        // $countries = Country::paginate(25);
        $local_title = __('Add Lead');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Leads'), 'url' => route('dashboard.leads.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('fullwidth.leads.create', compact( 'cities', 'client_type', 'looking_for','resident', 'Financial', 'languages', 'countries', 'LeadQuality' , 'leadPriority', 'tags' , 'agents' , 'campaigns' , 'local_title', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeadStoreRequest $request)
    {
        $tagArray = $this->createTags($request->tags);
        $languages = $this->createTags($request->language_tags , 'languages');
        $lead = Contact::create($request->all());
        $lead->tags()->sync(array_merge($tagArray , $languages));
        $lead->agents()->sync($request->agents);

        $cities = $this->createCities($request->cities);
        $lead->cities()->sync($cities);

        if($request->content){
            $comment = Comment::create([
                'content'      => $request->content,
                'publish_date' => date('Y-m-d H:i:s'),
                'author'       => auth()->user()->id,
                'contact_id'   => $lead->id
            ]);
        }

        return redirect()->route('dashboard.leads.index')->with(['message' => 'Created']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $lead)
    {
        abort_if(Gate::denies('lead_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $langusages_array = Tag::whereRelation('contacts', 'id', $lead->id)->where('type' , 'languages')->get();
        $interest_tags = Tag::whereRelation('contacts', 'id', $lead->id)->where('type' , 'interests')->get();
        isset($countries[$lead->country]) ? $country = $countries[$lead->country] : $country = '';
        
        $local_title = $lead->name;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Contacts'), 'url' => route('dashboard.leads.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('fullwidth.leads.show', compact( 'interest_tags', 'langusages_array' , 'country', 'lead', 'local_title', 'breadcrumbs'));
    }

    public function edit(Contact $lead)
    {
        abort_if((Gate::denies('lead_edit') || !$lead->allowEdit), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cities = City::orderBy('name')->pluck('name', 'id')->all();
        $agents = $this->getAgents();
        $Financial = $this->getFinancing();
        $campaigns = Campaign::pluck('name' , 'id')->prepend(__('-Choose') , '');
        $tags = $this->getTags('interests');
        $langusages_array = Tag::whereRelation('contacts', 'id', $lead->id)->where('type' , 'languages')->get();
        $languages = $this->getTags('languages');

        $countries = array_merge([''=>'- Choose Country'], $this->countries);
        // $countries = countries();
        $leadPriority = $this->getPriority();
        $LeadQuality = $this->getLeadQuality();
        $resident    = $this->getResident();
        $looking_for = $this->getLookingFor();
        $client_type = $this->getClientType();

        $local_title = sprintf('%s: %s', __('Edit Lead'), $lead->name);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Contacts'), 'url' => route('dashboard.leads.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.leads.show', ['lead' => $lead])];
        $breadcrumbs[] = ['label' => __('Edit')];

        return view($this->template . '.leads.edit', compact( 'cities', 'resident', 'looking_for', 'client_type', 'Financial','langusages_array', 'languages', 'countries', 'LeadQuality', 'leadPriority', 'tags', 'agents' , 'campaigns' ,'lead','local_title', 'breadcrumbs'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(LeadStoreRequest $request, Contact $lead)
    {
        
        $tagArray = $this->createTags($request->tags);
        $languages = $this->createTags($request->language_tags , 'languages');

        if($request->content)
        {
            $comment = Comment::create([
                'content'      => $request->content,
                'publish_date' => date('Y-m-d H:i:s'),
                'author'       => auth()->user()->id,
                'contact_id'   => $lead->id
            ]);
        }
        
        $lead->update($request->all());
        $lead->update(['interested' => $request->has('interested') ? $request->get('interested') : 0]);
        $lead->tags()->sync(array_merge($tagArray , $languages));
        $lead->agents()->sync($request->agents);

        $cities = $this->createCities($request->cities);
        $lead->cities()->sync($cities);

        if($request->contentSave){
            return redirect()->route('dashboard.leads.edit', $lead->id)->with(['info' => __('Updated')]);
        }else{
            return redirect()->route('dashboard.leads.index')->with(['info' => __('Updated')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $lead)
    {
        abort_if(Gate::denies('lead_delete') || !$lead->allowDelete, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lead->delete();

        return back()->with(['danger' => __('Deleted')]);
    }

    public function convert(Contact $contact){
        $flag = false;
        abort_if(Gate::denies('contact_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $converted = 1;
        // $contact = $lead;
        $cities = City::orderBy('name')->pluck('name', 'id')->all();
        $languages = $this->getTags('languages');
        $agents = Agent::pluck('name' , 'id')->prepend(__('-Choose') , '');
        $campaigns = Campaign::pluck('name' , 'id')->prepend(__('-Choose') , '');
        $tags = $this->getTags('interests');
        $leadPriority = $this->getPriority();
        $LeadQuality = $this->getLeadQuality();
        $Financial = $this->getFinancing();
        $countries = $this->countries;
        $resident    = $this->getResident();
        $looking_for = $this->getLookingFor();
        $client_type = $this->getClientType();

        $local_title = __('Convert Lead to Client');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Contacts'), 'url' => route('dashboard.leads.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.leads.show', ['lead' => $contact])];
        $breadcrumbs[] = ['label' => __('Convert')];
        return view($this->template . '.leads.convert', compact( 'resident', 'looking_for', 'client_type','languages', 'flag', 'converted', 'Financial', 'countries', 'LeadQuality', 'leadPriority', 'tags', 'agents' , 'campaigns' ,'contact','local_title', 'breadcrumbs', 'cities'));
    }
}
