<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\MediaResource;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MediaApiController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('media_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // return new UserResource(User::with(['roles'])->get());
    }

    public function store(Request $request)
    {
        $media = Media::create($request->all());

        return (new MediaResource($media))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Media $media)
    {
        abort_if(Gate::denies('media_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MediaResource($media);
    }

    public function update(Request $request, Media $media)
    {
        // $user->update($request->all());
        // $user->roles()->sync($request->input('roles', []));

        // return (new UserResource($user))
        //     ->response()
        //     ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Media $media)
    {
        abort_if(Gate::denies('media_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $media->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function destroyPhotos(Media $media)
    {
        abort_if(Gate::denies('media_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $media->clearMediaCollection('unit-photos');

        return response(null, Response::HTTP_NO_CONTENT);
    }
}