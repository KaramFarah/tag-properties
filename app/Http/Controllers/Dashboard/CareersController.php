<?php

namespace App\Http\Controllers\Dashboard;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Dashboard\Career;
use App\Http\Controllers\Dashboard\BaseController;

class CareersController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('career_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $query= Career::orderBy('job_title');
        if ($search = request()->search)
        $query->where('job_title' , 'like' , "%$search%");

        $careers = $query->paginate(100)->appends([
            'search' => $search,
        ]);

        $local_title = __('Careers');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template.'.careers.index', compact('search','careers', 'local_title', 'breadcrumbs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //abort_if(Gate::denies('career_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = __('Add Career');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Careers'), 'url' => route('dashboard.careers.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.careers.create', compact('local_title', 'breadcrumbs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = Career::create($request->all());
        if ($model->id)
        return redirect()->route('dashboard.careers.index')->with(['message' => 'Created']);
        else 
        return redirect()->route('dashboard.careers.index')->with(['danger' => __('Error!')]);
    }

    public function show(Career $career)
    {
        abort_if(Gate::denies('career_show') || !$career->allowEdit, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = $this->countries;

        $local_title = $career->job_title;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Careers'), 'url' => route('dashboard.careers.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.careers.show', compact('career', 'countries', 'local_title', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Career $career)
    {
        abort_if(Gate::denies('career_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = sprintf('%s: %s', __('Edit Career'), $career->name);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Careers'), 'url' => route('dashboard.careers.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.careers.show', ['career' => $career])];
        $breadcrumbs[] = ['label' => __('Edit')];

        return view($this->template . '.careers.edit', compact('career','local_title', 'breadcrumbs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Career $career)
    {
        $career->update($request->all());

        return redirect()->route('dashboard.careers.index')->with(['info' => __('Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Career $career)
    {
        abort_if(Gate::denies('career_delete') || !$career->allowDelete, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $career->delete();

        return back()->with(['danger' => __('Deleted')]);
    }
}
