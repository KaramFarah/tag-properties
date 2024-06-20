<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Range;
// use App\Http\Requests\RangeRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\RangeResource;
use App\Http\Resources\Dashboard\UserResource;
use Symfony\Component\HttpFoundation\Response;


class RangesApiController extends Controller
{
    public function store(Request $request)
    {
        $range = Range::create($request->all());

        return (new RangeResource($range))
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }
    public function destroy(Range $range)
    {
        $range->delete();
        return response()
        ->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
}
