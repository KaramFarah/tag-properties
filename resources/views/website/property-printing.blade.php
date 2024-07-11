@extends('website.layout.blank')
{{-- @extends('website.layout.app-blog') --}}
@section('pageTitle', __($unit->name) . ' | ' . config('panel.website_title'))
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
{{-- <link rel="stylesheet" href="{{asset('assets/webfonts/bootstrap_icons/bootstrap-icons.min.css')}}"> --}}
@endsection
@section('content')


@if ($unit->project)
    <div class="row text-center">
        <img src="{{$unit->project->developers->first()->logo}}" alt="{{$unit->developerName}}">
    </div>
@endif
@if (isset($unit->thumbImage))
    <div class="full-row p-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="single-property" style="width:1200px; height:600px; margin:0 auto 30px;">
                    <div class="ls-slide"> <img  src="{{$unit->originalImage}}" class="ls-bg" alt=""/> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


<div class="full-row pt-30">
    <div class="container">
        <div class="row">
            <div class="order-xl-1">
                <div class="property-overview border summary rounded bg-white p-30 mb-30">
                    <div class="row mb-4">
                        <div class="col-auto">
                            <div class="post-meta font-small text-uppercase list-color-primary">
                                <a href="#" class="listing-ctg"><i class="fa-solid fa-building"></i><span>{{$unit->propertyTypeText}}</span></a>
                            </div>
                            <h4 class="listing-title"><a href="#">{{$unit->name}}</a></h4>
                            <span class="listing-location"><i class="fas fa-map-marker-alt text-primary"></i> {{$unit->project->location ?? 'No location Info'}}</span>
                            <a href="#" class="d-block text-light hover-text-primary font-small mb-2">{{$unit->recommendedCount ? '( ' . $unit->recommendedCount . ' People Recommended )' : ''}}</a>
                        </div>
                        <div class="col-auto ms-auto xs-m-0 text-end xs-text-start pb-4">
                            <span class="listing-price">${{$unit->price}}</span>
                            <span class="text-white font-mini px-2 rounded product-status ms-auto xs-m-0 py-1 bg-primary"><i class="fas fa-check"></i> {{$unit->propertyStatusText}}</span>
                        </div>
                        <div class="col-12">

                            <hr>
                            <div class="mt-2">
                          
                                <ul class="list-three-fold-width d-table">
                                    @if ($unit->bedrooms)
                                        <li class="w-auto"><span class="font-500">Bed rooms:</span> {{$unit->bedrooms}}</li>
                                    @endif
                                    @if ($unit->area_sqft)
                                        <li class="w-auto"><span class="font-500">Area:</span> {{$unit->area_sqft}} Sqft<sup>2</sup></li>
                                    @endif
                                    @if ($unit->baths)
                                        <li class="w-auto"><span class="font-500">Baths:</span>{{$unit->baths}}</li>
                                    @endif
                                        <li class="w-auto"><span class="font-500"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1">
                        <div class="col">
                            <h5 class="mb-3">Description</h5>
                            <p>{{$unit->description ?? 'No Description'}}</p>
                        </div>
                    </div>
                </div>
                @if ($unit->tags->count())
                    <div class="widget widget_contact bg-white border p-30 shadow-one rounded mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                <h5 class="mb-3">Property Features</h5>
                                <ul class=" list-style-tick">
                                    @foreach ($unit->tags as $tag)
                                        <li>{{$tag->name}}</li>                                    
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($unit->floors->count())
                    <div class="property-overview border rounded bg-white p-30 mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                <h5 class="mb-3">Floor Plans</h5>
                                @foreach ($unit->floors as $floor)
                                    <div class="simple-collaps mb-2">
                                        <span class="accordion bg-light text-secondary d-block px-4 py-2 active">{{ucfirst($floor->title)}} [ {{$floor->space}} sqft ]</span>
                                        <div class="panel" style="max-height: 618px;">
                                            <div class="px-4 py-3">
                                                <ul class="d-inline-block">
                                                    <li class="float-start me-3"><span class="text-secondary">Bed: </span>{{$floor->master_bed ? $floor->master_bed . ' Sqft': ''}}</li>
                                                    <li class="float-start me-3"><span class="text-secondary">Kitchen: </span>{{$floor->kitchen ? $floor->kitchen . ' Sqft'  : ''}}</li>
                                                    <li class="float-start me-3"><span class="text-secondary">Dining: </span>{{$floor->diding ? $floor->diding . ' Sqft' : ''}}</li>
                                                    <li class="float-start me-3"><span class="text-secondary">Bath: </span>{{$floor->baths ? $floor->baths . ' Sqft'  : ''}} </li>
                                                    <li class="float-start me-3"><span class="text-secondary">Storage: </span>{{$floor->storage ? $floor->storage . ' Sqft'  : ''}}</li>
                                                </ul>
                                                <img src="{{$floor->websitePreview ?? 'No Image'}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                @if ($unit->places->count())
                    <div class="widget widget_contact border p-30 bg-white shadow-one rounded mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                @if ($unit->hasHospital)
                                    <h5 class="mb-3">Hospitals</h5>
                                    <div class="tab-simple tab-action">
                                        <div class="tab-element">
                                                        <div class="tab-pane tab-hide" id="tb-panel-1" style="display: block;">
                                                            <div class="table-striped overflow-x-scroll pb-2">
                                                                <table class="w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col" class="font-fifteen">Name</th>
                                                                            <th scope="col" class="font-fifteen">Distance</th>
                                                                            <th scope="col" class="font-fifteen">Type</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($unit->GetHospital as $hospital)
                                                                                <tr>
                                                                                    <td>{{$hospital->name}}</td>
                                                                                    <td>{{$hospital->distance}}</td>
                                                                                    <td>{{$hospital->sub_type}}</td>
                                                                                </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                        </div>
                                    </div>
                                @endif
                                    <br>
                                @if ($unit->hasShopping)
                                                <h5 class="mb-3">Shoppings</h5>
                                                <div class="tab-simple tab-action">
                                                    <div class="tab-element">
                                                        <div class="tab-pane tab-hide" id="tb-panel-1" style="display: block;">
                                                            <div class="table-striped overflow-x-scroll pb-2">
                                                                <table class="w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col" class="font-fifteen">Name</th>
                                                                            <th scope="col" class="font-fifteen">Distance</th>
                                                                            <th scope="col" class="font-fifteen">Type</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($unit->GetShopping as $shopping)
                                                                                <tr>
                                                                                    <td>{{$shopping->name}}</td>
                                                                                    <td>{{$shopping->distance}}</td>
                                                                                    <td>{{$shopping->sub_type}}</td>
                                                                                </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                @endif
                                    <br>
                                @if ($unit->hasResturant)
                
                                                <h5 class="mb-3">Resturants</h5>
                                                <div class="tab-simple tab-action">
                                                    <div class="tab-element">
                                                        <div class="tab-pane tab-hide" id="tb-panel-1" style="display: block;">
                                                            <div class="table-striped overflow-x-scroll pb-2">
                                                                <table class="w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col" class="font-fifteen">Name</th>
                                                                            <th scope="col" class="font-fifteen">Distance</th>
                                                                            <th scope="col" class="font-fifteen">Type</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($unit->GetResturant as $resturant)
                                                                                <tr>
                                                                                    <td>{{$resturant->name}}</td>
                                                                                    <td>{{$resturant->distance}}</td>
                                                                                    <td>{{$resturant->sub_type}}</td>
                                                                                </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                
                                @endif
                                    <br>
                                @if ($unit->hasSchool)
                                                <h5 class="mb-3">Schools</h5>
                                                <div class="tab-simple tab-action">
                                                    <div class="tab-element">
                                                        <div class="tab-pane tab-hide" id="tb-panel-1" style="display: block;">
                                                            <div class="table-striped overflow-x-scroll pb-2">
                                                                <table class="w-100">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col" class="font-fifteen">Name</th>
                                                                            <th scope="col" class="font-fifteen">Distance</th>
                                                                            <th scope="col" class="font-fifteen">Type</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($unit->GetSchool as $school)
                                                                                <tr>
                                                                                    <td>{{$school->name}}</td>
                                                                                    <td>{{$school->distance}}</td>
                                                                                    <td>{{$school->sub_type}}</td>
                                                                                </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- <div class="col-xl-4 order-xl-2">
              

      
            </div> --}}
           
        </div>
    </div>
</div>
@endsection
