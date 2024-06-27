
    <form class="form-boder" id="signUpForm" action="{{ $route }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @if (Route::currentRouteName() === 'dashboard.units.edit')
            @method('PUT')
        @endif
        <!-- start step indicators -->
        <div class="form-header d-flex mb-40">
            <span class="stepIndicator">{{__('Details')}}</span>
            <span class="stepIndicator">{{ __('Amenities')}}</span>
            <span class="stepIndicator">{{ __('Property Media') }}</span>
        </div>
        <!-- end step indicators -->
    
        <!-- step one -->
        <div class="step">
            <h4 class="mb-40 text-center">{{__('Details')}}</h4>
            <div class="mb-30">
                <x-inputs.text inputClass="required" inputName="name" inputId="name" inputLabel="{{ __('Property Title') }}" inputRequired="required" inputValue="{{ old('name', $unit->name ?? '') }}" />
            </div>
            <div class="mb-30">
                <x-inputs.textarea inputName="description" inputId="description" inputLabel="{{ __('Property Description') }}" error="{{ $errors->has('description') ? $errors->first('description') : '' }}"  showButtons="false" inputValue="{!! old('description', $unit->description ?? '') !!}" inputClass=""  />    
                {{-- <x-inputs.textarea inputName="description" inputId="description" inputLabel="" inputRequired="" inputValue="{{ old('description', $unit->description ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/> --}}
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-30">
                        <x-inputs.select inputClass="required" inputName="property_type" inputId="property_type" inputLabel="{{ __('Property Type') }}" error="{{ $errors->has('property_type') ? $errors->first('property_type') : '' }}" :inputData="$unit->propertyTypes" showButtons="false" inputValue="{{ old('property_type', $unit->property_type ?? '') }}" inputRequired="required" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-30">
                        <x-inputs.select InputClass="required" inputName="property_status" inputId="property_status" inputLabel="{{ __('Property Status') }}" error="{{ $errors->has('property_status') ? $errors->first('property_status') : '' }}" :inputData="$unit->propertyStatuses" showButtons="false" inputValue="{{ old('property_status', $unit->property_status ?? '') }}" inputRequired="required" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-30">
                        <x-inputs.select InputClass="required" inputName="property_purpose" inputId="property_purpose" inputLabel="{{ __('Purpose For') }}" error="{{ $errors->has('property_purpose') ? $errors->first('property_purpose') : '' }}" :inputData="$unit->propertyPurposes" showButtons="false" inputValue="{{ old('property_purpose', $unit->property_purpose ?? '') }}" inputRequired="required" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-30">
                        <x-inputs.text inputClass="required" inputName="price" inputId="price" inputLabel="{{ __('All Inclusive Price (AED)') }}" inputRequired="required" inputValue="{{ old('price', $unit->price ?? '') }}" type="number"/>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-30">
                        <x-inputs.text inputName="area_sqft" inputId="area_sqft" inputLabel="{{ __('Area (Sqft)') }}" inputValue="{{ old('area_sqft', $unit->area_sqft ?? '0') }}" type="number"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-30">
                        <x-inputs.text inputName="bedrooms" inputId="bedrooms" inputLabel="{{ __('Bed Rooms') }}" inputValue="{{ old('bedrooms', $unit->bedrooms ?? '') }}" type="number" inputAttributes="max=99 min=1" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-30">
                        <x-inputs.text inputName="bathrooms" inputId="bathrooms" inputLabel="{{ __('Bathrooms') }}" inputValue="{{ old('bathrooms', $unit->bathrooms ?? '') }}" type="number" />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-30">
                        <x-inputs.select inputName="garage" inputId="garage" inputLabel="{{ __('Parking') }}" error="{{ $errors->has('garage') ? $errors->first('garage') : '' }}" :inputData="[false => 'No', true => 'Yes']" showButtons="false" inputValue="{{ old('garage', $unit->garage ?? '') }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-30">
                        <x-inputs.text inputName="property_id" inputId="property_id" inputLabel="{{ __('Property Id') }}" inputValue="{{ old('property_id', $unit->property_id ?? '') }}" />                
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-30">
                        <x-inputs.select inputName="property_ownership" inputId="property_ownership" inputLabel="{{ __('Property Ownership') }}" error="{{ $errors->has('property_ownership') ? $errors->first('property_ownership') : '' }}" :inputData="$unit->propertyOwnerships" showButtons="false" inputValue="{{ old('property_ownership', $unit->property_ownership ?? '') }}" />
                    </div>
                </div>
                {{-- <div class="col-lg-6">
                    <div class="mb-30">
                        <x-inputs.text inputName="land_size" inputId="land_size" inputLabel="{{ __('Plot Size') }}" inputValue="{{ old('land_size', $unit->land_size ?? '') }}" type="number" />
                    </div>
                </div> --}}
            </div>
            {{-- <div class="row">
                <div class="col-lg-6">
                    <div class="mb-30">
                        <x-inputs.text inputName="permit_no" inputId="permit_no" inputLabel="{{ __('Permit Number') }}" inputValue="{{ old('permit_no', $unit->permit_no ?? '') }}" />                
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-30">
                        <x-inputs.select inputName="property_ownership" inputId="property_ownership" inputLabel="{{ __('Property Ownership') }}" error="{{ $errors->has('property_ownership') ? $errors->first('property_ownership') : '' }}" :inputData="$unit->propertyOwnerships" showButtons="false" inputValue="{{ old('property_ownership', $unit->property_ownership ?? '') }}" />
                    </div>
                </div>
            </div> --}}
            <div class="mb-30">
                <div class="d-flex align-items-end">
                    <x-inputs.select inputName="project_id" inputId="project_id" inputLabel="{{ __('Project') }}" error="{{ $errors->has('project_id') ? $errors->first('project_id') : '' }}" :inputData="$projects" showButtons="false" inputValue="{{ old('project_id', $unit->project_id ?? '') }}" inputClass="select2" class="w-100" />
                    @can('project_create')
                    <button class="btn btn-light ms-10 h-75" id="openModelAddNewProject" type="button" data-bs-toggle="modal" data-bs-target="#addProjectModal"><i class="fa fa-plus"></i></button>                            
                    @endcan 
                </div>
            </div>
            <div class="row">
                <div >
                    <x-inputs.text inputName="address" inputId="address" inputLabel="{{ __('Address') }}" inputValue="{{ old('address', $unit->community ?? '') }}" class="mb-30" type="text"/>
                </div>
            </div>
            <div class="row">
                <label for="location">Location</label>
                <input type="hidden" name="location" id="location" value="{{ old('location', $unit->location ?? '35.52052844635452;35.80705384863964') }}" class="mb-30">        
                <div id="map" style="height: 400px; width: 100%" class="mb-30"></div>
            
            </div>
            {{-- <x-inputs.text inputName="location" inputId="location" inputLabel="{{ __('Location') }}" inputValue="{{ old('location', $unit->location ?? '') }}" class="mb-30" type="text"/> --}}
            @if (auth()->user()->isAgent || auth()->user()->isAdmin)
                <div class="row">
                    <div class="col-lg-6">
                        <ul class=" custom-check-box mb-30">
                            <li class="col d-inline">
                                <input type="checkbox" class="unit_check_box custom-control-input hide" id="availability" name="availability" value="1" {{ $unit->availability ? 'checked' : ''}}>
                                <label class="custom-control-label" for="availability">{{ __('Availability') }}</label>
                            </li>
                        </ul>
                        @if($errors->has('availability'))
                            <div class="invalid-feedback">{{ $errors->first('availability') }}</div>
                        @endif
                    </div>
                    <div class="col-lg-6">
                        <ul class=" custom-check-box mb-30">
                            @if (auth()->user()->isAdmin)
                                <li class="col d-inline">
                                    <input type="checkbox" class="unit_check_box custom-control-input hide" id="featuered" name="featuered" value="1" {{ $unit->featuered ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="featuered">{{ __('Featuered') }}</label>
                                </li>
                                <li class="col d-inline">
                                    <input type="checkbox" class="unit_check_box custom-control-input hide" id="published" name="published" value="1" {{ $unit->published ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="published">{{ __('Published') }}</label>
                                </li>
                            @endif   
                        </ul>
                        @if($errors->has('featuered'))
                            <div class="invalid-feedback">{{ $errors->first('featuered') }}</div>
                        @endif
                        @if($errors->has('published'))
                            <div class="invalid-feedback">{{ $errors->first('published') }}</div>
                        @endif
                    </div>
                </div>
            @endif
            @isset($agents)
                @if (auth()->user()->isAdmin)
                    <div class="mb-30">
                        <x-inputs.select inputName="user_id[]" inputId="user_id" inputLabel="{{ __('Assignee') }}" error="{{ $errors->has('user_id') ? $errors->first('user_id') : '' }}" :inputData="$agents" showButtons="false" :inputValue="old('user_id',  $unit->assignee ?? '')" inputClass="select2" class="w-100" inputType="multiple"/>
                    </div>
                @endif
            @endisset
        </div>

        <!-- step two -->
        <div class="step">
            <h4 class="text-center mb-40">{{ __('Amenities')}}</h4>
            <div class="row">
                <div class="col">
                    @include('website.partials.tags_list' , ['tagName' => 'Recreation and Family'])
                    @include('website.partials.tags_list' , ['tagName' => 'Health and Fitness'])
                    @include('website.partials.tags_list' , ['tagName' => 'Laundry and Kitchen'])
                    @include('website.partials.tags_list' , ['tagName' => 'Building'])
                    @include('website.partials.tags_list' , ['tagName' => 'Business and Security'])
                    @include('website.partials.tags_list' , ['tagName' => 'Miscellaneous'])
                    @include('website.partials.tags_list' , ['tagName' => 'Technology'])
                    @include('website.partials.tags_list' , ['tagName' => 'Features'])
                    @include('website.partials.tags_list' , ['tagName' => 'Cleaning and Maintenance'])
                </div>
            </div>
        </div>
    
        <!-- step three -->
        <div class="step">
            <h4 class="text-center mb-40">{{ __('Property Media') }}</h4>
            <div class="mb-30">
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
            <div class="mb-30">
                <div class="col-md-12 mb-30">
                    <label class="mb-30 font-fifteen font-500 w-100">{{__('Photos') }}</label>
                    <input type="file" id="photos" name="photos[]" class="form-control" multiple accept="jpeg">
                    <small style="color: red">
                        @error('photos.*')
                            {{$message}}
                        @enderror
                    </small>
                </div>
            </div>
            <div class="mb-30">
                <div class="col-md-12 mb-30">
                    <label class="mb-30 font-fifteen font-500 w-100">{{__('Attachment') }}</label>

                    @forelse($unit->attachments as $_file)
                    <div class="row mb-10" id="{{$_file->id}}">
                        <div class="col-11 justify-content-start">
                            <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a></p>
                        </div>
                        <div class="col">
                            <a href="#" parent-id="{{ $_file->id }}" data-value="{{route('dashboard.units.deleteMedia' , $_file)}}" class="delete-image cursor-pointer" ><i class="fas fa-trash"></i></a>
                        </div>
                    </div>
                    @empty
                        <span>No Attachments</span>
                    @endforelse

                    <div class="d-flex">
                        <input type="file" class="form-control" id="attachment-file" name="attachment-file[]">
                    </div>
                </div>
            </div>
            <div class="mb-30">
                <h6 class="mb-30">Floor Plans</h6>
                <div class="col-md-12 mb-30">
                    <label class="mb-30 font-fifteen font-700 w-100">{{__('Photos') }}</label>
                    @forelse($unit->floorPlanPhotos as $_file)
                        <div class="row mb-10" id="{{$_file->id}}">
                            <div class="col-11 justify-content-start">
                                <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a></p>
                            </div>
                            <div class="col">
                                <a href="#" parent-id="{{ $_file->id }}" data-value="{{route('dashboard.units.deleteMedia' , $_file)}}" class="delete-image cursor-pointer" ><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    @empty
                        <span>{{ __('No Floor Plan Photos') }}</span>
                    @endforelse

                    <div class="d-flex">
                        <input type="file" class="form-control" id="floorPlan-file" name="floorPlan-file[]" multiple>
                    </div>
                </div>
                <div>
                    <h6 class="mb-30">Details <small class="fst-italic fw-normal">(optional)</small></h6>
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
            </div>
            <div class="mb-30">
                <div>
                    <div id="newNearbyPlace" class="d-none">
                        @include('fullwidth.units.nearByPlaces' , ['nearbyPlace' => new \App\Models\Dashboard\NearbyPlace , 'loop_index' => 9999])
                    </div>
                    <h6 class="mb-30 mt-4">{{ __('Nearby Places')}}</h6>
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
                            <a id="addNewPlace" class="btn btn-primary">{{__('Add New Row')}}</a>
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
        <!-- start previous / next buttons -->
        <div class="form-footer d-flex">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
        </div>
        <!-- end previous / next buttons -->
    </form>

    <div class="modal fade " id="addProjectModal" aria-labelledby="addProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addProjectModalLabel">{{ __('Add New Project')}}</h1>
              <button type="button" class="btn-close closemodelAddNewProject" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <x-inputs.text inputName="project_name" inputId="project_name" inputLabel="{{ __('Name') }}" inputValue="{{ old('project_name', '') }}" class="mb-30"  />
                <x-inputs.select inputName="developer" inputLabel="{{ __('Developer')}}" inputId="developers" placeholder="{{ __('Developers') }}" :inputValue="old('developer')" :inputData="$developers" class="mb-30" inputClass="select2" showButtons="false" />                
                <x-inputs.select inputName="status" inputId="status" inputLabel="{{ __('Status') }}"  :inputData="$types" showButtons="false" inputValue="" class="mb-30"/>
                <x-inputs.text inputName="community" inputId="community" inputLabel="{{ __('Community') }}"  inputValue="{{ old('community') }}" class="mb-30"/>
                <x-inputs.select inputName="province" inputId="province" inputLabel="{{ __('Emirate') }}" :inputData="$emirates" showButtons="false" inputValue="" inputClass=" required" class="mb-30" />
                <x-inputs.select inputName="project_country" inputLabel="{{ __('Country')}}" inputId="project_country" placeholder="{{ __('Select Country') }}" inputValue="" :inputData="$countries" inputClass="select2 mb-30 required" showButtons="false" />
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
                $("#project_country").select2({
                    dropdownParent: $("#addProjectModal"),
                    width: '100%'
                })
                $("#cities").select2({
                // tags:true,
                })
            })

            let project_name = $('#project_name');
            let project_developer = $('#developers');
            let project_community = $('#community');
            let project_type = $('#type');
            let project_country = $('#project_country');
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

    @push('scripts')
        <script src="{{asset('assets/fullwidth/js/wizard/wizard.js')}}"></script>
    @endpush