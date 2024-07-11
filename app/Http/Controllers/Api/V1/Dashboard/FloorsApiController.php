<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\Floor;
// use App\Http\Requests\FloorRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\FloorResource;
use App\Http\Resources\Dashboard\UserResource;
use Symfony\Component\HttpFoundation\Response;


class FloorsApiController extends Controller
{
    public function store(Request $request)
    {
        $floor = Floor::create($request->all());

        return (new FloorResource($floor))
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }
    public function destroy(Floor $floor)
    {
        $floor->delete();
        return response()
        ->json([
            'success' => 'Record deleted successfully!'
        ]);
    }

    public function newFloor(){
        if($loop_index = request()->loop_index)
        return view('fullwidth.units.floorPlans' , ['loop_index' => $loop_index , 'floor' => new Floor]);
    }
}
