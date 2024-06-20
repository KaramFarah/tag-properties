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
use App\Http\Requests\ClientStoreRequest;
use Symfony\Component\HttpFoundation\Response;

class ContactsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $items = Contact::where('is_lead', 'no')->latest()->get();
        // $search = request()->input('serach');

        $query= Contact::orderBy('name')->orderBy('priority');
        $query->where('is_lead' , "no");
        if ($search = request()->search)
        $query->where('name' , 'like' , "%$search%")
              ->orWhere('email' , 'like' , "$search%")
              ->orWhere('mobile' , 'like' , "%$search%")
              ->orWhere('country' , 'like' , "%$search%")
              ->orWhere('city' , 'like' , "%$search%")
              ->orWhere('preferred_languages' , 'like' , "%$search%")
              ->orWhere('birthday' , 'like' , "%$search%")
              ->orWhere('landline' , 'like' , "%$search%")
              ->orWhere('address' , 'like' , "%$search%")
              ->orWhere('occupation' , 'like' , "%$search%")
              ->orWhere('company' , 'like' , "%$search%")
              ->orWhere('passport' , 'like' , "%$search%")
              ->orWhere('passport_expiry' , 'like' , "%$search%")
              ->orWhere('financing' , 'like' , "%$search%")
              ->orWhere('expected_purchase_time' , 'like' , "%$search%")
            //   ->orWhere('campaign_id' , 'like' , "%$search%")
              ;
              if(auth()->user()->isAgent){
                $items = $query
                ->whereRelation('agents', 'id', auth()->user()->id)
                ->paginate(100)->appends([
                    'search' => $search,
                ]);
                // ->where(agents->where('id' , 3))
                // ->filter(function($value)
                // { 
                //     return ($this->getOwnerId($value) == auth()->user()->id);
                // });
            }else{
                $items = $query->paginate(100)->appends([
                    'search' => $search,
                ]);
            }
        
        $local_title = __('Clients');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template.'.contacts.index', compact('search','local_title', 'breadcrumbs', 'items'));
    }

    public function create(Contact $item = null)
    {
        abort_if(Gate::denies('contact_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $agents = $this->getAgents();
        $cities = City::orderBy('name')->pluck('name', 'id')->all();
        // $agents = Agent::pluck('name' , 'id')->prepend(__('-Choose') , '');
        $campaigns = Campaign::pluck('name' , 'id')->prepend(__('-Choose') , '');
        $tags = $this->getTags('interests');
        $languages = $this->getTags('languages');
        $leadPriority = $this->getPriority();
        $LeadQuality = $this->getLeadQuality();
        $Financial = $this->getFinancing();
        $countries = array_merge([''=>'- Choose Country'], $this->countries);
        $resident    = $this->getResident();
        $looking_for = $this->getLookingFor();
        $client_type = $this->getClientType();
        $local_title = __('Add Client');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Clients'), 'url' => route('dashboard.contacts.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.contacts.create', compact( 'cities', 'client_type', 'looking_for', 'resident','languages', 'item', 'countries', 'Financial', 'LeadQuality', 'leadPriority', 'tags' , 'agents' , 'campaigns' , 'local_title', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientStoreRequest $request)
    {
        $tagArray = $this->createTags($request->tags);
        $languages = $this->createTags($request->language_tags , 'languages');

        $client = Contact::create($request->all());
        if ($request->hasFile('photos')){
            foreach($request->file('photos') as $_file){
                $client->addMedia($_file)->toMediaCollection('passport-photos', 'media');
                $client->save();
            }
        }
        $client->tags()->sync(array_merge($tagArray , $languages));
        $client->agents()->sync($request->agents);

        $cities = $this->createCities($request->cities);
        $client->cities()->sync($cities);

        if($request->content){
            $comment = Comment::create([
                'content'      => $request->content,
                'publish_date' => date('Y-m-d H:i:s'),
                'author'       => auth()->user()->id,
                'contact_id'   => $client->id
            ]);
        }
        return redirect()->route('dashboard.contacts.index')->with(['message' => 'Created']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        abort_if(Gate::denies('contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $country = $contact->country ? $this->countries[$contact->country] : '';
        $langusages_array = Tag::whereRelation('contacts', 'id', $contact->id)->where('type' , 'languages')->get();
        $interest_tags = Tag::whereRelation('contacts', 'id', $contact->id)->where('type' , 'interests')->get();
        $local_title = $contact->name;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Contacts'), 'url' => route('dashboard.contacts.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.contacts.show', compact( 'interest_tags', 'langusages_array', 'country', 'contact', 'local_title', 'breadcrumbs'));
    }

    public function edit(Contact $contact)
    {
        abort_if(Gate::denies('contact_edit') || !$contact->allowEdit, Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cities = City::orderBy('name')->pluck('name', 'id')->all();
        $langusages_array = Tag::whereRelation('contacts', 'id', $contact->id)->where('type' , 'languages')->get();
        $agents = $this->getAgents();
        $campaigns = Campaign::pluck('name' , 'id')->prepend(__('-Choose') , '');
        $tags = $this->getTags('interests');
        $languages = $this->getTags('languages');
        $leadPriority = $this->getPriority();
        $LeadQuality = $this->getLeadQuality();
        $Financial = $this->getFinancing();
        $countries = array_merge([''=>'- Choose Country'], $this->countries);
        $resident    = $this->getResident();
        $looking_for = $this->getLookingFor();
        $client_type = $this->getClientType();
        $local_title = sprintf('%s: %s', __('Edit Client'), $contact->name);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Contacts'), 'url' => route('dashboard.contacts.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.contacts.show', ['contact' => $contact])];
        $breadcrumbs[] = ['label' => __('Edit')];

        return view($this->template . '.contacts.edit', compact( 'cities', 'client_type', 'looking_for', 'resident', 'langusages_array', 'languages','countries', 'Financial', 'LeadQuality', 'leadPriority', 'tags' , 'agents' , 'campaigns' ,'contact','local_title', 'breadcrumbs'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ClientStoreRequest $request, Contact $contact)
    {
        $tagArray = $this->createTags($request->tags);
        $languages = $this->createTags($request->language_tags , 'languages');
        $contact->update($request->all());
        $contact->update(['interested' => !$request->get('interested') ? 0 : 1]);
        if ($request->hasFile('photos')){
            $contact->media()->delete();
            foreach($request->file('photos') as $_file){
                $contact->addMedia($_file)->toMediaCollection('passport-photos', 'media');
                $contact->save();
            }
        }
        $contact->tags()->sync(array_merge($tagArray , $languages));
        $contact->agents()->sync($request->agents);

        $cities = $this->createCities($request->cities);
        $contact->cities()->sync($cities);

        if($request->content)
        {
            $comment = Comment::create([
                'content'      => $request->content,
                'publish_date' => date('Y-m-d H:i:s'),
                'author'       => auth()->user()->id,
                'contact_id'   => $contact->id
            ]);
        }
        if($request->contentSave){
            return redirect()->route('dashboard.contacts.edit', $lead->id)->with(['info' => __('Updated')]);
        }else{
            return redirect()->route('dashboard.contacts.index')->with(['info' => __('Updated')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        abort_if(Gate::denies('contact_delete') || !$contact->alowDelete, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact->delete();

        return back()->with(['danger' => __('Deleted')]);
    }
}
