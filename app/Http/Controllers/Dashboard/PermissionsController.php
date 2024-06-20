<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends BaseController
{

    public function index()
    {
        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($search = request()->get('search')){
            $permissions = Permission::where('title', 'like', "%$search%")->orderBy('title')->get();
        }
        else{
            $permissions = Permission::orderBy('title')->get();
        }

        $local_title = __('Permissions');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.permissions.index', compact('permissions', 'local_title', 'breadcrumbs'));
    }

    public function create()
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = __('Add Permission');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Permissions'), 'url' => route('dashboard.permissions.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.permissions.create', compact('local_title', 'breadcrumbs'));
    }

    public function store(PermissionRequest $request)
    {
        $permission = Permission::create($request->all());
        if ($permission)
            return redirect()->route('dashboard.permissions.index')->with(['success' => __('Added')]);
        else
            return redirect()->route('dashboard.permissions.index')->with(['danger' => __('Error')]);
    }

    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = sprintf('%s: %s', __('Edit Permission'), $permission->title);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Permissions'), 'url' => route('dashboard.permissions.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.permissions.show', ['permission' => $permission])];
        $breadcrumbs[] = ['label' => __('Edit')];

        return view($this->template . '.permissions.edit', compact('permission','local_title', 'breadcrumbs'));
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());

        return redirect()->route('dashboard.permissions.index')->with(['info' => __('Updated')]);
    }

    public function show(Permission $permission)
    {
        abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = $permission->title;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Permissions'), 'url' => route('dashboard.permissions.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.permissions.show', compact('permission', 'local_title', 'breadcrumbs'));
    }

    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();

        return back()->with(['danger' => __('Deleted')]);
    }

    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
