<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use Gate;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Dashboard\Unit;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\UserResource;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource(User::with(['roles'])->get());
    }

    public function store(UserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserResource($user->load(['roles']));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function assignFavorite(Unit $unit){
        $user = auth()->user();
        // $current_favorites = array();
        $current_favorites = $user->favorites->pluck('id')->toArray();
        
        // dd($current_favorites);
        // dd(in_array($unit->id, $current_favorites, true));
        // array_push($current_favorites , $unit);
        if(in_array($unit->id, $current_favorites, true)){
            $index = array_search($unit->id, $current_favorites, true);
            unset($current_favorites[$index]);
        }else{
            array_push($current_favorites , $unit->id);
        }
        $user->favorites()->sync($current_favorites);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
