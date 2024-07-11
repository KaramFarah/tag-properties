<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeveloperRequest;
use App\Http\Resources\Dashboard\DeveloperResource;
use App\Http\Resources\Dashboard\UserResource;
use App\Models\Dashboard\Developer;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DevelopersApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('developer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new UserResource(User::with(['roles'])->get());
    }

    public function store(DeveloperRequest $request)
    {
        $developer = Developer::create($request->all());

        return (new DeveloperResource($developer))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Developer $developer)
    {
        abort_if(Gate::denies('developer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new DeveloperResource($developer);
    }

    public function update(DeveloperRequest $request, Developer $developer)
    {
        // $user->update($request->all());
        // $user->roles()->sync($request->input('roles', []));

        // return (new UserResource($user))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Developer $developer)
    {
        abort_if(Gate::denies('developer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $developer->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
