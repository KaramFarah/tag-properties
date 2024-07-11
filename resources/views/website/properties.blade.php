@extends('website.layout.app-blog')
@section('content')
{{-- @include('fullwidth.partials.shareLinksPopUp') --}}
@include('website.layout.title-banner-light')
<div class="full-row pt-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <div class="listing-sidebar">
                    @include('website.partials.sidebar-search')
                    <!--============== Feature Property Widget Start ==============-->
                    @include('website.partials.featured-properties')
                    <!--============== Feature Property Widget End ==============-->

                    <!--============== Recent Property Widget Start ==============-->
                    @isset ($recentProperties)
                        @include('website.partials.recent_properties')
                    @endisset
                    <!--============== Recent Property Widget End ==============-->
                </div>
            </div>
            <div class="col-xl-8 col-lg-7">
                <div class="row">
                    <div class="col">
                        <div class="woo-filter-bar p-3 d-flex flex-wrap justify-content-between">
                            <div class="d-flex flex-wrap">
                                <form class="woocommerce-ordering" method="get" id="sort-results-form" action="{{ $sortRoute ?? '' }}">
                                    {{-- <select name="orderby1">
                                        <option>Any Status</option>
                                        <option>For Rent</option>
                                        <option>For Sale</option>
                                    </select> --}}
                                    <select name="orderby2">
                                        {{-- <option>Default</option> --}}
                                        {{-- <option>Most Popular</option> --}}
                                        {{-- <option>Top Rated</option> --}}
                                        <option selected>{{ __('Newest Items') }}</option>
                                        {{-- <option>Price low to high</option> --}}
                                        {{-- <option>Price hight to low</option> --}}
                                    </select>
                                </form>
                            </div>
                            <div class="d-flex">
                                <span class="woocommerce-ordering-pages me-4 font-fifteen">
                                        {!! __('Showing') !!}
                                        <span class="fw-semibold">{{ $units->links()->paginator->firstItem() }}</span>
                                        {!! __('to') !!}
                                        <span class="fw-semibold">{{ $units->links()->paginator->lastItem() }}</span>
                                        {!! __('of') !!}
                                        <span class="fw-semibold">{{ $units->links()->paginator->total() }}</span>
                                        {!! __('results') !!}
                                </span>
                                <form class="view-category" method="get">
                                    {{-- <button title="Grid" class="grid-view current" value="grid" name="display" type="submit"><i class="flaticon-grid-1 flat-mini"></i></button> --}}
                                    {{-- <button title="List" class="list-view" value="list" name="display" type="submit"><i class="flaticon-grid flat-mini"></i></button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 g-4">
                    @foreach ($units as $unit)
                        <div class="col">
                            @include('website.partials.property-card-horizental')
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col mt-5">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-dotted-active justify-content-center">
                                {{$units->links()}}
                            </ul>
                        </nav>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection