<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\DeveloperRequest;
use App\Models\Dashboard\City;
use App\Models\Dashboard\Developer;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class DevelopersController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('developer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $local_title = __('Developers');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        $developers = $this->search();

        return view($this->template.'.developers.index', compact('local_title', 'breadcrumbs', 'developers'));
    }

    public function search(){
        $query = Developer::orderBy('order')->orderBy('name');

        if(request()->has('search')){
            $query->where('name', 'like', '%'.request()->get('search').'%')->orWhere('description', 'like', '%'.request()->get('search').'%');  
            return $query->paginate(100)->appends([
                'search' => request()->get('search'),
            ]);
        }

        return $query->paginate(100);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('developer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = __('Add Developer');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Developers'), 'url' => route('dashboard.developers.index')];
        $breadcrumbs[] = ['label' => $local_title];

        $cities = City::orderBy('name')->pluck('name', 'id')->all();

        return view($this->template . '.developers.create', compact('local_title', 'breadcrumbs', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeveloperRequest $request)
    {
        $model = Developer::create($request->all());
        $cities = $this->createCities($request->cities);
        $model->cities()->sync($cities);
        if ($model){
            if ($request->hasFile('logo') && $request->file('logo')->isValid()){
                $model->addMediaFromRequest('logo')->toMediaCollection('logos', 'media');
                $model->save();
            }

            return redirect()->route('dashboard.developers.index', $model)->with(['success' => 'Added']);
        }
        else{
            return redirect()->route('dashboard.developers.create')->with(['danger' => 'Error!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Developer $developer)
    {
        abort_if(Gate::denies('developer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = $developer->name;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Developers'), 'url' => route('dashboard.developers.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.developers.show', compact('developer', 'local_title', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Developer $developer)
    {
        abort_if(Gate::denies('developer_edit') || !$developer->allowEdit, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = sprintf('%s: %s', __('Edit Developer'), $developer->name);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Developers'), 'url' => route('dashboard.developers.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.developers.show', ['developer' => $developer])];
        $breadcrumbs[] = ['label' => __('Edit')];
        
        $cities = City::orderBy('name')->pluck('name', 'id')->all();

        return view($this->template . '.developers.edit', compact('developer','local_title', 'breadcrumbs', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DeveloperRequest $request, Developer $developer)
    {
        if ($developer->update($request->all())){
            $cities = $this->createCities($request->cities);
            $developer->cities()->sync($cities);
            if ($request->hasFile('logo') && $request->file('logo')->isValid()){
                $_media = $developer->getMedia('logos');
                foreach($_media as $_item) {
                    $_item->delete();
                }
                $developer->addMediaFromRequest('logo')->toMediaCollection('logos', 'media');
            }
            return redirect()->route('dashboard.developers.index')->with(['success' => __('Updated')]);
        }
        else{
            return redirect()->route('dashboard.developers.edit', $developer->id)->with(['danger' => __('Error!')]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Developer $developer)
    {
        abort_if(Gate::denies('developer_delete') || !$developer->allowDelete, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $developer->delete();

        return back()->with(['danger' => 'Deleted']);
    }
}
