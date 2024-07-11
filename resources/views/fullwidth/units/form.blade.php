<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-4">{{ __('Basic Information') }}</h4>
            <input type="hidden" name="forward" value="form">
            <div class="row">
                <div class="col-md-12 mb-30">
                    <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Property Title') }}" inputRequired="required" inputValue="{{ old('name', $unit->name ?? '') }}" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-30">
                    <x-inputs.textarea inputName="description" inputId="description" inputLabel="{{ __('Description') }}" inputRequired="" inputValue="{{ old('description', $unit->description ?? '') }}" />
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4 mb-30">
                    <x-inputs.select inputName="property_type" inputId="property_type" inputLabel="{{ __('Property Type') }}" error="{{ $errors->has('property_type') ? $errors->first('property_type') : '' }}" :inputData="$unit->propertyTypes" showButtons="false" inputValue="{{ old('property_type', $unit->property_type ?? '') }}" inputRequired="required" />
                </div>
                <div class="col-md-4 mb-30">
                    <x-inputs.select inputName="property_status" inputId="property_status" inputLabel="{{ __('Property Status') }}" error="{{ $errors->has('property_status') ? $errors->first('property_status') : '' }}" :inputData="$unit->propertyStatuses" showButtons="false" inputValue="{{ old('property_status', $unit->property_status ?? '') }}" inputRequired="required" />
                </div>
                @if (auth()->user()->isAgent || auth()->user()->isAdmin)
                    <div class="col-md-4">
                        <ul class=" custom-check-box mb-30">
                            <li class="col">
                                <input type="checkbox" class="unit_check_box custom-control-input hide" id="availability" name="availability" value="1" {{ $unit->availability ? 'checked' : ''}}>
                                <label class="custom-control-label" for="availability">{{ __('Availability') }}</label>
                            </li>
                            <li class="col">
                                <input type="checkbox" class="unit_check_box custom-control-input hide" id="featuered" name="featuered" value="1" {{ $unit->featuered ? 'checked' : ''}}>
                                <label class="custom-control-label" for="featuered">{{ __('Featuered') }}</label>
                            </li>
                            <li class="col">
                                <input type="checkbox" class="unit_check_box custom-control-input hide" id="published" name="published" value="1" {{ $unit->published ? 'checked' : ''}}>
                                <label class="custom-control-label" for="published">{{ __('Published') }}</label>
                            </li>
                        </ul>
                        @if($errors->has('availability'))
                            <div class="invalid-feedback">{{ $errors->first('availability') }}</div>
                        @endif
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-4 mb-30">
                    <x-inputs.text inputName="price" inputId="price" inputLabel="{{ __('Price (AED)') }}" inputRequired="required" inputValue="{{ old('price', $unit->price ?? '') }}" type="number"/>
                </div>
                <div class="col-md-4 mb-30">
                    <x-inputs.text inputName="area_sqft" inputId="area_sqft" inputLabel="{{ __('Area (sqft)') }}" inputRequired="" inputValue="{{ old('area_sqft', $unit->area_sqft ?? '0') }}"/>
                </div>
                <div class="col-md-4 mb-30">
                    <x-inputs.text inputName="bedrooms" inputId="bedrooms" inputLabel="{{ __('Rooms') }}" inputRequired="" inputValue="{{ old('bedrooms', $unit->bedrooms ?? '') }}" type="number" inputAttributes="max=99 min=1" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-4">{{ __('Detailed Information') }}</h4>
            <div class="row">
                
                <div class="col-lg-3 mb-30">
                    <x-inputs.text inputName="property_id" inputId="property_id" inputLabel="{{ __('Property Id') }}" inputRequired="" inputValue="{{ old('property_id', $unit->property_id ?? '') }}" />
                </div>
                <div class="col-lg-3 mb-30">
                    <x-inputs.text inputName="land_size" inputId="land_size" inputLabel="{{ __('Plot Size') }}" inputRequired="" inputValue="{{ old('land_size', $unit->land_size ?? '') }}" />
                </div>
                <div class="col-lg-6 mb-30">
                    <div class="input-group">
                        <x-inputs.select inputName="project_id" inputId="project_id" inputLabel="{{ __('Project') }}" error="{{ $errors->has('project_id') ? $errors->first('project_id') : '' }}" :inputData="$projects" showButtons="false" inputValue="{{ old('project_id', $unit->project_id ?? '') }}" inputClass="select2" class="w-75 pe-1" />
                        @can('project_create')
                            <button class="btn btn-light ms-10" id="openModelAddNewProject" type="button" data-bs-toggle="modal" data-bs-target="#addProjectModal"><i class="fa fa-plus"></i></button>                            
                        @endcan 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-30">
                    <x-inputs.text inputName="bathrooms" inputId="bathrooms" inputLabel="{{ __('Bathrooms') }}" inputRequired="" inputValue="{{ old('bathrooms', $unit->bathrooms ?? '') }}" type="number" />
                </div>
                <div class="col-lg-4 mb-30">
                    <x-inputs.select inputName="garage" inputId="garage" inputLabel="{{ __('Parking') }}" error="{{ $errors->has('garage') ? $errors->first('garage') : '' }}" :inputData="[false => 'No', true => 'Yes']" showButtons="false" inputValue="{{ old('garage', $unit->garage ?? '') }}" />
                </div>
                <div class="col-lg-4 col-md-6 mb-30">
                    <x-inputs.text inputName="garage_size" inputId="garage_size" inputLabel="{{ __('Parking Size') }}" inputRequired="" inputValue="{{ old('garage_size', $unit->garage_size ?? '') }}" inputHint="" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-30">
                    <x-inputs.text inputName="age_year" inputId="age_year" inputLabel="{{ __('Age (Years)') }}" inputRequired="" inputValue="{{ old('age_year', $unit->age_year ?? '') }}" type="number" />
                </div>
                <div class="col-lg-8 col-md-12 mb-30">
                    <x-inputs.text inputName="yt_video_url" inputId="yt_video_url" inputLabel="{{ __('YT Video URL') }}" inputRequired="" inputValue="{{ old('yt_video_url', $unit->yt_video_url ?? '') }}" inputHint="" />
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h6 class="mb-30">{{ __('Property Features') }}</h6>
                    <ul class="row row-cols-lg-3 row-cols-1 custom-check-box mb-30">
                        @foreach($features as $key => $feature)
                            <li class="col">
                                <input type="checkbox" class="custom-control-input hide" id="customCheck-{{$key}}" name="propertyFeatures[]" value="{{$key}}" {{ $unit->tags->contains($key) ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customCheck-{{$key}}">{{ $feature}}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-4">{{ __('Property Media') }}</h4>
            <p>Add unit's photos here.</p>
            <div class="form-row">
                <div class="col-md-12 mt-20">
                    <ul class="row row-cols-xl-6 row-cols-md-3 row-cols-2 media-upload">
                        @if (isset($unit->thumbImage))                        
                            @foreach($unit->thumbImage as $_media)
                                <li class="col" id="{{ $_media->id }}">
                                    <img src="{{ $_media->getUrl('thumb')}}" class="rounded pb-30" alt="{{ $_media->name }}">
                                    <a href="#" ><i class="fas fa-trash"></i></a>
                                    <a parent-id="{{ $_media->id }}" data-value="{{route('dashboard.units.deleteMedia' , $_media)}}" class="delete-image"><i class="fas fa-trash"></i></a>
                                </li>
                            @endforeach    
                        @endif
                    </ul>
                </div>
                <div class="col-md-12 mb-30">
                    <input type="file" id="photos" name="photos[]" class="form-control" multiple accept="jpeg">
                    <small style="color: red">
                        @error('photos.*')
                            {{$message}}
                        @enderror
                    </small>
                </div>
                <div class="col-md-12 mb-30">
                    <label class="mb-30 font-fifteen font-500 w-100">{{__('Attachment') }}</label>
                    <div class="d-flex">
                        <input type="file" class="form-control" id="attachment-file" name="attachment-file[]">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Floor Plan --}}

