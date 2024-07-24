
@extends('website.layout.app-blog')
@section('pageTitle', __($project->name) . ' | ' . __('Projects') . ' | ' . config('panel.website_title'))
@section('pageDescription', __($project->name) . ', ' . __('Projects') . ' | ' . config('panel.website_title'))
@include('website.partials.website-map-integration')
@section('content')
    @include('website.layout.title-banner-light')
<!--============== Property Slider Start ==============-->
    <div class="full-row p-0 mb-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="single-project" style="width:1200px; height:600px; margin:0 auto 30px;">
                        @if ($project->coverImage)
                            <div class="ls-slide" data-ls="duration:7500; transition2d:5; kenburnszoom:in; kenburnsscale:1.2;"> <img width="1920" height="1280" src="{{ $project->coverImage ?? '' }}" class="ls-bg" alt="{{ $project->name }} covor image" /> </div>
                        @endif
                        @if ($project->projectPhotos->count())
                            @foreach ($project->projectPhotos as $_photo)
                                <div class="ls-slide" data-ls="duration:7500; transition2d:5; kenburnszoom:in; kenburnsscale:1.2;"> <img width="1920" height="1280" src="{{ $_photo->getUrl() }}" class="ls-bg" alt="{{ $project->name }} image {{ $loop->iteration }}" /> </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Property Details Start --}}
    <div class="full-row pt-30">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 order-xl-2">
                    <!-- Message Form -->
                    @include('website.partials.contact_form')
                    
                    <!-- Property Search -->

                    @include('website.partials.recent-projects')
                    <!--============== Recent Property Widget End ==============-->
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="property-overview border summary rounded bg-white p-30 mb-30">
                        <div class="row mb-4">
                            <div class="col-auto">
                                <div class="post-meta font-small text-uppercase list-color-primary">
                                    <a name="project-status" class="listing-ctg"><i class="fa-solid fa-building"></i><span>{{$project->project_type}}</span></a>
                                </div>
                                <h4 class="listing-title">
                                    <a href="{{route('projects.show', ['project' => $project])}}">{{$project->name}}</a>
                                </h4>
                                <span class="listing-location">
                                    <i class="fas fa-map-marker-alt text-primary"></i> {{$project->fullLocation ?? 'No location Info'}}
                                </span>
                                <a href="#" class="d-block text-light hover-text-primary font-small mb-2">{{$project->recommendedCount ? '( ' . $project->recommendedCount . ' People Recommended )' : ''}}</a>
                            </div>
                            <div class="col-auto ms-auto xs-m-0 text-end xs-text-start pb-4">
                                <span class="listing-price">{{__('From')}} {{config('panel.currency')}} {{$project->minPrice}}</span>
                                <span class="text-white font-mini px-2 rounded product-status ms-auto xs-m-0 py-1 bg-primary"><i class="fas fa-check"></i> {{$project->statusText}}</span>
                            </div>
                            <div class="col-12">
                                <ul class="quick-meta mt-4">
                                    {{-- wwww --}}
                                    {{-- {{dd($shareLink['facebook'])}} --}}
                                    {{-- <li class="bg-light"><a href="#" title="Add to compare" class="text-dark"><i class="flaticon-transfer flat-mini"></i></a></li> --}}
                                    {{-- @if (auth()->user())
                                        <li onclick="toggleIconClass(this.querySelector('i:first-child'))" class="bg-light">
                                            <a href="#" link="{{route('api.new-favorite' , ['unit' => $project])}}" title="Add fa" class="text-dark">
                                                <i class="{{$project->isFavourite ? 'fa fa-heart' : 'flaticon-like-1'}} flat-mini"></i>
                                            </a>
                                        </li>
                                    @endif --}}
                                    <li class="bg-light">
                                        <a href="#" onclick="window.print();" title="Print Data" target="blank" class="text-dark"><i class="flaticon-printer flat-mini"></i></a>
                                    </li>
                                    <li class="bg-light"><a href="{{$shareLink['facebook']}}" title="Media share" class="text-dark" ><i class="bi bi-facebook flat-mini"></i></a></li>
                                    <li class="bg-light"><a href="{{$shareLink['twitter']}}" title="Media share" class="text-dark" ><i class="bi bi-twitter-x flat-mini"></i></a></li>
                                    <li class="bg-light"><a href="{{$shareLink['telegram']}}" title="Media share" class="text-dark" ><i class="bi bi-telegram flat-mini"></i></a></li>
                                    <li class="bg-light d-sm-none"><a href="{{$shareLink['whatsapp']}}" title="Media share" class="text-dark" ><i class="bi bi-whatsapp flat-mini"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row row-cols-1">
                            <div class="col">
                                <h5 class="mb-3">Description</h5>
                                <p>{!!$project->description ?? ''!!}</p>
                            </div>
                        </div>
                    </div>
                    @if ($project->project_features)
                        <div class="property-overview border rounded bg-white p-30 mb-30">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <h5 class="mb-3">{{ __('Project Features') }}</h5>
                                    {!!$project->project_features!!}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="property-overview border rounded bg-white p-30 mb-30">
                        @if ($project->brochure->count())
                            <div class="row row-cols-1">
                                <div class="col">
                                    {{-- Property Features --}}
                                    <h5 class="mb-3">{{ __('Brochure') }}</h5>
                                    @foreach($project->brochure as $_file)
                                        <div class="row mb-10" id="{{$_file->id}}">
                                            <div class="col-11 justify-content-start">
                                                @auth
                                                    <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ __('Download File') }} {{ $loop->count > 1 ? $loop->iteration : '' }}</a></p>
                                                @endauth
                                                @guest
                                                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#downloadAttachment" data-bs-value="{{ $_file->getUrl() }}">{{ __('Download File') }} {{ $loop->count > 1 ? $loop->iteration : '' }}</button>
                                                @endguest
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if ($project->availabilityList->count())
                            <div class="row row-cols-1">
                                <div class="col">
                                    <h5 class="mb-3">{{ __('Availability List') }}</h5>
                                    @foreach($project->availabilityList as $_file)
                                        <div class="row mb-10" id="{{$_file->id}}">
                                            <div class="col-11 justify-content-start">
                                                @auth
                                                    <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ __('Download File') }} {{ $loop->count > 1 ? $loop->iteration : '' }}</a></p>
                                                @endauth
                                                @guest
                                                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#downloadAttachment" data-bs-value="{{ $_file->getUrl() }}">{{ __('Download File') }} {{ $loop->count > 1 ? $loop->iteration : '' }}</button>
                                                @endguest
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if ($project->paymentPlan->count())
                            <div class="row row-cols-1">
                                <div class="col">
                                    <h5 class="mb-3">{{ __('Payment Plan') }}</h5>
                                    @foreach($project->paymentPlan as $_file)
                                        <div class="row mb-10" id="{{$_file->id}}">
                                            <div class="col-11 justify-content-start">
                                                @auth
                                                    <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ __('Download File') }} {{ $loop->count > 1 ? $loop->iteration : '' }}</a></p>
                                                @endauth
                                                @guest
                                                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#downloadAttachment" data-bs-value="{{ $_file->getUrl() }}">{{ __('Download File') }} {{ $loop->count > 1 ? $loop->iteration : '' }}</button>
                                                @endguest
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="property-overview border rounded bg-white p-30 mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                <h5 class="mb-3">{{ __('More Information') }}</h5>
                                <ul class="list-three-fold-width">
                                    @if ($project->developers->count())
                                        <li>
                                            <span class="font-500">{{ _('Developers') }}:</span> 
                                            @foreach ($project->developers as $_developer)
                                                <span class="badge bg-primary fs-6 m-1">{{ $_developer->name }}</span>
                                            @endforeach
                                        </li>
                                    @endif
                                    @if ($project->opening_date)
                                        <li><span class="font-500">{{ _('Completion Date') }}:</span> {{$project->opening_date}}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if ($project->ranges->count())
                        <div class="property-overview border rounded bg-white p-30 mb-30">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <h5 class="mb-3">{{__('Size & Price Ranges')}}</h5>
                                    <div class="accordion" id="formContainer">
                                        @foreach ($project->ranges as $range)
                                            <div class="accordion-item" style="border: none" id="{{$loop->index}}range">
                                                @include('fullwidth.projects.rangePlans', ['loop_index' => $loop->index , 'readonly' => true])
                                            </div>
                                        @endforeach
                                    </div>  
                                </div>
                            </div>
                        </div>
                                      
                                @endif
                    @if ($project->places->count())
                        <div class="property-overview border rounded bg-white p-30 mb-30">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <h5 class="mb-3">Nearby Places</h5>
                                    <div class="tab-simple tab-action">
                                        <ul class="nav-tab-line list-color-secondary d-table mb-3">
                                            @if ($project->hasHospital)
                                                <li class="{{($project->hasHospital) ? 'active' : ''}}" data-target="#tb-panel-1">Hospital</li>
                                            @endif
                                            @if ($project->hasShopping)
                                                <li class="{{(!$project->hasHospital && $project->hasShoppin) ? 'active' : ''}}" data-target="#tb-panel-2">Shopping</li>
                                            @endif
                                            @if ($project->hasSchool)
                                                <li class="{{(!$project->hasHospital && !$project->hasShopping && $project->hasSchool) ? 'active' : ''}}" data-target="#tb-panel-3">School</li>
                                            @endif
                                            @if ($project->hasResturant)
                                                <li class="{{(!$project->hasHospital && !$project->hasShopping && !$project->hasSchool && $project->hasResturant) ? 'active' : ''}}" data-target="#tb-panel-4">Resturant</li>
                                            @endif
                                        </ul>
                                        {{--  --}}
                                        <div class="tab-element">
                                            <!-- Hosiptal data -->
                                            @if ($project->hasHospital)
                                                <div class="tab-pane tab-hide" id="tb-panel-1" style="display: block;">
                                                    <div class="table-striped overflow-x-scroll pb-2">
                                                        <table class="w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" class="font-fifteen">Name</th>
                                                                    <th scope="col" class="font-fifteen">Distance</th>
                                                                    <th scope="col" class="font-fifteen">Minutes</th>
                                                                    <th scope="col" class="font-fifteen">Type</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($project->places as $hospital)
                                                                    @if ($hospital->main_type == 'hospital')
                                                                        <tr>
                                                                            <td class="text-break">{{$hospital->name}}</td>
                                                                            <td class="text-break">{{$hospital->distance}} km</td>
                                                                            <td class="text-break">{{$hospital->minutes}}</td>
                                                                            <td class="text-break">{{$hospital->sub_type}}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- Shpping Data -->
                                            @if ($project->hasShopping)
                                                <div class="tab-pane tab-hide" id="tb-panel-2" style="display: block;">
                                                    <div class="table-striped overflow-x-scroll pb-2">
                                                        <table class="w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" class="font-fifteen">Name</th>
                                                                    <th scope="col" class="font-fifteen">Distance</th>
                                                                    <th scope="col" class="font-fifteen">Minutes</th>
                                                                    <th scope="col" class="font-fifteen">Type</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($project->places as $shopping)
                                                                    @if ($shopping->main_type == 'shopping')
                                                                        <tr>
                                                                            <td class="text-break">{{$shopping->name}}</td>
                                                                            <td class="text-break">{{$shopping->distance}} km</td>
                                                                            <td class="text-break">{{$shopping->minutes}}</td>
                                                                            <td class="text-break">{{$shopping->sub_type}}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- Shpping Data -->
                                            @if ($project->hasSchool)
                                                <div class="tab-pane tab-hide" id="tb-panel-3" style="display: block;">
                                                    <div class="table-striped overflow-x-scroll pb-2">
                                                        <table class="w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" class="font-fifteen">Name</th>
                                                                    <th scope="col" class="font-fifteen">Distance</th>
                                                                    <th scope="col" class="font-fifteen">Minutes</th>
                                                                    <th scope="col" class="font-fifteen">Type</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($project->places as $school)
                                                                    @if ($school->main_type == 'school')
                                                                        <tr>
                                                                            <td class="text-break">{{$school->name}}</td>
                                                                            <td class="text-break">{{$school->distance}} km</td>
                                                                            <td class="text-break">{{$school->minutes}}</td>
                                                                            <td class="text-break">{{$school->sub_type}}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                            <!-- Shopping Data -->
                                            @if ($project->hasResturant)
                                                <div class="tab-pane tab-hide" id="tb-panel-4" style="display: block;">
                                                    <div class="table-striped overflow-x-scroll pb-2">
                                                        <table class="w-100">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" class="font-fifteen">Name</th>
                                                                    <th scope="col" class="font-fifteen">Distance</th>
                                                                    <th scope="col" class="font-fifteen">Minutes</th>
                                                                    <th scope="col" class="font-fifteen">Type</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($project->places as $resturant)
                                                                    @if ($resturant->main_type == 'resturant')
                                                                        <tr>
                                                                            <td class="text-break">{{$resturant->name}}</td>
                                                                            <td class="text-break">{{$resturant->distance}} km</td>
                                                                            <td class="text-break">{{$resturant->minutes}}</td>
                                                                            <td class="text-break">{{$resturant->sub_type}}</td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    @if ($project->location ?? false)
                        <input type="hidden" name="location" id="location" value="{{ $project->location ?? '35.52052844635452;35.80705384863964' }}">
                        <div class="property-overview border rounded bg-white p-30 mb-30">
                            <div class="row row-cols-1">
                                <div class="col">
                                    <h5 class="mb-3">{{__('Location')}}</h5>
                                    <div id="map" style="height: 400px; width: 100%" class="mb-30"></div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('website.partials.download-modal')
