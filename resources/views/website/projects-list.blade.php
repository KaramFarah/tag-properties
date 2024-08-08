@extends('website.layout.app-blog')
@section('pageTitle', __('All Projects') . ' | ' . config('panel.site_title'))
@section('content')
    @include('website.layout.title-banner-light')
    <div id="page_wrapper" class="bg-light">
            <div class="full-row pt-0">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5">
                            <div class="listing-sidebar">
                                <div class="widget advance_search_widget">
                                    <h5 class="mb-30">{{ __('Search Projects') }}</h5>
                                    <form class="rounded quick-search form-icon-right" method="get">
                                        @csrf
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <input type="text" class="form-control" name="keyword" placeholder="Enter Keyword...">
                                            </div>
                                            <div class="col-12">
                                                <x-inputs.select inputName="status" inputId="status" inputLabel="{{ __('Status') }}" :inputData="$statuses" showButtons="false" inputValue="{{ $sStatus ?? '' }}" />
                                            </div>
                                            <div class="col-12">
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" name="city" placeholder="Address">
                                                    <i class="flaticon-placeholder flat-mini icon-font y-center text-dark"></i>
                                                </div>
                                            </div>
                                            {{-- <div class="col-12">
                                                <div class="position-relative">
                                                    <button class="form-control price-toggle toggle-btn" data-target="#data-range-price">Price <i class="fas fa-angle-down font-mini icon-font y-center text-dark"></i></button>
                                                    <div id="data-range-price" class="price_range price-range-toggle w-100">
                                                        <div class="area-filter price-filter">
                                                            <span class="price-slider">
                                                                <input class="filter_price" type="text" name="price" value="1000;100000000" />
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            {{-- <div class="col-6">
                                                <input type="text" class="form-control" name="keyword" placeholder="Min Area">
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" name="keyword" placeholder="Max Area">
                                            </div> --}}
                                            <div class="col-12">
                                                <button class="btn btn-primary w-100">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                @include('website.partials.recent-projects')
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 order-lg-1">
                            <div class="row">
                                <div class="col">
                                    <div class="woo-filter-bar p-3 d-flex flex-wrap justify-content-between">
                                        <div class="d-flex flex-wrap">
                                            <form class="woocommerce-ordering" method="get">
                                                <select name="orderby1" disabled>
                                                    <option>Any Status</option>
                                                    <option>Off Plan</option>
                                                    <option>Ready</option>
                                                </select>
                                            </form>
                                        </div>
                                        <div class="d-flex">
                                            <span class="woocommerce-ordering-pages me-4 font-fifteen">
                                                    {!! __('Showing') !!}
                                                    <span class="fw-semibold">{{ $projects->links()->paginator->firstItem() }}</span>
                                                    {!! __('to') !!}
                                                    <span class="fw-semibold">{{ $projects->links()->paginator->lastItem() }}</span>
                                                    {!! __('of') !!}
                                                    <span class="fw-semibold">{{ $projects->links()->paginator->total() }}</span>
                                                    {!! __('results') !!}
                                            </span>
                                            <form class="view-category" method="get">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-cols-1 g-4">
                                @foreach ($projects as $project)
                                    <div class="col">
                                        <!-- Projects Grid -->
                                        <div class="property-list-1 bg-white property-block border rounded transation-this hover-shadow p-2">
                                            <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom">
                                                <div class="cata position-absolute">
                                                    <span class="sale bg-primary text-white">{{$project->statusText}}</span></div>
                                                <div class="owl-carousel single-carusel dot-disable nav-between-in">
                                                    
                                                    @foreach ($project->allPhotos as $photo)
                                                        <div class="item">
                                                            <a href="{{route('projects.show' , ['project' => $project])}}"><img src="{{$photo->getUrl('website')}}" alt="{{$project->name}} cover image"></a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <ul class="position-absolute quick-meta">
                                                </ul>
                                            </div>
                                            <div class="property_text px-3">
                                                <div class="post-meta font-small text-uppercase list-color-primary">
                                                    <a href="{{route('projects.show' , ['project' => $project])}}" class="listing-ctg"><i class="fa-solid fa-building"></i><span>{{$project->project_type}}</span></a>
                                                </div>
                                                <h5 class="listing-title"><a href="{{route('projects.show' , ['project' => $project])}}">{{$project->name}}</a></h5>
                                                <span class="listing-location"><i class="fas fa-map-marker-alt"></i> {{$project->fullLocation}} </span>
                                                <div class="entry-footer">
                                                    <span class="listing-price">@if ($project->minPrice) {{'Starts At: '}}{{config('panel.currency')}} {{$project->minPrice}}@endif</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col mt-5">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination pagination-dotted-active justify-content-center">
                                            {{$projects->links()}}
                                        </ul>
                                    </nav>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--============== Projects Grid View End ==============-->
    </div>
@endsection