<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-4">Aditional Information</h4>
            <p>Attached floor plans will be displayed in the project details page</p>
            
            <div>
                <h6 class="mb-3">Floor Plans</h6>
                <div id="newFloorPlan" class="d-none">
                    @include('fullwidth.units.floorPlans' , ['floor' => new \App\Models\Dashboard\Floor , 'loop_index' => 9999])
                </div>
                @if ($unit->floors->count())
                    <div class="accordion" id="formContainer">
                        @foreach ($unit->floors as $floor)
                            <div class="accordion-item" style="border: none" id="{{$loop->index}}floor">
                                @include('fullwidth.units.floorPlans', ['loop_index' => $loop->index])
                            </div>
                        @endforeach
                    </div>
                @else
                    <div id="formContainer">
                        @include('fullwidth.units.floorPlans' , ['floor' => new \App\Models\Dashboard\Floor , 'loop_index' => 0])
                    </div>
                @endif
                <div class="col-xl-12 col-lg-12 col-md-12 mt-4">
                    <a href="#" id="addfloor" class="btn btn-primary">{{__('Add New Tab')}}</a>
                </div>
                
            </div>
            <div>
                <div id="newNearbyPlace" class="d-none">
                    @include('fullwidth.units.nearByPlaces' , ['nearbyPlace' => new \App\Models\Dashboard\NearbyPlace , 'loop_index' => 9999])
                </div>
                <h6 class="mb-3 mt-4">Nearby Places</h6>
                {{-- alertasd --}}
                {{-- <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> --}}
                @if ($unit->places->count())  
                    <div class="tab-simple tab-action">
                        <div class="tab-element">
                            <div class="tab-pane tab-hide" >
                                <div class="form-boder">
                                    <div id="placeContainer" class="mb-30">
                                        @foreach ($unit->places as $nearbyPlace)
                                            @include('fullwidth.units.nearByPlaces', ['loop_index' => $loop->index ?? 0  ])
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 mt-20">
                        <a id="addNewPlace" class="btn btn-primary">Add New Row</a>
                    </div>
                @else
                    <div class="tab-simple tab-action">
                        <div class="tab-element">
                            <div class="tab-pane tab-hide" >
                                <div class="form-boder">
                                    <div id="placeContainer" class="mt-2">
                                        @include('fullwidth.units.nearByPlaces' , ['nearbyPlace' => new \App\Models\Dashboard\NearbyPlace , 'loop_index' => 0])
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12 mt-20">
                                <a id="addNewPlace" class="btn btn-primary">Add New Row</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<button type="submit" class="btn btn-primary" name="submitbasic">Save</button>
