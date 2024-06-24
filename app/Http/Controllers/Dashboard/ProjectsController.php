<?php

namespace App\Http\Controllers\Dashboard;

use Gate;
use Illuminate\Http\Request;
use App\Models\Dashboard\City;
use App\Models\Dashboard\Range;
use App\Models\Dashboard\Project;
use App\Models\Dashboard\Developer;
use App\Http\Requests\ProjectRequest;
use App\Models\Dashboard\Installment;
use App\Models\Dashboard\NearbyPlace;
use Symfony\Component\HttpFoundation\Response;


class ProjectsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $local_title = __('Projects');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        $items = $this->search();

        return view($this->template.'.projects.index', compact('local_title', 'breadcrumbs', 'items'));
    }

    public function search(){
        $query = Project::orderBy('name');

        request()->has('id') ? $query->where('id', request()->get('id')) : '';
        
        if(request()->has('search')){
            $query->where('name', 'like', '%'.request()->get('search').'%')
            ->orWhere('description', 'like', '%'.request()->get('search').'%')
            ->orWhere('opening_date', 'like', '%' . request()->get('search') . '%')
            ->orWhereHas('developers', function ($query){
                $query->where('name', 'like', request()->get('search'));
            });
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
        abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cities = City::orderBy('name')->pluck('name', 'id')->all();
        $openDates = $this->getOpeningDates();
        $emirates = $this->getEmirates();
        $local_title = __('Add Project');
        $installments = Installment::pluck('milestone', 'id')->prepend('- Choose', '')->all();
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Projects'), 'url' => route('dashboard.projects.index')];
        $breadcrumbs[] = ['label' => $local_title];
        $countries = array_merge([''=>'- Choose Country'], $this->countries);
        $developers = Developer::orderBy('name')->pluck('name', 'id')->prepend(__('- Choose'), '');
        // $places = $this->getPlaces();

        $types = $this->getPropertyStatuses();

        return view($this->template . '.projects.create', compact( 'cities', 'installments', 'emirates', 'openDates', 'countries', 'local_title', 'breadcrumbs', 'developers', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $model = Project::create($request->all());
        $developer = $this->createDevelopers($request->developer);
        $model->developers()->sync($developer);
        $model->installments()->sync($request->input('installments', []));

        $cities = $this->createCities($request->cities);
        $model->cities()->sync($cities);

        if ($model){
            if ($request->hasFile('attachments')){
                foreach($request->file('attachments') as $_file){
                    $model->addMedia($_file)->toMediaCollection('projects', 'media');
                    $model->save();
                }
            }
            if ($request->hasFile('projectPhotos')){
                foreach($request->file('projectPhotos') as $_file){
                    if ($model->addMedia($_file)->toMediaCollection('project-photos', 'media')) $model->save(); else $request->session()->flash('danger', __('Unable to save this file'));
                }
            }
            if ($request->hasFile('availabilityList')){

                    if ($model->addMedia($request->availabilityList)->toMediaCollection('availability-list', 'media')) $model->save(); else $request->session()->flash('danger', __('Unable to save this file'));
                
            }
            if ($request->hasFile('paymentPlan')){
     
                    if ($model->addMedia($request->file('paymentPlan'))->toMediaCollection('payment-plan', 'media')) $model->save(); else $request->session()->flash('danger', __('Unable to save this file'));
                
            }
            if ($request->hasFile('brochure')){
                
                if ($model->addMedia($request->brochure)->toMediaCollection('brochure', 'media')) $model->save(); else $request->session()->flash('danger', __('Unable to save this file'));
                
            }
            
            $requestranges = $request->inputs;
            unset($requestranges[9999]);

            $ranges = [];
            foreach($requestranges as $range){
    
                $checkArray = array_filter($range , null);
    
                if(empty($checkArray)) continue;
    
                $range = Range::updateOrCreate(['id' => $range['id']] , $range);
                
                array_push($ranges , $range['id']);
            }
            $model->ranges()->sync($ranges);

            $requestplaces = $request->places;
            unset($requestplaces[9999]);
            $places = [];
            foreach($requestplaces as $place){
                
                $checkArray = array_filter($place , null);
    
                if(count($checkArray) <= 1) continue;
    
                $place = NearbyPlace::updateOrCreate(['id' => $place['id']], $place);
                array_push($places , $place['id']);
            }
            $model->places()->sync($places);


            return redirect()->route('dashboard.projects.index', $model)->with(['success' => 'Added']);
        }
        else{
            return redirect()->route('dashboard.projects.create')->with(['danger' => 'Error!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        abort_if(Gate::denies('project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = $this->countries;
        $local_title = $project->name;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Projects'), 'url' => route('dashboard.projects.index')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template . '.projects.show', compact( 'countries', 'project', 'local_title', 'breadcrumbs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        abort_if(Gate::denies('project_edit') || !$project->allowEdit, Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cities = City::orderBy('name')->pluck('name', 'id')->all();
        $coordinates = $project->location ?? '35.52052844635452;35.80705384863964';
        $openDates = $this->getOpeningDates();
        $emirates = $this->getEmirates();
        // $places = $this->getPlaces();
        // // Extract latitude and longitude values using regular expression
        // preg_match('/\((.*?), (.*?)\)/', $inputString, $matches);

        // // Create an array with keys "lat" and "lng"
        // $coordinates = array(
        //     'lat' => floatval($matches[1]),
        //     'lng' => floatval($matches[2])
        // );

        
        $installments = Installment::pluck('milestone', 'id')->prepend('- Choose', '')->all();
        $local_title = sprintf('%s: %s', __('Edit Project'), $project->name);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Developers'), 'url' => route('dashboard.projects.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.projects.show', ['project' => $project])];
        $breadcrumbs[] = ['label' => __('Edit')];
        $countries = array_merge([''=>'- Choose Country'], $this->countries);
        $developers = Developer::orderBy('name')->pluck('name', 'id')->prepend(__('- Choose'), '');

        $types = $this->getPropertyStatuses();

        return view($this->template . '.projects.edit', compact( 'cities', 'installments', 'emirates', 'openDates', 'coordinates', 'countries', 'project', 'local_title', 'breadcrumbs', 'developers', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, Project $project)
    {

        if ($project->update($request->all())){
            $developer = $this->createDevelopers($request->developer);

            $project->developers()->sync($developer);
            $project->installments()->sync($request->input('installments', []));

            $cities = $this->createCities($request->cities);
            $project->cities()->sync($cities);

            if ($request->hasFile('attachments')){
                foreach($request->file('attachments') as $_file){
                    if (!$project->addMedia($_file)->toMediaCollection('projects', 'media'))
                    $request->session()->flash('danger', __('Unable to save this file'));
                }
            }
            if ($request->hasFile('projectPhotos')){
                foreach($request->file('projectPhotos') as $_file){
                    if (!$project->addMedia($_file)->toMediaCollection('project-photos', 'media'))
                    $request->session()->flash('danger', __('Unable to save this file'));
                }
            }
            if ($request->hasFile('availabilityList')){

                    if (!$project->addMedia($request->availabilityList)->toMediaCollection('availability-list', 'media')) $request->session()->flash('danger', __('Unable to save availability!'));
                
            }
            if ($request->hasFile('paymentPlan')){
                    if (!$project->addMedia($request->file('paymentPlan'))->toMediaCollection('payment-plan', 'media')) $request->session()->flash('danger', __('Unable to save payment plan!'));
                
            }
            if ($request->hasFile('brochure')){
                if (!$project->addMedia($request->brochure)->toMediaCollection('brochure', 'media')) $request->session()->flash('danger', __('Unable to save brochure!'));
                
            }

            $requestranges = $request->inputs;
            unset($requestranges[9999]);
            $ranges = [];
            foreach($requestranges as $range){
    
                $checkArray = array_filter($range , null);
    
                if(empty($checkArray)) continue;
    
                $range = Range::updateOrCreate(['id' => $range['id']] , $range);
                
                array_push($ranges , $range['id']);
            }
            $project->ranges()->sync($ranges);

            $requestplaces = $request->places;
            unset($requestplaces[9999]);
            $places = [];
            foreach($requestplaces as $place){
                $checkArray = array_filter($place , null);
    
                if(count($checkArray) <= 1) continue;
                $place = NearbyPlace::updateOrCreate(['id' => $place['id']] , $place);
                array_push($places , $place['id']);
            }
            $project->places()->sync($places);


            return redirect()->route('dashboard.projects.index')->with(['info' => 'Updated']);
        }
        else{
            return redirect()->route('dashboard.projects.edit', $project->id)->with(['danger' => 'Error!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        abort_if(Gate::denies('project_delete') || !$project->allowDelete, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project->delete();

        return back()->with(['danger' => 'Deleted']);
    }
}
