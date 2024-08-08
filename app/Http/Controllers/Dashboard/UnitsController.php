<?php

namespace App\Http\Controllers\Dashboard;

use Gate;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Dashboard\Tag;
use App\Models\Dashboard\City;
use App\Models\Dashboard\Unit;
use App\Models\Dashboard\Floor;
use App\Models\Dashboard\Project;
use App\Http\Requests\UnitRequest;
use App\Models\Dashboard\Developer;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Installment;
use App\Models\Dashboard\NearbyPlace;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class UnitsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_if(Gate::denies('unit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $items = $this->search();
        $local_title = __('Properties');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];

        return view($this->template.'.units.index', compact('local_title', 'breadcrumbs', 'items'));
    }
    public function search(){

        if(auth()->user()->isAgent){
            $query = Unit::orderBy('created_at', 'DESC')->orderBy('updated_at', 'DESC')
                ->whereHas('assignee' , function($q){
                    $q->where('id' , auth()->user()->id );
                });
        }

        if(auth()->user()->isAdmin)
        $query = Unit::orderBy('created_at', 'DESC')->orderBy('updated_at', 'DESC');

        request()->has('id') ? $query->where('id', request()->get('id')) : '';
        if(request()->has('search')){
            $query->where('name', 'like', '%'.request()->get('search').'%')
            ->orWhere('description', 'like', '%'.request()->get('search').'%');
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
        abort_if(Gate::denies('unit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $cities = City::orderBy('name')->pluck('name', 'id')->all();
        $local_title = __('Submit Property');
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => $local_title];
        $features = Tag::where('type', 'features')->get();
        $emirates = $this->getEmirates();
        $projects = Project::orderBy('name')->pluck('name', 'id')->prepend('- Choose', '')->all();
        
        $agents = User::whereHas('roles' , function($q){
            $q->where('title', 'Agent');
        })->pluck('name' , 'id')->toArray();

        $installments = Installment::pluck('milestone', 'id')->prepend('- Choose', '')->all();
        
        $developers = Developer::all()->pluck('name' , 'id');
        $types = [
            '' => __('- Choose'),
            1 => __('Off-Plan'),
            2 => __('Ready'),
        ];
        $countries = $this->countries;
        return view($this->template.'.units.create', compact( 'cities', 'agents', 'countries', 'types', 'developers', 'local_title', 'breadcrumbs', 'features', 'projects', 'installments', 'emirates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        if (!$request->has('availability')){
            $request->merge([
                'availability' => 0,
            ]);
        }
        if (!$request->has('featuered')){
            $request->merge([
                'featuered' => 0,
            ]);
        }
        if (!$request->has('published')){
            $request->merge([
                'published' => 0,
            ]);
        }

        $model = Unit::create($request->all());
        $model->tags()->sync($request->input('propertyFeatures', []));
        $model->installments()->sync($request->input('installments', []));
        
        if($request->has('user_id')){
        
            $model->assignee()->sync($request->get('user_id') , []);

        }

        // $cities = $this->createCities($request->cities);
        // $model->cities()->sync($cities);

        if($request->get('tagTextInput') && count($request->get('tagTextInput'))){
            foreach($request->tagTextInput as $key => $tagText) $tagText ? $model->tags()->sync([$key => ['tag_value' => $tagText]], false) : '';
        }

        if($request->has('tagDropdownInput')){
            foreach($request->tagDropdownInput as $key => $value) $value ? $model->tags()->sync([$key => ['tag_value' => $value]], false) : '';

        }

        $requestfloors = $request->inputs; 

        unset($requestfloors[9999]);

        $floors = [];
        foreach($requestfloors as $floor){

            $checkArray = array_filter($floor , null);

            if(empty($checkArray)) continue;
            
            $photos = 0;

            if(isset($floor['floor_photos'])){   
                $photos = $floor['floor_photos'];
            }

            $floor = Floor::updateOrCreate(['id' => $floor['id']] , $floor);

            if($photos){
                foreach($photos as $_floorFile){
                    $floor->addMedia($_floorFile)->toMediaCollection('floor-photos' , 'media');
                    $floor->save();
                }
            }
            
            array_push($floors , $floor['id']);
        }
        $model->floors()->sync($floors);
        
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

        if ($model){
            if ($request->hasFile('photos')){
                foreach($request->file('photos') as $_file){
                    $model->addMedia($_file)->toMediaCollection('unit-photos', 'media');
                    $model->save();
                }
            }
            if ($request->hasFile('floorPlan-file')){
                foreach($request->file('floorPlan-file') as $_file){
                    $model->addMedia($_file)->toMediaCollection('unit-floorplans', 'media');
                    $model->save();
                }
            }
            if ($request->hasFile('attachment-file')){
                foreach($request->file('attachment-file') as $_file){
                    $model->addMedia($_file)->toMediaCollection('unit-attachment', 'media');
                    $model->save();
                }
            }
            if($request->header('referer') === route('property-list')){
                return redirect()->route('profile.details', ['user' => Auth()->user()->id])->with(['success' => 'Added']);
                
            }
            return redirect()->route('dashboard.units.index', $model)->with(['success' => 'Added']);
        }
        else{
            if($request->header('referer') === route('property-list')){

                // $body = 'There was a new Propertey That Was lsited in the system' . "\n";
                // $receiving_email_address = 'TagProperties.reciver@gmail.com';
                // $subject = 'New Property Was Listed';
                // if(mail($receiving_email_address, $subject, $body)){
                //     http_response_code(200);
                //     echo json_encode(['status' => 200]);
                // }else{
                //     http_response_code(500);
                //     echo json_encode(['status' => 500]);

                return redirect()->route('profile.details', ['user' => Auth()->user()->id])->with(['danger' => 'Error!']);
            }
            return redirect()->route('dashboard.units.create')->with(['danger' => 'Error!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        abort_if(Gate::denies('unit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $local_title = $unit->name;
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Units'), 'url' => route('dashboard.units.index')];
        $breadcrumbs[] = ['label' => $local_title];

        $countries = $this->countries;

        return view('fullwidth.units.show', compact('unit', 'local_title', 'breadcrumbs', 'countries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        abort_if(Gate::denies('unit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $features = Tag::where('type', 'features')->get();
        $cities = City::orderBy('name')->pluck('name', 'id')->all();
        $emirates = $this->getEmirates();
        $projects = Project::orderBy('name')->pluck('name', 'id')->prepend('- Choose', '')->all();

        $installments = Installment::pluck('milestone', 'id')->prepend('- Choose', '')->all();
        
        $agents = User::whereHas('roles' , function($q){
            $q->where('title', 'Agent');
        })->pluck('name' , 'id')->toArray();

        $local_title = sprintf('%s: %s', __('Edit Property'), $unit->name);
        $breadcrumbs[] = ['label' => __('Dashboard'), 'url' => route('dashboard.home')];
        $breadcrumbs[] = ['label' => __('Units'), 'url' => route('dashboard.units.index')];
        $breadcrumbs[] = ['label' => $local_title, 'url' => route('dashboard.units.show', ['unit' => $unit])];
        $breadcrumbs[] = ['label' => __('Edit')];

        $developers = Developer::all()->pluck('name' , 'id');
        $types = [
            '' => __('- Choose'),
            1 => __('Off-Plan'),
            2 => __('Ready'),
        ];
        $countries = $this->countries;
        return view($this->template . '.units.edit', compact( 'cities', 'agents', 'countries', 'types', 'developers', 'unit','local_title', 'breadcrumbs', 'features', 'projects', 'installments', 'emirates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, Unit $unit)
    {
        // dd($unit->address);

        if (!$request->has('availability')){
            $request->merge([
                'availability' => 0,
            ]);
        }
        if (!$request->has('featuered')){
            $request->merge([
                'featuered' => 0,
            ]);
        }
        if (!$request->has('published')){
            $request->merge([
                'published' => 0,
            ]);
        }
        $rquestInput = $request->all();
        is_Null($rquestInput['area_sqft']) ? $rquestInput['area_sqft'] = 0 : '';  
        is_Null($rquestInput['bedrooms']) ? $rquestInput['bedrooms'] = 1 : '';  
        is_Null($rquestInput['bathrooms']) ? $rquestInput['bathrooms'] = 1 : '';  
        
        $unit->update($rquestInput);

        $unit->assignee()->sync($request->get('user_id') , true);

        $requestfloors = $request->inputs; 
        $requestplaces = $request->places; 
        unset($requestfloors[9999]);
        unset($requestplaces[9999]);

        $unit->installments()->sync($request->input('installments', []));

        $unit->setRelation('tags', null); //Remove all first

        // $cities = $this->createCities($request->cities);
        // $unit->cities()->sync($cities);

        $unit->tags()->sync($request->input('propertyFeatures', []));
        if(count($request->tagTextInput)){
            foreach($request->tagTextInput as $key => $tagText) $tagText ? $unit->tags()->sync([$key => ['tag_value' => $tagText]], false) : '';
        }
        if($request->has('tagDropdownInput')){
            foreach($request->tagDropdownInput as $key => $value) $value == 0 || $value ? $unit->tags()->sync([$key => ['tag_value' => $value]], false) : '';
        }

        $floors = [];
        foreach($requestfloors as $floor){

            $checkArray = array_filter($floor , null);

            if(empty($checkArray)) continue;

            $photos = 0;

            if(isset($floor['floor_photos'])){   
                $photos = $floor['floor_photos'];
            }

            
            $floor = Floor::updateOrCreate(['id' => $floor['id']] , $floor);
            
            if($photos){
                foreach($photos as $_floorFile){
                    $floor->addMedia($_floorFile)->toMediaCollection('floor-photos' , 'media');
                    $floor->save();
                }
            }
            
            array_push($floors , $floor['id']);
        }
        $unit->floors()->sync($floors);

        $places = [];
        foreach($requestplaces as $place){
            $checkArray = array_filter($place , null);

            if(count($checkArray) <= 1) continue;
            $place = NearbyPlace::updateOrCreate(['id' => $place['id']] , $place);
            array_push($places , $place['id']);
        }
        $unit->places()->sync($places);

        if ($unit){
            if ($request->hasFile('photos')){
                foreach($request->file('photos') as $_file){
                    $unit->addMedia($_file)->toMediaCollection('unit-photos', 'media');
                }
                // $unit->save();
            }
            if ($request->hasFile('attachment-file')){
                foreach($request->file('attachment-file') as $_attachment){
                    $unit->addMedia($_attachment)->toMediaCollection('unit-attachment', 'media');
                }
                // $unit->save();
            }
            if ($request->hasFile('floorPlan-file')){
                foreach($request->file('floorPlan-file') as $_file){
                    $unit->addMedia($_file)->toMediaCollection('unit-floorplans', 'media');
                    $unit->save();
                }
            }
            return redirect()->route('dashboard.units.index', $unit)->with(['info' => 'Updated']);
        }
        else{
            return redirect()->route('dashboard.units.create')->with(['danger' => 'Error!']);
        }

        return redirect()->route('dashboard.units.index')->with(['info' => __('Updated')]);
    }

    public function destroy(Unit $unit)
    {
        abort_if(Gate::denies('unit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($unit->floors){
            foreach($unit->floors as $floor)
            $floor->delete();
        }
        if($unit->places
        ){
            foreach($unit->places as $place)
            $place->delete();
        }
        $unit->delete();

        return back()->with(['danger' => 'Deleted']);
    }

    /* public function massDestroy(MassDestroyUserRequest $request)
    {
        Unit::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    } */
    public function deleteMedia(Media $image){
        
        $image->delete();
        return response()->json([
            'success' => 'Record deleted successfully!'
        ]);
        // return back()->with(['danger' => 'Deleted']);

    }

    // public function getSelectedOption(Tag $tag)
    // {
    //     $options = explode( ',' , $tag->value_options);
    //     foreach($options as $key => $option){
    //         if(($this->tags()->wherePivot('tag_id' , $tag->id)->first()->pivot->tag_value ?? '') == $key){
    //             return $option;
    //         }
    //         else return 'No value Selected';
    //     }
    // }
}