@endsection

@push('scripts')

<script >
  
$(document).ready(function() {
        // let _name = $('#mailer_name');
        // let _email = $('#mailer_email');
        // let _subject = $('#mailer_subject');
        // let _message = $('#mailer_message');
        // let _phone = $('#mailer_phone');
        // $('#submit-email').on('click', function(event) {
            
        //     $.ajax({
        //         url: '{{route('mail')}}',
        //         type: "POST",
        //         data: { 
        //             mailer_name   :mailer.val(),
        //             mailer_email  :_email.val(),
        //             mailer_subject:_subject.val(),
        //             mailer_message:_message.val(),
        //             mailer_phone:_message.val(),

        //         },
        //         success: function(response) {

        //             var responseObject = JSON.parse(response);
        //             console.log(response);
        //             console.log(responseObject.status);
        //             if (responseObject.status == 200){
        //               swal({
        //                   title: "Email Sent!",
        //                   text: "Suceess message sent Successfully!!",
        //                   icon: "success",
        //                   button: "Ok",
        //                   timer: 2000
        //               });
        //             }
        //             else if(responseObject.status == 500)
        //             {
           
        //               swal({
        //               icon: "error",
        //               title: "Oops...",
        //               text: "Something went wrong!",
        //               // footer: '<a href="#">Why do I have this issue?</a>'
        //             });
        //             }
        //         },
        //         error: function (request, status, error) {
        //             swal({
        //               icon: "error",
        //               title: "Oops...",
        //               text: "Something went wrong!",
        //               footer: '<a href="#">Why do I have this issue?</a>'
        //             });
        //         }
        //     });
        //     event.preventDefault();
        //     return false;
        // });

        $('#single-project').layerSlider({
            sliderVersion: '6.5.0b2',
            type: 'popup',
            pauseOnHover: 'disabled',
            skin: 'photogallery',
            globalBGSize: 'cover',
            navStartStop: false,
            hoverBottomNav: true,
            showCircleTimer: false,
            thumbnailNavigation: 'always',
            tnContainerWidth: '100%',
            tnHeight: 70,
            popupShowOnTimeout: 1,
            popupShowOnce: false,
            popupCloseButtonStyle: 'background: rgba(0,0,0,.5); border-radius: 2px; border: 0; left: auto; right: 10px;',
            popupResetOnClose: 'disabled',
            popupDistanceLeft: 20,
            popupDistanceRight: 20,
            popupDistanceTop: 20,
            popupDistanceBottom: 20,
            popupDurationIn: 750,
            popupDelayIn: 500,
            popupTransitionIn: 'scalefromtop',
            popupTransitionOut: 'scaletobottom',
            skinsPath: 'assets/skins/'
        });
    });

    
</script>


    {{-- map integration --}}
    <script>
        var initialplace = document.getElementById('location').value;
        let coordinates = initialplace.split(';')
        var map = L.map('map').setView([coordinates[0], coordinates[1]], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([coordinates[0], coordinates[1]]).addTo(map)
        .bindPopup('{{$project->name}}')
        .openPopup();
    </script>
@endpush