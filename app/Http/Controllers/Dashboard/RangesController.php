<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Dashboard\Range;
use Illuminate\Http\Request;

class RangesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Range $range)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Range $range)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Range $range)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Range $range)
    {
        //
    }

    public function newRange(){
        if(request()->has('loopIndex'))
            return view('fullwidth.projects.rangePlans' , ['loop_index' => request()->get('loopIndex') , 'range' => new Range()]);
        return 'No position!';
    }
}
