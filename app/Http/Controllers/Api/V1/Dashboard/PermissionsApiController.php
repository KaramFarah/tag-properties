<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Http\Resources\Dashboard\PermissionResource;
use App\Models\Permission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PermissionResource(Permission::all());
    }

    public function store(PermissionRequest $request)
    {
        $permission = Permission::create($request->all());

        return (new PermissionResource($permission))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Permission $permission)
    {
        abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PermissionResource($permission);
    }

    public function update(PermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());

        return (new PermissionResource($permission))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permission->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
