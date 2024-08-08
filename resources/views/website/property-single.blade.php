@extends('website.layout.app-blog')
@section('pageTitle', __($unit->name) . ' | ' . __('All Properties') . ' | ' . config('panel.website_title'))
@section('styles')
    {{-- <link rel="stylesheet" href="{{asset('assets/webfonts/bootstrap_icons/bootstrap-icons.css')}}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endsection
@section('content')
    <div class="full-row py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb" class="mb-2">
                        <ol class="breadcrumb mb-0 bg-transparent p-0">
                            @foreach ($breadcrumbs as $_item)
                                @isset($_item['url'])
                                    <li class="breadcrumb-item"><a href="{{ $_item['url'] }}">{{$_item['label']}}</a></li>
                                @else
                                    <li class="breadcrumb-item">{{$_item['label']}}</li>
                                @endisset
                            @endforeach
                        </ol>
                    </nav>
                    <h3 class="text-secondary">{{$unit->name}}{!! !$unit->published ? ' - <small class="text-warning">Unpublished</small>' : ''!!}</h3>
                </div>
            </div>
        </div>
    </div>
    <x-session-alert />
    <div class="full-row pt-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 order-xl-2">
                    <!-- Message Form -->
                    @include('website.partials.contact_form')
                
                    <!-- Property Search -->

                    <!--============== Recent Property Widget Start ==============-->
                    @if ($recentProperties->count())
                        @include('website.partials.recent_properties')
                    @endif
                    <!--============== Recent Property Widget End ==============-->
                </div>
            <div class="col-xl-8 order-xl-1">
                <div class="property-overview border summary rounded bg-white p-30 mb-30">
                    @if (isset($unit->thumbImage))
                        <div class="full-row p-0 mb-30">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="single-property" style="width:1200px; height:600px; margin:0 auto 30px;">
                                    <!-- Slide 1-->
                                        @foreach ($unit->thumbImage as $image)
                                            <div class="ls-slide" data-ls="duration:7500; transition2d:5; kenburnszoom:in; kenburnsscale:1.2;"> <img width="1920" height="1280" src="{{$image->getUrl()}}" class="ls-bg" alt=""/> </div>                        
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row mb-4">
                        <div class="col-auto">
                            <div class="post-meta font-small text-uppercase list-color-primary">
                                <a name="property-type" class="listing-ctg"><i class="{{ $unit->property_type_icon }}"></i><span>{{$unit->propertyTypeText}}</span></a>
                            </div>
                            <h4 class="listing-title">{{$unit->name}}</h4>
                        </div>
                        <div class="col ms-auto xs-m-0 text-end xs-text-start pb-4">
                            <span class="listing-price">{{ config('panel.currency') }} {{$unit->price}} <small>( {{ $unit->propertyPurposeText }} )</small></span>
                            <span class="text-white font-mini px-2 rounded product-status ms-auto xs-m-0 py-1 bg-primary"><i class="fas fa-check"></i> {{$unit->propertyStatusText}}</span>
                        </div>
                        <div class="col-12">
                            @if($unit->location)
                                <div id="map" style="height: 300px; width: 100%" class="mb-30"></div>
                                <input type="hidden" name="location" id="location" value="{{ old('location', $unit->location ?? '35.52052844635452;35.80705384863964') }}" class="mb-30">   
                            @endif       
                            {{-- <span class="listing-location"> {{$unit->fullLocation ?? ($unit->project->fullLocation ?? 'No Location')}}</span> --}}
                            <a name="recommendations" class="d-block text-light hover-text-primary font-small mb-2">{{$unit->recommendedCount ? '( ' . $unit->recommendedCount . ' People Recommended )' : ''}}</a>
                        </div>
                        <div class="col-12">

                            <ul class="quick-meta mt-4">
                                @if (auth()->user())
                                    <li onclick="toggleIconClass(this.querySelector('i:first-child'))" class="bg-light">
                                        <a href="#" link="{{route('api.new-favorite' , ['unit' => $unit])}}" title="Add wishlist" class="text-dark">
                                            <i class="{{$unit->isFavourite ? 'fa fa-heart' : 'flaticon-like-1'}} flat-mini"></i>
                                        </a>
                                    </li>
                                @endif
                                <li class="bg-light"><a href="{{route('print' , ['unit' => $unit])}}" title="Print Data" target="blank" class="text-dark"><i class="flaticon-printer flat-mini"></i></a></li> 
                                <li class="bg-light"><a href="{{$shareLink['facebook']}}" title="Media share" class="text-dark" ><i class="bi bi-facebook flat-mini"></i></a></li>
                                <li class="bg-light"><a href="{{$shareLink['telegram']}}" title="Media share" class="text-dark" ><i class="bi bi-telegram flat-mini"></i></a></li>
                                <li class="bg-light d-sm-none"><a href="{{$shareLink['whatsapp']}}" title="Media share" class="text-dark" ><i class="bi bi-whatsapp flat-mini"></i></a></li>
                                {{-- <li class="bg-light"><a href="#" title="Download PDF" class="text-dark"><i class="fas fa-download flat-mini"></i></a></li> --}}
                                {{-- <li class="bg-primary w-auto"><a href="#" class="px-5 text-white">Booking Now</a></li> --}}
                            </ul>
                            <hr>
                            <div class="mt-2">
                                <ul class="list-three-fold-width d-table">
                                    @if ($unit->bedrooms)
                                        <li class="w-auto"><span class="font-500">{{ _('Bed Rooms') }}:</span> {{$unit->bedrooms}}</li>
                                    @endif
                                    @if ($unit->area_sqft)
                                        <li class="w-auto"><span class="font-500">{{ __('Area') }}:</span> {{$unit->area_sqft}} Sqft<sup>2</sup></li>
                                    @endif
                                    @if ($unit->bathrooms)
                                        <li class="w-auto"><span class="font-500">{{ __('Bathrooms') }}:</span> {{$unit->bathrooms}}</li>
                                    @endif
                                    @if ($unit->garage)
                                        <li class="w-auto"><span class="font-500">{{ __('Parking') }}:</span> {{ $unit->garage ? 'Yes' : 'No' }}</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1">
                        <div class="col">
                            <h5 class="mb-3">{{ __('Description') }}</h5>
                            <p>{!!$unit->description ?? 'No Description'!!}</p>
                        </div>
                    </div>
                </div>
                <div class="property-overview border rounded bg-white p-30 mb-30">
                    <div class="row row-cols-1">
                        <div class="col">
                            <h5 class="mb-3">{{ __('More Information') }}</h5>
                            <ul class="list-three-fold-width">
                                @if ($unit->property_id)
                                    <li><span class="font-500">{{ _('Property Id') }}:</span> {{$unit->property_id}}</li>
                                @endif
                                @if ($unit->land_size)
                                    <li><span class="font-500">{{ _('Plot Size') }}:</span> {{$unit->land_size}} Sqft<sup>2</sup></li>
                                @endif
                                @if ($unit->permit_no)
                                    <li><span class="font-500">{{ _('Permit Number') }}:</span> {{$unit->permit_no}}</li>
                                @endif
                                @if ($unit->property_ownership)
                                    <li><span class="font-500">{{ _('Property Ownership') }}:</span> {{$unit->propertyOwnershipText}}</li>
                                @endif
                                @if ($unit->availablitiy)
                                    <li><span class="font-500">{{ _('Availablitiy') }}:</span> {{$unit->availablitiy}}</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @if ($unit->tags->count())
                    <div class="property-overview border rounded bg-white p-30 mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                {{-- Property Features --}}
                                <h5 class="mb-3">{{ __('Amenities') }}</h5>
                                <ul class="list-three-fold-width list-style-tick">
                                    @foreach ($unit->tags as $tag)
                                        @if ($tag->value_type == \App\Models\Dashboard\Tag::VALUE_TYPE_TEXT)
                                            <li>
                                                <span>{{$tag->name}}: {{$unit->tags()->wherePivot('tag_id' , $tag->id)->first()->pivot->tag_value ?? ''}}</span>
                                            </li>
                                        @elseif ($tag->value_type == \App\Models\Dashboard\Tag::VALUE_TYPE_DROPDOWN)
                                            <li>
                                                <span>{{$tag->name}}: {{$unit->getSelectedOption($tag)}}</span>
                                            </li>
                                        @else
                                            <li>{{$tag->name}}</li> 
                                        @endif                                   
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($unit->attachments->count())
                    <div class="property-overview border rounded bg-white p-30 mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                {{-- Property Features --}}
                                <h5 class="mb-3">{{ __('Attachments') }}</h5>
                                @foreach($unit->attachments as $_file)
                                    <div class="row mb-10" id="{{$_file->id}}">
                                        <div class="col-11 justify-content-start">
                                            @auth
                                                <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ __('Download File') }} {{ $loop->iteration }}</a></p>
                                            @endauth
                                            @guest
                                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#downloadAttachment" data-bs-value="{{ $_file->getUrl() }}">{{ __('Download File') }} {{ $loop->iteration }}</button>
                                            @endguest
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                @includeWhen($unit->floors->count() || $unit->floorPlanPhotos->count(), 'website.partials.floor-plans')
                @includeWhen($unit->places->count(), 'website.partials.nearby')

                {{-- @if ($unit->project->location ?? false)
                <input type="hidden" name="location" id="location" value="{{ $unit->project->location ?? '25.276987;55.296249' }}">
                <div class="property-overview border rounded bg-white p-30 mb-30">
                    <div class="row row-cols-1">
                        <div class="col">
                            <h5 class="mb-3">Location</h5>
                            <div id="map" style="height: 400px; width: 100%" class="mb-30"></div>
                        </div>
                    </div>
                </div>
                @endif --}}
                </div>
            </div>
        </div>
    </div>
    @include('website.partials.download-modal')
