@extends('website.layout.app-blog')
@section('pageTitle', __('User Profile') . ' | ' . config('panel.site_title'))
@section('content')
    @include('website.layout.title-banner-black')
    <div class="full-row bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="mb-40">{{__('My Uploads')}}</h4>

                    <ul class="nav nav-fill nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="fill-tab-0" data-bs-toggle="tab" href="#fill-tabpanel-0" role="tab" aria-controls="fill-tabpanel-0" aria-selected="true"> <h6>{{ __('Favorites') }}</h6></a>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                          <a class="nav-link" id="fill-tab-1" data-bs-toggle="tab" href="#fill-tabpanel-1" role="tab" aria-controls="fill-tabpanel-1" aria-selected="false"> <h6>{{ __('Listed Properties') }}</h6> </a>
                        </li> --}}
                    </ul>
                    <div class="tab-content pt-5" id="tab-content">
                        <div class="tab-pane active" id="fill-tabpanel-0" role="tabpanel" aria-labelledby="fill-tab-0">
                            <div class="row row-cols-xl-2 row-cols-lg-1 row-cols-md-2 row-cols-1 g-4">
                                @forelse ($user->favorites as $unit)
                                    <div class="col">
                                       @include('website.partials.unit-item')
                                    </div>
                                @empty
                                    <span>{{_('No favorites')}} <i class="fa fa-heart-crack"></i></span>
                                @endforelse
                            </div>
                        </div>
                        <div class="tab-pane" id="fill-tabpanel-1" role="tabpanel" aria-labelledby="fill-tab-1">
                            <div class="row row-cols-xl-2 row-cols-lg-1 row-cols-md-2 row-cols-1 g-4">
                                @forelse ($user->CreatedProperties as $unit)
                                    <div class="col">
                                        @include('website.partials.unit-item')
                                    </div>
                                @empty
                                    <span>{{_('No Submited properties Yet!')}} <i class="fa fa-heart-crack"></i></span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h4 class="mb-40">{{ __('Information') }}</h4>
                    <p><b>{{ __('Email')}}</b> {{$user->email}}</p>
                    <a class="btn btn-outline-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutform-profile').submit();"><i class="flaticon-transfer flat-mini pe-2"></i> {{ __('Logout') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection