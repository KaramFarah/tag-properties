<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class CampaignResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