<a class="btn btn-secondary" href="{{ route('dashboard.units.index') }}">{{ __('Close') }}</a>



<div class="modal fade" id="addProjectModal" aria-labelledby="addProjectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addProjectModalLabel">{{ __('Add New Project')}}</h1>
          <button type="button" class="btn-close closemodelAddNewProject" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <x-inputs.text inputName="project_name" inputId="project_name" inputLabel="{{ __('Name') }}" inputValue="{{ old('project_name', '') }}" class="mb-30"  />
            <x-inputs.select inputName="developer" inputLabel="{{ __('Developer')}}" inputId="developers" placeholder="{{ __('Developers') }}" :inputValue="old('developer')" :inputData="$developers" class="mb-30" inputClass="select2" showButtons="false" />
            <x-inputs.select inputName="type" inputId="type" inputLabel="{{ __('Status') }}"  :inputData="$types" showButtons="false" inputValue="" class="mb-30"/>
            <x-inputs.text inputName="community" inputId="community" inputLabel="{{ __('Community') }}"  inputValue="{{ old('community') }}" inputHint="" inputClass="" class="mb-30"/>
            <x-inputs.select inputName="province" inputId="province" inputLabel="{{ __('Emirate') }}" inputRequired="" :inputData="$emirates" showButtons="false" inputValue="" inputClass=" required" class="mb-30" />
            <x-inputs.select inputName="country" inputLabel="{{ __('Country')}}" inputId="country" placeholder="{{ __('Select Country') }}" inputValue="" :inputData="$countries" inputClass="select2 mb-30 required" showButtons="false" />
        </div>
        <div class="modal-footer">
          <button type="button" id="saveProject" class="btn btn-primary closemodelAddNewProject" data-bs-dismiss="modal">{{ __('Add') }}</button>
        </div>
      </div>
    </div>
</div>
        @can('project_create')
                @can('developer_create')
                @push('scripts')
                    <script>
                        $(document).ready(function(){
                            $("#developers").select2({
                                    dropdownParent: $("#addProjectModal"),
                                    tags:true,
                                    width: '100%'
                                }) 
                        });
                    </script>
                @endpush
                @else
                @push('scripts')
                    <script>
                        $(document).ready(function(){
                            $("#developers").select2({
                                    dropdownParent: $("#addProjectModal"),
                                    width: '100%'
                                }) 
                        });
                    </script>
                @endpush
            @endcan
        @endcan
    @push('scripts')
        <script>
            $(document).ready(function(){
                $("#country").select2({
                        dropdownParent: $("#addProjectModal"),
                        width: '100%'
                    })
            })

                let project_name = $('#project_name');
                let project_developer = $('#developers');
                let project_community = $('#community');
                let project_type = $('#type');
                let project_country = $('#country');
                let province = $('#province');

                $('#saveProject').on('click', function(event) {
                    $.ajax({
                        url: '{{ route('api.projects.store') }}',
                        type: "POST",
                        data: { 
                            name:project_name.val(),
                            developer:project_developer.val(),
                            community:project_community.val(),
                            type:project_type.val(),
                            country:project_country.val(),
                            province:province.val(),
                        },
                        success: function(response) {
                            swal.fire({
                                title: "Done!",
                                text: "Your New Project Has Been Added!",
                                icon: "success"
                            });
                            console.log(response.data)
                            var newOption = new Option(response.data.name, response.data.id, false, false)
                            $('#project_id').append(newOption).trigger('change')
                        },
                        error: function (request, status, error) {
                            swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: "Make Sure You Provided All Information!",
                            });
                            console.log("request: "+request.toJSON())
                            console.log("status: "+status)
                            console.log("error: "+error)
                        }
                    });
                    event.preventDefault();
                    return false;
                });
        </script>
    @endpush

    @include('fullwidth.units.Scripts')

{{-- @push('scripts')
    <script>

        let checkboxes = document.getElementsByClassName('unit_check_box');


        for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', function() {

            if (!this.checked) {

            this.value = 0;
            }else if(this.checked) {
            this.value = 1;
            }
        });
        }
    </script>
@endpush --}}
