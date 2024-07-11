<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\MassDestroyRoleRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Gate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolesController extends BaseController
{
    public function index()
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = $this->search();

        $permissions = []; //Permission::orderBy('title')->pluck('title', 'id')->all();

        $local_title = __('Roles');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template.'.roles.index', compact('local_title', 'breadcrumbs', 'roles', 'permissions')); // 'roles', 
    }

    public function search(){
        $query = Role::orderBy('title');

        request()->get('id') ? $query->where('id', request()->get('id')) : '';
        
        if($search = request()->get('search')){
            $query->where('title', 'like', "%$search%")->orWhereHas('permissions', function (Builder $subQuery) {
                $subQuery->where('title', 'like', "%".request()->search."%");
            });  
        }

        // if(request()->has('title') && request()->get('title')){
        //     $query->whereHas('title', 'like', '%'.request()->get('title').'%');  
        // }
        
        return $query->get();
    }

    public function create()
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::pluck('title', 'id');

        $local_title = __('Add Role');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Roles'), 'url' => route('dashboard.roles.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template.'.roles.create', compact('permissions', 'local_title', 'breadcrumbs'));
    }

    public function store(RoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('dashboard.roles.index')->with(['success' => __('Added')]);
    }

    public function edit(Role $role)
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        $permissions = Permission::pluck('title', 'id');

        $local_title = sprintf('%s: %s',__('Edit Role'), $role->title);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Roles'), 'url' => route('dashboard.roles.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.roles.show', ['role' => $role])];
        $breadcrumbs[] = ['label' => __('Edit')];

        return view($this->template.'.roles.edit', compact('permissions', 'role', 'local_title', 'breadcrumbs'));
    }

    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('dashboard.roles.index')->with(['info' => __('Updated')]);
    }

    public function show(Role $role)
    {
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        $local_title = $role->title;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Roles'), 'url' => route('dashboard.roles.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template.'.roles.show', compact('role', 'local_title', 'breadcrumbs'));
    }

    public function destroy(Role $role)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return back()->with(['danger' => __('Deleted')]);
    }

    public function massDestroy(MassDestroyRoleRequest $request)
    {
        Role::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
