<?php

namespace App\Http\Controllers\Dashboard;


use Gate;
use Illuminate\Support\Str;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Dashboard\Agent;
use App\Http\Requests\AgentStoreRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Dashboard\BaseController;
use Illuminate\Database\Eloquent\Builder;

class AgentsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        abort_if(Gate::denies('agent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $query = User::orderBy('name')->whereHas('roles', function (Builder $subQuery) {
            $subQuery->where('title', 'like', 'agent');
        });
        if($search = request()->input('search')){
            $query->where('name' , 'like' , "%$search%")
                ->orWhere('email' , 'like' , "%$search%");
        }
        
        $agents = $query->get();

        $local_title = __('Agents');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.agents.index', compact('search','agents', 'local_title', 'breadcrumbs'));
    }

    public function create()
    {
        abort_if(Gate::denies('agent_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $users = User::pluck('name' , 'id')->prepend(__('-Choose') , '');
        // $countries = array_merge([''=>'- Choose Country'], $this->getCountries());
        // dd($countries);
        $countries = array_merge([''=>'- Choose Country'], $this->countries);
   
        $local_title = __('Add Agent');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Agents'), 'url' => route('dashboard.agents.index')];
        $breadcrumbs[] = ['label' => $local_title];
        $languages = $this->getTags('languages');

        return view($this->template . '.agents.create', compact( 'countries', 'users', 'local_title', 'breadcrumbs', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgentStoreRequest $request)
    {
        // dd($request->all());
        $agent = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Str::password(10),
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'emitaes_id' => $request->emitaes_id,
            'brn' => $request->brn,
            'employee_id_number' => $request->employee_id_number,
            'languages' => $request->languages,
            //'user_id' => $userID->get()->first()->id
        ]);
        $agent->roles()->sync(Role::where('title', 'Agent')->pluck('id')->toArray());
        
        $languages = $this->createTags($request->preferred_languages , 'languages');
        $agent->tags()->sync($languages);

        if ($agent->id) {
            return redirect()->route('dashboard.agents.index')->with(['message' => 'Created']); 
        } else {
            return redirect()->route('dashboard.agents.index')->with(['danger' => __('Error!')]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $agent)
    {
        abort_if(Gate::denies('agent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $agent->load(['leads', 'contacts', 'calls']);
        $local_title = $agent->name;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Agents'), 'url' => route('dashboard.agents.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.agents.show', compact('agent', 'local_title', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $agent)
    {
        abort_if(Gate::denies('agent_edit') || !$agent->allowEdit, Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $countries = array_merge([''=>'- Choose Country'], $this->countries);
        // $countries = array_merge([''=>'- Choose Country'], $this->getCountries());
        $countries = array_merge([''=>'- Choose Country'], $this->countries);
        $local_title = sprintf('%s: %s', __('Edit Agent'), $agent->name);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Agents'), 'url' => route('dashboard.agents.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.agents.show', ['agent' => $agent])];
        $breadcrumbs[] = ['label' => __('Edit')];

        $languages = $this->getTags('languages');

        return view($this->template . '.agents.edit', compact( 'countries', 'agent','local_title', 'breadcrumbs', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgentStoreRequest $request, User $agent)
    {
        // dd($request->all());
        $agent->update($request->all());
        $languages = $this->createTags($request->preferred_languages , 'languages');
        $agent->tags()->sync($languages);

        return redirect()->route('dashboard.agents.index')->with(['info' => __('Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $agent)
    {
        abort_if(Gate::denies('agent_delete') || !$agent->allowDelete, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $agent->delete();

        return back()->with(['danger' => __('Deleted')]);
    }

    public function indexAuditlogs($id, $class)
    {
        $model = $class::find($id);

        $items = $model->auditlogs ?? [];

        return view($this->template.'.auditLogs.history', compact('items'));
    }
}
