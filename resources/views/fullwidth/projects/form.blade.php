@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script src="{{ asset('assets/fullwidth/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#project_features'
    });
    </script>
@endsection
@include('website.partials.Dashboard-map-integration')
<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <div class="row">
                <div class="col-lg-12">
                    <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Project Name') }}" inputRequired="required" inputValue="{{ old('name', $project->name ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <x-inputs.textarea inputName="description" inputId="description" inputLabel="{{ __('Project Description') }}" inputRequired="" inputValue="{{ old('description', $project->description ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="form-label" for="developers">{{ __('Developer') }}</label>
                    <div class="input-group mb-3">
                        <select class="select2 {{ $errors->has('developers') ? 'is-invalid' : '' }}" name="developer" placeholder="{{ __('Developers') }}" id="developers">
                            @foreach($developers as $id => $item)
                                <option value="{{ $id }}"{{ $project->developers->contains($id) ? ' selected' : '' }}>{{ $item }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('developers'))
                            <span class="text-danger">{{ $errors->first('developers') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <x-inputs.select inputName="status" inputId="status" inputLabel="{{ __('Status') }}" inputRequired="required" :inputData="$types" showButtons="false" inputValue="{{ $project->status ?? '' }}" />
                </div>
                <div class="col-lg-6">
                    <x-inputs.select inputName="opening_date" inputId="opening_date" inputLabel="{{ __('Completion Date') }}" inputRequired="" :inputData="$openDates" showButtons="false" inputValue="{{ old('opening_date', $project->opening_date) }}" class="mb-30" />
                </div>
            </div>
            {{-- <div class="row mb-30">
                <div class="col-lg-4">
                    <x-inputs.select inputName="cities[]" inputId="cities" inputLabel="{{ __('Cities') }}" placeholder="{{ __('Select Cities') }}" :inputValue="old('cities',  $project->cities ?? '')" :inputData="$cities" inputClass="select2 mb-30" inputType="multiple" multiple="false" showButtons="false" />
                </div>
                <div class="col-lg-4">
                    <x-inputs.select inputName="province" inputId="province" inputLabel="{{ __('Emirate') }}" :inputData="$emirates" showButtons="false" inputValue="{{ old('province', $project->province) }}" />
                    
                </div>
                <div class="col-lg-4">
                    <x-inputs.select inputName="country" inputLabel="{{ __('Country')}}" inputId="country" placeholder="{{ __('Select Country') }}" :inputValue="old('country') ?? $project->country" :inputData="$countries" inputClass="select2 mb-30 required" showButtons="false" inputRequired="required"/>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-6">
                    <x-inputs.text inputName="community" inputId="community" inputLabel="{{ __('Community') }}" inputRequired="required" inputValue="{{ old('community', $project->community ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
                </div>
            </div>
            <div class="row">
                <label for="location">Location</label>
                <input type="hidden" name="location" id="location" value="{{ old('location', $project->location ?? '35.52052844635452;35.80705384863964') }}">        
                <div id="map" style="height: 400px; width: 100%" class="mb-30"></div>
            
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <x-inputs.text inputName="project_type" inputId="project_type" inputLabel="{{ __('Project Type') }}" inputRequired="" inputValue="{{ old('project_type', $project->project_type ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
                </div>
            </div>
            <x-inputs.textarea inputName="project_features" inputId="project_features" inputLabel="{{__('Project Features')}}" error="{{ $errors->has('project_features') ? $errors->first('project_features') : '' }}"  showButtons="false" inputValue="{!! old('project_features', $project->project_features ?? '') !!}"/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <div class="mb-3">
                <h4 class="mb-4">{{ __('Additional Information') }}</h4>
                <p>{{ __('Attached range plans will be displayed in the project details page') }}</p>
                <div>
                    <h6 class="mb-3">{{ __('Price & Size Ranges') }}</h6>
                    @if ($project->ranges->count())
                        <div class="accordion" id="formContainer">
                            @foreach ($project->ranges as $range)
                                <div class="accordion-item" style="border: none" id="{{$loop->index}}range">
                                    @include('fullwidth.projects.rangePlans', ['loop_index' => $loop->index])
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div id="formContainer">
                            @include('fullwidth.projects.rangePlans' , ['range' => new \App\Models\Dashboard\Range , 'loop_index' => 0])
                        </div>
                    @endif
                    <div class="col-xl-12 col-lg-12 col-md-12 mt-4">
                        <a href="#" id="addrange" class="btn btn-primary">{{__('Add New Tab')}}</a>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div>
                    <div id="newNearbyPlace" class="d-none">
                        @include('fullwidth.units.nearByPlaces' , ['nearbyPlace' => new \App\Models\Dashboard\NearbyPlace , 'loop_index' => 9999])
                    </div>
                    <h6 class="mb-3 mt-4">Nearby Places</h6>
                    @if ($project->places->count())  
                        <div class="tab-simple tab-action">
                            <div class="tab-element">
                                <div class="tab-pane tab-hide" >
                                    <div class="form-boder">
                                        <div id="placeContainer" class="mb-30">
                                            @foreach ($project->places as $nearbyPlace)
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
</div>
<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <div class="row">
                <div class="col mb-30">
                    <div class="border rounded bg-white p-30">
                        <h4 class="mb-4">{{ __('Cover') }}</h4>
                        @forelse($project->attachments as $_file)
                        <div class="row mb-10" id="{{$_file->id}}">
                            <div class="col-11 justify-content-start">
                                <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a></p>
                            </div>
                            <div class="col">
                                <a href="#" parent-id="{{ $_file->id }}" data-value="{{route('dashboard.units.deleteMedia' , $_file)}}" class="delete-files cursor-pointer" ><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                        @empty
                            <span>No Attachments</span>
                        @endforelse
                        <div class="form-row">
                            <div class="col mb-20">
                                <input type="file" id="attachments" name="attachments[]" class="form-control {{ $errors->has('atachments') ? 'is-invalid' : '' }}" multiple="multiple">
                                @if($errors->has('attachments'))
                                    <span class="text-danger">{{ $errors->first('attachments') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-30">
                    <div class="border rounded bg-white p-30">
                        <h4 class="mb-4">{{ __('Project Photos') }}</h4>
                        @forelse($project->projectPhotos as $_file)
                            <div class="row mb-10" id="{{$_file->id}}">
                                <div class="col-11 justify-content-start">
                                    <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a></p>
                                </div>
                                <div class="col"> {{--api.media.destroy--}}
                                    <a href="#" parent-id="{{ $_file->id }}" data-value="{{route('dashboard.units.deleteMedia' , $_file)}}" class="delete-files cursor-pointer" ><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        @empty
                            <span>No Project Photos</span>
                        @endforelse
                        <div class="form-row">
                            <div class="col mb-20">
                                <input type="file" id="projectPhotos" name="projectPhotos[]" class="form-control {{ $errors->has('projectPhotos') ? 'is-invalid' : '' }}" multiple="multiple">
                                @if($errors->has('projectPhotos'))
                                    <span class="text-danger">{{ $errors->first('projectPhotos') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-30">
                    <div class="border rounded bg-white p-30">
                        <h4 class="mb-4">{{ __('Availability List') }}</h4>
                        @forelse($project->availabilityList as $_file)
                        <div class="row mb-10" id="{{$_file->id}}">
                            <div class="col-11 justify-content-start">
                                <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a></p>
                            </div>
                            <div class="col">
                                <a href="#" parent-id="{{ $_file->id }}" data-value="{{route('dashboard.units.deleteMedia' , $_file)}}" class="delete-files cursor-pointer" ><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                            
                        @empty
                            <span>{{ __('No Availability List File') }}</span>
                        @endforelse
                        <div class="form-row">
                            <div class="col mb-20">
                                <input type="file" id="availabilityList" name="availabilityList" class="form-control {{ $errors->has('availabilityList') ? 'is-invalid' : '' }}">
                                @if($errors->has('availabilityList'))
                                    <span class="text-danger">{{ $errors->first('availabilityList') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-30">
                    <div class="border rounded bg-white p-30">
                        <h4 class="mb-4">{{ __('Payment Plan') }}</h4>
                        @forelse($project->paymentPlan as $_file)
                            <div class="row mb-10" id="{{$_file->id}}">
                                <div class="col-11 justify-content-start">
                                    <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a></p>
                                </div>
                                <div class="col">
                                    <a href="#" parent-id="{{ $_file->id }}" data-value="{{route('dashboard.units.deleteMedia' , $_file)}}" class="delete-files cursor-pointer" ><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        @empty
                            <span>No Payment Plan</span>
                        @endforelse
                        <div class="form-row">
                            <div class="col mb-20">
                                <input type="file" id="paymentPlan" name="paymentPlan" class="form-control {{ $errors->has('paymentPlan') ? 'is-invalid' : '' }}">
                                @if($errors->has('paymentPlan'))
                                    <span class="text-danger">{{ $errors->first('paymentPlan') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col mb-30">
                    <div class="border rounded bg-white p-30">
                        <h4 class="mb-4">{{ __('Brochure') }}</h4>
                        @forelse($project->brochure as $_file)
                            <div class="row mb-10" id="{{$_file->id}}">
                                <div class="col-11 justify-content-start">
                                    <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a></p>
                                </div>
                                <div class="col">
                                    <a href="#" parent-id="{{ $_file->id }}" data-value="{{route('dashboard.units.deleteMedia' , $_file)}}" class="delete-files cursor-pointer" ><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        @empty
                            <span>No Brochure</span>
                        @endforelse
                        <div class="form-row">
                            <div class="col mb-20">
                                <input type="file" id="brochure" name="brochure" class="form-control {{ $errors->has('brochure') ? 'is-invalid' : '' }}">
                                @if($errors->has('brochure'))
                                    <span class="text-danger">{{ $errors->first('brochure') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> {{ __('Save') }}</button>
<a class="btn btn-secondary" href="{{ route('dashboard.projects.index') }}">{{ __('Close') }}</a>

<div class="modal fade" id="addDeveloperModal" tabindex="-1" aria-labelledby="addDeveloperModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addDeveloperModalLabel">{{ __('Add New Developer')}}</h1>
                <button type="button" class="btn-close closemodelAddNewDeveloper" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <x-inputs.text inputName="developer_name" inputId="developer_name" inputLabel="{{ __('Name') }}" inputValue="{{ old('developer_name', '') }}" class="mb-30" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="saveDeveloper" class="btn btn-primary closemodelAddNewDeveloper" data-bs-dismiss="modal">{{ __('Add') }}</button>
            </div>
        </div>
    </div>
</div>

{{-- @include('fullwidth.modals.paymentModal') --}}
@include('fullwidth.projects.Scripts')

@push('scripts')
    <script>
        $(document).ready(function() {
            var developer_name = $('#developer_name');

            $(document).on('click', '#openModelAddNewDeveloper', function(){
                developer_name.attr('required', 'true');
            });

            $(document).on('click', '.closemodelAddNewDeveloper', function(){
                developer_name.removeAttr("required");
            });

            $('#saveDeveloper').on('click', function(event) {
                
                $.ajax({
                    type: "POST",
                    url: '{{ route('api.developers.store') }}',
                    data: { 
                        name:developer_name.val(),
                    },
                    success: function(response) {
                        console.log(response.data)
                        var newOption = new Option(response.data.name, response.data.id, false, false)
                        $('#developers').append(newOption).trigger('change')
                        alert('Added')
                        // Swal.fire({
                        //     text: '{{ trans('global.added') }}',
                        //     icon: 'success',
                        //     confirmButtonText: 'Ok'
                        //     })
                        developer_name.val(' ')
                    },
                    error: function (request, status, error) {
                        // Swal.fire({
                        //     text: error,
                        //     icon: 'error',
                        //     confirmButtonText: 'Close'
                        //     })
                        alert('Error!')
                        console.log("request: "+request.toJSON())
                        console.log("status: "+status)
                        console.log("error: "+error)
                    }
                });
                event.preventDefault();
                return false;
            });
        });
    </script>

    <script>
        function format(item, state) {
            if (!item.id) {
                return item.text;
            }
            var countryUrl = "https://hatscripts.github.io/circle-flags/flags/";
            var stateUrl = "https://oxguy3.github.io/flags/svg/us/";
            var url = state ? stateUrl : countryUrl;
            var img = $("<img>", {
                class: "img-flag pe-10",
                width: 26,
                src: url + item.element.value.toLowerCase() + ".svg"
            });
            var span = $("<span>", {
                text: " " + item.text
            });
            span.prepend(img);
            return span;
        }

        $(document).ready(function() {
            $("#country").select2({
                templateResult: function(item) {
                    return format(item, false);
                }
            });
        });
    </script>

    @can('developer_create')
        <script>
            $(document).ready(function () {
                $("#developers").select2({
                    tags: true,
                    width: '100%'
                })
            })
        </script>
    @endcan
@endpush

@push('scripts')
    <script>
        $(document).ready(function(){
            $("#cities").select2({
                // tags:true,
            })
        });
    </script>


    {{-- DELETE PHOTOS --}}
    <script>
        $(document).ready(function() {
            $('.delete-files').on('click', function(event) {
                swal.fire({
                        title: "Are you sure?",
                        text: "You'r About To Delete This Record",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#808080",
                        confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let delete_url = $(this).attr('data-value')
                        let liId = $(this).attr('parent-id')
                        $.ajax({
                            type: "DELETE",
                            url: delete_url,
                            success: function(response) {
                                console.log(response.data)
                                $('#' + liId).remove();
                            },
                            error: function (request, status, error) {
                                alert('Error!')
                                console.log("request: "+request.toJSON())
                                console.log("status: "+status)
                                console.log("error: "+error)
                            }
                        });
                        event.preventDefault();
                            swal.fire({
                                title: "Deleted!",
                                text: "Your Record has been deleted.",
                                icon: "success"
                            });
                        }
                    });
                return false;
            });
        });
    </script>
@endpush
