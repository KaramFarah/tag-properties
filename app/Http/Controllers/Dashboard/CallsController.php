<?php

namespace App\Http\Controllers\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Tag;
use App\Models\Dashboard\Call;
use App\Models\Dashboard\Agent;
use App\Models\Dashboard\Comment;
use App\Models\Dashboard\Contact;
use App\Models\Dashboard\Campaign;
use App\Http\Requests\CallStoreRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class CallsController extends BaseController
{
    public function index()
    {
        abort_if(Gate::denies('call_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $query = Call::orderBy('date' , 'DESC');
        if($search = request()->input('search')){
            $query->where('type' , 'like' , "%$search%")
                ->orWhere('topic' , 'like' , "%$search%")
                ->orWhere('status' , 'like' , "%$search%")
                ->orWhere('summary' , 'like' , "%$search%");
        }
        if(auth()->user()->isAgent){
            $calls = $query
            ->whereRelation('agent', 'id', auth()->user()->id)
            ->paginate(100)->appends([
                'search' => $search,
            ]);
        }else{
            $calls = $query->paginate(100)->appends([
                'search' => $search,
            ]);
        }
        $local_title = __('Action Registry');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template.'.calls.index', compact('search','calls' ,'local_title', 'breadcrumbs'));
    }

    public function create(Contact $client = null)
    {
        abort_if(Gate::denies('call_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $agents = $this->getAgents();
        if(auth()->user()->isAgent) {
            $contacts = Contact::whereRelation('agents', 'id', auth()->user()->id)->pluck('name' , 'id')->prepend(__('- Choose'), '');
        }
        else{
            $contacts = Contact::all()->pluck('name' , 'id')->prepend(__('- Choose'), '');
        }
        $action = New Call(['contact_id' => $client->id ?? '']);
        $status = $this->getStatus();
        $type   = $this->getType();
        is_null($client) ? $lead = new Contact : $lead = $client ;
        // $langusages_array = Tag::whereRelation('contacts', 'id', $client->id)->where('type' , 'languages')->get();
        $langusages_array = New \App\Models\Dashboard\Tag;
        $tags = $this->getTags('interests');
        $Financial = $this->getFinancing();

        $campaigns = Campaign::pluck('name' , 'id')->prepend(__('-Choose') , '');
        $leadPriority = $this->getPriority();
        $LeadQuality = $this->getLeadQuality();

        $resident    = $this->getResident();
        $looking_for = $this->getLookingFor();
        $client_type = $this->getClientType();
        $languages = $this->getTags('languages');
        $local_title = __('Add Action Registry');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Call'), 'url' => route('dashboard.actions.index')];
        $breadcrumbs[] = ['label' => $local_title];
        return view($this->template . '.calls.create', compact( 'campaigns', 'lead',  'languages', 'tags', 'client_type', 'looking_for', 'resident', 'LeadQuality', 'leadPriority', 'client_type', 'resident', 'looking_for','Financial', 'action', 'type', 'status', 'agents', 'contacts', 'local_title', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CallStoreRequest $request)
    {
        $model = Call::create($request->all());
        if($request->content){
            $comment = Comment::create([
                'content'      => $request->content,
                'publish_date' => date('Y-m-d H:i:s'),
                'author'       => auth()->user()->id,
                'call_id'   => $model->id
            ]);
        }
        if($request->get('interested')){
            $contact = Contact::find($request->contact_id);

            $tagArray = $this->createTags($request->tags);
            $languages = $this->createTags($request->language_tags , 'languages');

            $updateData = [];

            !empty($request->get('rooms')) ? $updateData['rooms'] = $request->rooms : ''; 
            !empty($request->get('lead_quality')) ? $updateData['lead_quality'] = $request->lead_quality : ''; 
            if ($request->priority !== null) $updateData['priority'] = $request->priority; 
            if ($request->budget !== null) $updateData['budget'] = $request->budget;           
            if ($request->expected_purchase_time !== null) $updateData['expected_purchase_time'] = $request->expected_purchase_time;
            if ($request->financing !== null) $updateData['financing'] = $request->financing;
            if ($request->looking_for !== null) $updateData['looking_for'] = $request->looking_for;
            if ($request->resident !== null) $updateData['resident'] = $request->resident;
            if ($request->client_type !== null) $updateData['client_type'] = $request->client_type;
            $updateData['interested'] = 1;
            $contact->update($updateData);
            $contact->tags()->sync(array_merge($tagArray , $languages));
        }
        if ($model->id) return redirect()->route('dashboard.actions.index')->with(['message' => 'Created']); else return redirect()->route('dashboard.actions.index')->with(['danger' => __('Error!')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Call $action, $show = 'show')
    {
        abort_if(Gate::denies('call_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lead = Contact::find($action->contact_id);
        $local_title = $action->title;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Action'), 'url' => route('dashboard.actions.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.calls.' . $show, compact( 'lead', 'action', 'local_title', 'breadcrumbs'));
    }

    public function showQuick(Call $action)
    {
        abort_if(Gate::denies('call_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lead = Contact::find($action->contact_id);

        return view($this->template . '.calls.show-quick', compact( 'lead', 'action'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Call $action)
    {
        abort_if(Gate::denies('call_edit') || !$action->allowEdit, Response::HTTP_FORBIDDEN, '403 Forbidden');
        $agents = $this->getAgents();
        $looking_for = $this->getLookingFor();
        $resident  =   $this->getClientType();
        $client_type = $this->getResident();
        if(auth()->user()->isAgent) {
            $contacts = Contact::whereRelation('agents', 'id', auth()->user()->id)->pluck('name' , 'id')->prepend(__('- Choose'), '');
        }
        else{
            $contacts = Contact::all()->pluck('name' , 'id')->prepend(__('- Choose'), '');
        }
        $status = $this->getStatus();
        $type   = $this->getType();
        $lead = Contact::find($action->contact_id);
        $langusages_array = Tag::whereRelation('contacts', 'id', $lead->id)->where('type' , 'languages')->get();
        $tags = $this->getTags('interests');
        $Financial = $this->getFinancing();
        $leadPriority = $this->getPriority();
        $LeadQuality = $this->getLeadQuality();
        $resident    = $this->getResident();
        $looking_for = $this->getLookingFor();
        $client_type = $this->getClientType();
        $languages = $this->getTags('languages');
        
        $local_title = sprintf('%s: %s', __('Edit Action Registry'), $action->title );
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Call'), 'url' => route('dashboard.actions.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.actions.show', ['action' => $action])];
        $breadcrumbs[] = ['label' => __('Edit')];

        return view($this->template . '.calls.edit', compact( 'languages', 'langusages_array', 'tags', 'lead', 'client_type', 'looking_for', 'resident', 'LeadQuality', 'leadPriority', 'client_type', 'resident', 'looking_for', 'Financial', 'type', 'status', 'contacts', 'agents', 'action','local_title', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CallStoreRequest $request, Call $action)
    {
        // dd(Contact::find($request->contact_id)->rooms);
        // dd($request->rooms);
        $action->update($request->all());
        if($request->content)
        {
            $comment = Comment::create([
                'content'      => $request->content,
                'publish_date' => date('Y-m-d H:i:s'),
                'author'       => auth()->user()->id,
                'call_id'      => $action->id
            ]);
        }
        if($request->get('interested')){
            $contact = Contact::find($request->contact_id);

            $tagArray = $this->createTags($request->tags);
            $languages = $this->createTags($request->language_tags , 'languages');

            $updateData = [];

            !empty($request->get('rooms')) ? $updateData['rooms'] = $request->rooms : ''; 
            !empty($request->get('lead_quality')) ? $updateData['lead_quality'] = $request->lead_quality : ''; 
            if ($request->priority !== null) $updateData['priority'] = $request->priority; 
            if ($request->budget !== null) $updateData['budget'] = $request->budget;           
            if ($request->expected_purchase_time !== null) $updateData['expected_purchase_time'] = $request->expected_purchase_time;
            if ($request->financing !== null) $updateData['financing'] = $request->financing;
            if ($request->looking_for !== null) $updateData['looking_for'] = $request->looking_for;
            if ($request->resident !== null) $updateData['resident'] = $request->resident;
            if ($request->client_type !== null) $updateData['client_type'] = $request->client_type;
            $updateData['interested'] = 1;
            $contact->update($updateData);
            $contact->tags()->sync(array_merge($tagArray , $languages));
        }
        if($request->contentSave){
            return redirect()->route('dashboard.actions.edit', $action->id)->with(['info' => __('Updated')]);
        }else{
            return redirect()->route('dashboard.actions.index')->with(['info' => __('Updated')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Call $action)
    {
        abort_if(Gate::denies('call_delete') || !$action->allowDelete, Response::HTTP_FORBIDDEN, '403 Forbidden');
        $action->delete();
        return back()->with(['danger' => __('Deleted')]);
    }
}