@endsection

@push('scripts')

<script>  
    $(document).ready(function() {
        let _name = $('#mailer_name');
        let _email = $('#mailer_email');
        let _subject = $('#mailer_subject');
        let _message = $('#mailer_message');
        let _phone = $('#mailer_phone');
        $('#submit-email').on('click', function(event) {
            $.ajax({
                url: '{{route('mail')}}',
                type: "POST",
                data: { 
                    mailer_name   :mailer.val(),
                    mailer_email  :_email.val(),
                    mailer_subject:_subject.val(),
                    mailer_message:_message.val(),
                    mailer_phone:_message.val(),

                },
                success: function(response) {

                    var responseObject = JSON.parse(response);
                    console.log(response);
                    console.log(responseObject.status);
                    if (responseObject.status == 200){
                      swal({
                          title: "Email Sent!",
                          text: "Suceess message sent Successfully!!",
                          icon: "success",
                          button: "Ok",
                          timer: 2000
                      });
                    }
                    else if(responseObject.status == 500)
                    {
           
                      swal({
                      icon: "error",
                      title: "Oops...",
                      text: "Something went wrong!",
                      // footer: '<a href="#">Why do I have this issue?</a>'
                    });
                    }
                },
                error: function (request, status, error) {
                    swal({
                      icon: "error",
                      title: "Oops...",
                      text: "Something went wrong!",
                      footer: '<a href="#">Why do I have this issue?</a>'
                    });
                }
            });
            event.preventDefault();
            return false;
        });
    });

    $('#single-property').layerSlider({
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
    </script>

    <script>
        var initialplace = document.getElementById('location').value;
        let coordinates = initialplace.split(';')
        var map = L.map('map').setView([coordinates[0], coordinates[1]], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([coordinates[0], coordinates[1]]).addTo(map)
        .bindPopup('{{$unit->name ?? ''}}')
        .openPopup();
    </script>
@endpush