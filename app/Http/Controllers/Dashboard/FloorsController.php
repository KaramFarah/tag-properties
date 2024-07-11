<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Dashboard\Floor;
use Illuminate\Http\Request;
use App\Http\Controllers\Dashboard\BaseController;

class FloorsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $floors = Floor::all();

        $local_title = __('Floors');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view('fullwidth.floors.index' , compact('floors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Floor $floors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Floor $floors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Floor $floors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Floor $floor)
    {
        $floor->delete();
        return back()->with(['danger' => __('Deleted Floor')]);
        // return response()->json([
        //     'success' => 'Record deleted successfully!'
        // ]);
    }
}
