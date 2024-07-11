<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Campaign;
use App\Http\Controllers\Controller;
use App\Http\Requests\CampaignStoreRequest;
use App\Http\Resources\Dashboard\UserResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Dashboard\CampaignResource;


class CampaignsApiController extends Controller
{
    public function store(CampaignStoreRequest $request)
    {
        $campaign = Campaign::create($request->all());

        return (new CampaignResource($campaign))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
