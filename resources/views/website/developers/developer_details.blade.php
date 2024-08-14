@extends('website.layout.app-blog')
@section('pageTitle', __($title) . __('Developers') . ' | ' . config('panel.website_title'))
@section('content')
    @include('website.layout.title-banner')
    <div id="page_wrapper" class="bg-light">
        <div class="full-row py-5">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 order-xl-2">
                        <div class="blog-sidebar widget-box-model">
                            @include('website.partials.recent_properties')
                        </div>
                    </div>
                    <div class="col-xl-8 order-xl-1 sm-mb-30">
                        <div class="single-post border summary bg-white p-30 mb-30">
                            <div class="single-post-title">
                                <div class="post-image">
                                    <img src="{{$developer->logo ?? ''}}" alt="{{$developer->name}} Logo">
                                </div>
                            </div>
                            <p>{{$developer->description}}</p>
                        </div>
                        {{-- {{dd($developer->projects)}} --}}
                        @include('website.partials.projects_card' , ['projects' => $developer->projects])
                       
                    </div>
                </div>
                
            </div>
        </div>
        <div class="scroll-top-vertical xs-mx-none" id="scroll">Go Top <i class="ms-2 fa-solid fa-arrow-right-long"></i></div>
    </div>
@endsection

{{-- @if($developer->units)
<div class="row">
    <div class="col">
        <div class="align-items-center d-flex">
            <div class="me-auto">
                <h2 class="d-table">{{__('Developer\'s Properties')}}</h2>
            </div>
        </div>
    </div>
</div>
<div class="bg-white px-4 mt-2 pt-3 ">
    <div class="row row-cols-xl-2 row-cols-lg-2 row-cols-md-1 row-cols-1 g-4">
        
        @foreach($developer->units as $unit)
            <div class="col">
                <div class="pe-4 d-lg-block">
                    <div class="property-grid-1 property-block bg-white transation-this hover-shadow">
                        <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom">
                            <div class="cata position-absolute"><span class="sale bg-secondary text-white">{{$unit->propertyStatusText}}</span></div>
                            <a href="{{ route('propertyShow' , ['unit' => $unit->slug ?? 'test']) }}"><img src="{{ ($unit->getMedia('unit-photos')->count()) ? $unit->websiteImage : 'assets/images/new/property-grid-1.jpg'}}" alt="$unit->slug"></a>
                            <a href="#" class="listing-ctg text-white"><i class="fa-solid fa-building"></i><span>{{$unit->property_type}}</span></a>
                            <ul class="position-absolute quick-meta">
                                @if (auth()->user())
                                    <li onclick="toggleIconClass(this.querySelector('i:first-child'))">
                                        <a href="#" link="{{route('api.new-favorite' , ['unit' => $unit])}}" title="Add Favourite">
                                            <i class="{{array_search($unit->id, $favorites , true) ? 'fa fa-heart' : 'flaticon-like-1'}} flat-mini" ></i>
                                        </a>
                                    </li>
                                @endif                    
      
                            </ul>
                        </div>
                        <div class="property_text p-4">
                            <span class="listing-price">${{$unit->price}}<small> {{$unit->propertyStatusText == 'For Rent' ? '( Monthly )' : ''}}</small></span>
                            <h5 class="listing-title"><a href="{{ route('propertyShow' , ['unit' => $unit->slug ?? 'test']) }}">{{$unit->name}}</a></h5>
                            <span class="listing-location"> <i class="fas fa-map-marker-alt pe-1"> </i>{{ $unit->project->fullLocation ?? 'No loaction Info'}} </span>
                            <ul class="d-flex quantity font-fifteen">
                                <li title="Beds"><span><i class="fa-solid fa-bed"></i></span>{{$unit->bedrooms}}</li>
                                <li title="Baths"><span><i class="fa-solid fa-shower"></i></span>{{$unit->bathrooms}}</li>
                                <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>{{$unit->area_sqft}}</li>
                                <li title="Gas"><span><i class="fa-solid fa-fire"></i></span>{{$unit->gas ? 'Yes' : 'No'}}</li>
                            </ul>
                        </div>
                        <div class="d-flex align-items-center post-meta mt-2 py-3 px-4 border-top">
                            {{$unit->project->name}}
                            
                            <div class="post-date ms-auto"><span>{{$unit->postDate}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay-dark modal fade quick-view-modal" id="quick-view{{$unit->id}}">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="close view-close">
                            <span aria-hidden="true">&times;</span>
                        </div>
                        <div class="modal-body property-block summary p-3">
                            <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom m-2">
                                <a href="#"><img  src="{{$unit->quickView ?? 'assets/images/property/2.png'}}" alt="{{$unit->slug}}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif --}}