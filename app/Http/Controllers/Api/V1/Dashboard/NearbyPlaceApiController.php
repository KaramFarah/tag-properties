<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\NearbyPlace;
// use App\Http\Requests\NearbyPlaceRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\NearbyPlaceResource;
use App\Http\Resources\Dashboard\UserResource;
use Symfony\Component\HttpFoundation\Response;


class NearbyPlaceApiController extends Controller
{
    // public function store(Request $request)
    // {
    //     $nearbyPlace = NearbyPlace::create($request->all());

    //     return (new NearbyPlaceResource($nearbyPlace))
    //     ->response()
    //     ->setStatusCode(Response::HTTP_CREATED);
    // }
    public function destroy(NearbyPlace $nearbyPlace)
    {
        $nearbyPlace->delete();
        return response()
        ->json([
            'success' => 'Record deleted successfully!'
        ]);
    }
    public function newPlace(){
        if($loop_index = request()->loop_index)
        return view('fullwidth.units.nearByPlaces' , ['loop_index' => $loop_index , 'nearbyPlace' => new NearbyPlace]);
    }
}
