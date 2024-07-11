<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Tag;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\TagResource;
use App\Http\Resources\Dashboard\UserResource;
use Symfony\Component\HttpFoundation\Response;


class TagsApiController extends Controller
{
    public function store(TagRequest $request)
    {
        $tag = Tag::create($request->all());

        return (new TagResource($tag))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
