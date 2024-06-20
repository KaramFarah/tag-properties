<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Installment;
use App\Http\Requests\InstallmentRequest;
use App\Http\Resources\Dashboard\UserResource;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\Dashboard\InstallmentResource;


class InstallmentsApiController extends Controller
{
    public function store(InstallmentRequest $request)
    {
        $installment = Installment::create($request->all());

        return (new InstallmentResource($installment))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
