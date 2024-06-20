<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Agent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgentStoreRequest;
use App\Http\Resources\Dashboard\UserResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Dashboard\AgentResource;


class AgentsApiController extends Controller
{
    public function store(AgentStoreRequest $request)
    {
        $agent = Agent::create($request->all());

        return (new AgentResource($agent))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
