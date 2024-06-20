<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Models\Dashboard\Project;
use App\Http\Requests\ProjectRequest;
use App\Http\Resources\Dashboard\UserResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Dashboard\ProjectResource;
use App\Http\Controllers\Dashboard\BaseController;


class ProjectsApiController extends BaseController
{
    public function store(ProjectRequest $request)
    {
        $project = Project::create($request->all());
        $developer = $this->createDevelopers($request->developer);
        $project->developers()->sync($developer);

        return (new ProjectResource($project))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
