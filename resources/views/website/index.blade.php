@extends('website.layout.app')
@section('content')
    <div class="full-row p-0 overflow-hidden">

        <div id="slider" class="overflow-hidden" style="width:1200px; height:780px; margin:0 auto;margin-bottom: 0px;">

            <!-- Slide 1-->
            <div class="ls-slide" data-ls="bgsize:cover; bgposition:50% 50%; duration:12000; transition2d:104; kenburnsscale:1.00;">
                <img width="1920" height="960" src="assets/images/new/slider-1.jpg" class="ls-bg" alt="" />
                <p style="font-size:20px; font-weight:400; top:320px; left:50%; font-family: 'Sen', sans-serif;" class="ls-l ls-hide-phone text-white" data-ls="offsetyin:100%; durationin:1500; delayin:500; clipin:0 0 100% 0; durationout:400; parallaxlevel:0;">TAG Properties</p>
                <p style="font-size:48px; font-weight:700; top:370px; left:50%; font-family: 'Sen', sans-serif;" class="ls-l ls-hide-phone text-white" data-ls="offsetyin:100%; durationin:1500; delayin:1000; clipin:0 0 100% 0; durationout:400; parallaxlevel:0;">Elevating Dreams</p>
                <p style="top:450px; left:50%; text-align:center; font-weight:400; font-style:normal; text-decoration:none; width:650px; font-size:18px; color:#ffffff; line-height:30px; white-space:normal;" class="ls-l ls-hide-phone" data-ls="offsetyin:100%; durationin:1500; delayin:1500; clipin:0 0 100% 0; durationout:400; parallaxlevel:0;">Discover the future of real estate with TAG Properties – Your Journey Awaits.</p>
                <a style="" class="ls-l ls-hide-phone" href="{{route('properties')}}" target="_self" data-ls="offsetyin:40; delayin:2000; clipin:0 0 100% 0; durationout:400; hover:true; hoverdurationin:300; hoveropacity:1; hoverbgcolor:#222; hovercolor:#86774f;">
                    <p style="font-weight:500; text-align:center; cursor:pointer; padding-right:35px; padding-left:35px; font-weight: 500; font-size:16px; font-family: 'Sen', sans-serif; line-height:40px; top:550px; left:50%; color:#fff; border-radius:30px; padding-top:10px; padding-bottom:10px; background:#86774f; white-space:normal;"
                        class="">Preview Listing</p>
                </a>
            </div>

            <!-- Slide 2 -->
            <div class="ls-slide" data-ls="bgsize:cover; bgposition:50% 50%; duration:12000; transition2d:104; kenburnsscale:1.00;">
                <img width="1920" height="960" src="assets/images/new/slider-2.jpg" class="ls-bg" alt="" />
                <p style="font-size:20px; font-weight:400; top:320px; left:50%; text-align:center; font-family: 'Sen', sans-serif;" class="ls-l ls-hide-phone text-white" data-ls="offsetyin:100%; durationin:1500; delayin:500; clipin:0 0 100% 0; durationout:400; parallaxlevel:0;">Discover. Invest. Thrive</p>
                <p style="font-size:48px; font-weight:700; top:370px; left:50%; text-align:center; font-family: 'Sen', sans-serif;" class="ls-l ls-hide-phone text-white" data-ls="offsetyin:100%; durationin:1500; delayin:1000; clipin:0 0 100% 0; durationout:400; parallaxlevel:0;">Your Path to Real Estate Success</p>
                <p style="top:450px; left:50%; text-align:center; font-weight:400; font-style:normal; text-decoration:none; width:650px; font-size:18px; color:#ffffff; line-height:30px; white-space:normal;" class="ls-l ls-hide-phone" data-ls="offsetyin:100%; durationin:1500; delayin:1500; clipin:0 0 100% 0; durationout:400; parallaxlevel:0;">Unlock opportunities, invest wisely, and thrive with TAG Properties by your side.</p>
                <a style="" class="ls-l ls-hide-phone" href="{{ route('projects.index') }}" target="_self" data-ls="offsetyin:40; delayin:2000; clipin:0 0 100% 0; durationout:400; hover:true; hoverdurationin:300; hoveropacity:1; hoverbgcolor:#222; hovercolor:#86774f;">
                    <p style="font-weight:500; text-align:center; cursor:pointer; padding-right:35px; padding-left:35px; font-weight: 500; font-size:16px; font-family: 'Sen', sans-serif; line-height:40px; top:550px; left:50%; color:#fff; border-radius:30px; padding-top:10px; padding-bottom:10px; background:#86774f; white-space:normal;"
                        class="">Preview Listing</p>
                </a>
            </div>
            <!-- Slide 3 -->
            <div class="ls-slide" data-ls="bgsize:cover; bgposition:50% 50%; duration:12000; transition2d:104; kenburnsscale:1.00;">
                <img width="1920" height="960" src="assets/images/new/slider-3.jpg" class="ls-bg" alt="" />
                <p style="font-size:20px; font-weight:400; top:320px; left:32px; font-family: 'Sen', sans-serif;" class="ls-l ls-hide-phone text-white" data-ls="offsetyin:100%; durationin:1500; delayin:500; clipin:0 0 100% 0; durationout:400; parallaxlevel:0;">Where Service Meets Expertise</p>
                <p style="font-size:48px; font-weight:700; top:370px; left:32px; font-family: 'Sen', sans-serif;" class="ls-l ls-hide-phone text-white" data-ls="offsetyin:100%; durationin:1500; delayin:1000; clipin:0 0 100% 0; durationout:400; parallaxlevel:0;">Your Trusted Partner in SY Real Estate</p>
                <p style="top:450px; left:32px; text-align:left; font-weight:400; font-style:normal; text-decoration:none; width:650px; font-size:18px; color:#ffffff; line-height:30px; white-space:normal;" class="ls-l ls-hide-phone" data-ls="offsetyin:100%; durationin:1500; delayin:1500; clipin:0 0 100% 0; durationout:400; parallaxlevel:0;">Experience impeccable service and unmatched expertise – TAG Properties, your real estate ally.</p>
                <a style="" class="ls-l ls-hide-phone" href="{{ route('developers.index') }}" target="_self" data-ls="offsetyin:40; delayin:2000; clipin:0 0 100% 0; durationout:400; hover:true; hoverdurationin:300; hoveropacity:1; hoverbgcolor:#222; hovercolor:#86774f;">
                    <p style="font-weight:500; text-align:center; cursor:pointer; padding-right:35px; padding-left:35px; font-weight: 500; font-size:16px; font-family: 'Sen', sans-serif; line-height:40px; top:550px; left:32px; color:#fff; border-radius:30px; padding-top:10px; padding-bottom:10px; background:#86774f; white-space:normal;"
                        class="">Preview Listing</p>
                </a>
            </div>

        </div>
    </div>
    {{-- Property Search Form Start --}}
    <div class="full-row p-0 property-search-form on-slider">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form class="bg-white shadow-sm quick-search form-icon-right position-relative" action="{{route('properties')}}" method="GET">
                        <div class="row row-cols-lg-6 row-cols-md-3 row-cols-1 g-3">
                            <div class="col">
                                <input type="text" class="form-control" name="skeyword" placeholder="Enter Keyword..." value="{{$search['skeyword'] ?? ''}}">
                            </div>
                            <div class="col">
                                <select class="form-control" name="sproperty_type">
                                    <option value="">{{__('Property Type')}}</option>
                                    @foreach ($propertyTypes as $key => $type)
                                        <option @selected($key == old('sproperty_type', request()->get('sproperty_type'))) value="{{$key}}">{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-control" name="sproperty_purpose">
                                    <option value="">{{__('Property Purpose')}}</option>
                                    @foreach ($propertyPurposes as $key => $_text)
                                        <option @selected($key == old('sproperty_purpose', request()->get('sproperty_purpose'))) value="{{$key}}">{{$_text}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="col">
                                <div class="position-relative">
                                    <input type="text" value="{{$search['slocation'] ?? ''}}" class="form-control" name="slocation" placeholder="Location">
                                    <i class="flaticon-placeholder flat-mini icon-font y-center text-dark"></i>
                                </div>
                            </div> --}}
                            <div class="col">
                                <div class="position-relative">
                                    <button class="form-control price-toggle toggle-btn" data-target="#data-range-price">{{ __('Price') }} <i class="fas fa-angle-down font-mini icon-font y-center text-dark"></i></button>
                                    <div id="data-range-price" class="price_range price-range-toggle">
                                        <div class="area-filter price-filter">
                                            <span class="price-slider">
                                                <input class="filter_price" type="text" name="sprice"
                                                value="{{$price_string ?? '1000;100000000'}}" />
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="position-relative">
                                    <button class="form-control text-start toggle-btn" data-target="#aditional-check">{{ __('Advanced') }} <i class="fas fa-ellipsis-v font-mini icon-font y-center text-dark"></i></button>
                                </div>
                            </div>
                            <div class="col">
                                <button class="btn btn-primary w-100">{{ __('Search') }}</button>
                            </div>
                            <!-- Advance Features -->       
                            <div id="aditional-check" class="aditional-features p-5">
                                @if(($newSearch ?? 0 )== 1)
                                    @include('website.partials.search-tags-list' , ['tagName' => 'Recreation and Family'])
                                    @include('website.partials.search-tags-list' , ['tagName' => 'Health and Fitness'])
                                    @include('website.partials.search-tags-list' , ['tagName' => 'Laundry and Kitchen'])
                                    @include('website.partials.search-tags-list' , ['tagName' => 'Building'])
                                    @include('website.partials.search-tags-list' , ['tagName' => 'Business and Security'])
                                    @include('website.partials.search-tags-list' , ['tagName' => 'Miscellaneous'])
                                    @include('website.partials.search-tags-list' , ['tagName' => 'Technology'])
                                    @include('website.partials.search-tags-list' , ['tagName' => 'Features'])
                                    @include('website.partials.search-tags-list' , ['tagName' => 'Cleaning and Maintenance'])
                                @else
                                    <h5 class="mb-3">{{__('Amenities')}}</h5>
                                    <ul class="row row-cols-lg-4 row-cols-md-2 row-cols-1 custom-check-box mb-4">
                                        @foreach ($features as $feature)
                                            @if($feature->value_type == \App\Models\Dashboard\Tag::VALUE_TYPE_BOOLEAN)
                                                <li class="col">
                                                    <input name="sFeatures[]" type="checkbox" class="custom-control-input hide" id="customCheck{{$loop->index}}" value="{{$feature->id}}">
                                                        <label class=" custom-control-label" for="customCheck{{$loop->index}}">{{$feature->name}}</label>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--============== Property Search Form End ==============-->

    <!-- =============== About ================-->
    <div class="full-row">
        <div class="container">
            <x-session-alert/>
            <div class="row">
                <div class="col-lg-4">
                    <h1 class="text-dark mb-0">Crafting Your Key to a World of Real Estate Opportunities</h1>
                </div>
                <div class="col-lg-4">
                    <div class="py-2">
                        <p>At TAG Properties, we believe in transforming your real estate aspirations into reality.</p>
    <p>
                            With our unwavering commitment and expertise, we excel in various domains, including property sales, leasing, investment advisory, concierge service, mortgage guidance, and property management. Explore our comprehensive services:
                            </p>
                    </div>
                </div>
                <div class="col-lg-3 d-flex justify-content-md-end">
                    <ul class="list-style-tick d-flex flex-column my-2">
                        <li>Property Sales</li>
                        <li>Property Leasing</li>
                        <li>Property Investment Advisory</li>
                        <li>Concierge Service</li>
                        <li>Mortgage Advisory</li>
                        <li>Property Management</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- About --}}
    <div class="full-row p-0">
        <div class="container">
            <div class="row">
                <div class="col-12"><hr></div>
            </div>
        </div>
    </div>

    {{-- Counting --}}
    {{-- <div class="full-row">
        <div class="container">
            <div class="row row-cols-lg-3 row-cols-1">
                <div class="col">
                    <div class="d-flex flex-row text-uppercase">
                        <h1 class="text-primary mb-0 pe-4">$15.4M</h1>
                        <p>Owned from <br>Properties Transactions</p>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-row text-uppercase">
                        <h1 class="text-primary mb-0 pe-4">25K+</h1>
                        <p>Owned from <br>Properties Transactions</p>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-row text-uppercase">
                        <h1 class="text-primary mb-0 pe-4">500</h1>
                        <p>Owned from <br>Properties Transactions</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Featured Property Start --}}
    <div class="full-row bg-light">
        <div class="container">
            <div class="row">
                <div class="col mb-4">
                    <div class="align-items-center d-flex">
                        <div class="me-auto">
                            <h2 class="d-table">{{ __('Featured Properties') }}</h2>
                        </div>
                        <a href="{{route('properties')}}" class="ms-auto btn-link">{{ __('View All Properties') }}</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="3block-carusel nav-disable owl-carousel">
                        @foreach ($units as $unit)
                            <div class="item">
                                <div class="property-grid-1 property-block bg-white transation-this hover-shadow">
                                    <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom">
                                        <div class="cata position-absolute"><span class="sale bg-secondary text-white">{{$unit->propertyStatusText}}</span></div>
                                        <a href="{{ route('propertyShow' , ['unit' => $unit->slug]) }}"><img src="{{ ($unit->getMedia('unit-photos')->count()) ? $unit->websiteImage : 'assets/images/new/property-grid-1.jpg'}}" alt="Image Not Found!"></a>
                                        <a href="{{ route('propertyShow' , ['unit' => $unit->slug]) }}" class="listing-ctg text-white"><i class="fa-solid fa-building"></i><span>{{$unit->property_type}}</span></a>
                                        <ul class="position-absolute quick-meta">
                                            @auth
                                                <li onclick="toggleIconClass(this.querySelector('i:first-child'))">
                                                    <a href="#" link="{{route('api.new-favorite' , ['unit' => $unit])}}" title="Add Favourite">
                                                        <i class="{{$unit->isFavourite ? 'fa fa-heart' : 'flaticon-like-1'}} flat-mini"></i>
                                                    </a>
                                                </li>
                                            @endauth
                                            {{-- <li class="md-mx-none" data-bs-toggle="modal" data-bs-target="#quick-view{{$unit->id}}"><a class="quick-view vModal" href="#quick-view"  title="Quick View"><i class="flaticon-zoom-increasing-symbol flat-mini"></i></a>
                                            </li> --}}
                                        </ul>
                                    </div>
                                    <div class="property_text p-4">
                                        <span class="listing-price">{{config('panel.currency')}} {{$unit->price}}<small> ( {{$unit->property_purpose_text}} )</small></span>
                                        <h5 class="listing-title"><a href="{{ route('propertyShow' , ['unit' => $unit->slug]) }}">{{$unit->name}}</a></h5>
                                        {{-- <span class="listing-location"><i class="fas fa-map-marker-alt"></i> {{$unit->project->fullLocation ?? 'No loaction Info'}} </span> --}}
                                        <span class="listing-location"><i class="fas fa-map-marker-alt"></i> {{$unit->fullLocation ?? 'No Loaction'}} </span>
                                        <ul class="d-flex quantity font-fifteen">
                                            <li title="Beds"><span><i class="fa-solid fa-bed"></i></span>{{$unit->bedrooms}}</li>
                                            <li title="Baths"><span><i class="fa-solid fa-shower"></i></span>{{$unit->bathrooms}}</li>
                                            <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>{{$unit->area_sqft}}</li>
                                            <li title="Gas"><span><i class="fa-solid fa-fire"></i></span>{{ $unit->gas ? __('Yes') : __('No') }}</li>
                                        </ul>
                                    </div>
                                    <div class="d-flex align-items-center post-meta mt-2 py-3 px-4 border-top">
                                        <div class="agent">
                                            <a href="#" class="d-flex text-general align-items-center">
                                                <img class="rounded-circle me-2" src="{{
                                            ($unit->project) ? $unit->project->developers->first()->logoThumb ?? '' : ''
                                            }}" alt="{{$unit->developerName ?? ''}} image"><span>{{$unit->developerName ?? ''}}</span></a>
                                        </div>
                                        <div class="post-date ms-auto"><span>{{$unit->postDate}}</span></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @foreach ($units as $unit)
        <div class="overlay-dark modal fade quick-view-modal" id="quick-view{{$unit->id}}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="close view-close">
                        <span aria-hidden="true">&times;</span>
                    </div>
                    <div class="modal-body property-block summary p-3">
                        <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom m-2">
                            <a href="{{ route('propertyShow', ['unit' => $unit]) }}"><img  src="{{$unit->quickView ?? 'assets/images/property/2.png'}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    @endforeach --}}
    {{-- Property Category Start --}}
    <div class="full-row bg-secondary">
        <div class="container">
            <div class="row">
                <div class="col mb-5">
                    <h2 class="down-line w-50 mx-auto mb-4 text-center text-white w-sm-100">{{ __('Unlocking Golden Opportunities: Our Expertise, Your Advantage') }}</h2>
                    <span class="d-table w-50 w-sm-100 sub-title text-white fw-normal mx-auto text-center">{{ __('Experience the power of our expertise and extensive network as we unveil a world of unparalleled opportunities, tailored to your dreams and aspirations.') }}</span>
                </div>
            </div>
            <div class="row row-cols-8 g-1 justify-content-center">
                @foreach ($propertyTypes as $_typeKey => $_type)
                    <div class="col">
                        <a href="{{route('properties', ['sproperty_type' => $_typeKey])}}" class="text-center d-flex flex-column align-items-center hover-text-white p-4 bg-white transation text-general hover-bg-primary h-100">
                            <div class="box-70px position-relative">
                                <i class="{{ isset($propertyTypeIcons[$_typeKey]) ? $propertyTypeIcons[$_typeKey] : 'flaticon-real-estate' }} flat-medium d-inline-block text-primary position-absolute xy-center"></i>
                            </div>
                            <h6 class="d-block text-secondary">{{$_type}}</h5>
                        </a>
                    </div>
                @endforeach            
            </div>
        </div>
    </div>
    <div class="full-row bg-white">
        <div class="container">
            <div class="row">
                <div class="col position-relative">
                    <span class="sm-d-none box-tab-line h6 text-primary bg-white x-center px-2">{{ __('Visionary Real Estate') }}</span>
                    <h2 class="box-title text-secondary text-center mx-auto mb-4 font-400">{{ __('DEVELOPERS') }}</h2>
                    <span class="sub-title text-secondary text-center mx-auto higlight-font mb-5 w-50 w-md-100">{{ __('We collaborate with top-tier developers, shaping tomorrow\'s landscapes with innovation, quality, and sustainability. Explore our pioneering projects and partners.') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="owl-carousel partner-slider">
                        @foreach ($developers as $item)
                            <div class="item bg-white">
                                <a href="{{route('developers.show' , ['developer' => $item])}}"><img src="{{ $item->logo }}" alt="{{$item->name}}-logo" /></a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Data Counting Start --}}
    <div class="full-row bg-center overlay-secondary paraxify py-5" style="background-image: url(assets/images/new/bg-1.jpg); background-repeat: no-repeat; background-position: center -17.42px;">
        <div class="container">
            <div class="fact-counter position-relative z-index-9">
                <div class="row row-cols-lg-4 row-cols-sm-2 row-cols-1">
                    <div class="col">
                        <div class="my-30 text-center count wow fadeIn animate" data-wow-duration="300ms" style="visibility: visible; animation-duration: 300ms; animation-name: fadeIn;">
                            <span class="count-num text-primary h2" data-speed="3000" data-stop="{{$unitsCount}}"></span>
                            <h5 class="text-white font-400 pt-2">{{ __('Listed Property') }}</h5>
                        </div>
                    </div>
                    <div class="col">
                        <div class="my-30 text-center count wow fadeIn animate" data-wow-duration="300ms" style="visibility: visible; animation-duration: 300ms; animation-name: fadeIn;">
                            <span class="count-num text-primary h2" data-speed="3000" data-stop="{{$projectsCount}}"></span>
                            <h5 class="text-white font-400 pt-2">{{ __('Listed Projects') }}</h5>
                        </div>
                    </div>
                    <div class="col">
                        <div class="my-30 text-center count wow fadeIn animate" data-wow-duration="300ms" style="visibility: visible; animation-duration: 300ms; animation-name: fadeIn;">
                            <span class="count-num text-primary h2" data-speed="3000" data-stop="25">25</span>
                            <h5 class="text-white font-400 pt-2">{{ __('Awards Won') }}</h5>
                        </div>
                    </div>
                    <div class="col">
                        <div class="my-30 text-center count wow fadeIn animate" data-wow-duration="300ms" style="visibility: visible; animation-duration: 300ms; animation-name: fadeIn;">
                            <span class="count-num text-primary h2" data-speed="3000" data-stop="2130">2130</span>
                            <h5 class="text-white font-400 pt-2">{{ __('Happy Clients') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Testimonial Section Start --}}
    <div class="full-row">
        <div class="container">
            <div class="row">
                <div class="col mb-5">
                    <span class="text-primary tagline pb-2 d-table m-auto">{{ __('Insights from Our Valued Clients') }}</span>
                    <h2 class="down-line w-50 mx-auto mb-4 text-center w-sm-100">{{ __('Explore Client Feedback on TAG Properties') }}</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="testimonial-simple text-center px-5">
                        <div class="text-carusel owl-carousel">
                            @foreach ($testimonies as $_item)
                                <div class="item">
                                    <i class="flaticon-right-quote flat-large text-primary d-table mx-auto"></i>
                                    <blockquote class="text-secondary fs-5 fst-italic">“ {{ $_item->content }} ”</blockquote>
                                    <h4 class="mt-4 font-400">{{ $_item->name }}</h4>
                                    <span class="text-primary font-fifteen">{{ $_item->designation }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Blog Section Start --}}
    <div class="full-row bg-light">
        <div class="container">
            <div class="row">
                <div class="col">
                    <span class="pb-2 d-table w-50 w-sm-100 text-primary m-auto text-center tagline">{{ __('Insights & Inspiration') }}</span>
                    <h2 class="down-line w-50 w-sm-100 mx-auto text-center mb-5">{{ __('Explore Our Latest Real Estate Articles and Tips') }}</h2>
                </div>
            </div>
            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1">
                @foreach ($blogs as $blog)
                    <div class="col">
                        <div class="thumb-blog-overlay bg-white hover-text-PushUpBottom mb-4">
                            <div class="post-image position-relative overlay-secondary">
                                <img src="{{$blog->thumbImage}}" alt="{{$blog->title}} thumbnail image">
                                <div class="position-absolute xy-center">
                                    <div class="overflow-hidden text-center">
                                        <a class="text-white first-push-up transation font-large" href="{{route('blog.show' , ['blog' => $blog->slug])}}">+</a>
                                    </div>
                                </div>
                            </div>
                            <div class="post-content p-35">
                                <h5 class="d-block font-400 mb-3"><a href="{{route('blog.show' , ['blog' => $blog->slug])}}" class="transation text-dark hover-text-primary">{{$blog->title}}</a></h5>
                                <p>{{$blog->description}}</p>
                                <div class="post-meta text-uppercase">
                                    @if ($blog->creator)
                                        <a name="blog-author"><span>{{$blog->creator->name ?? ''}}</span></a>
                                    @endif
                                    <a name="blog-date"><span>{{\Carbon\Carbon::parse($blog->publish_date)->format('d-m-Y')}}</span></a>
                                </div>
                            </div>
                        </div>
                    </div>    
                @endforeach
            </div>
        </div>
    </div>
    {{-- Register Section Start --}}
    <div class="full-row bg-primary py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <h3 class="text-white xs-text-center my-20 font-400">{{ __('Discover our expert services and sell your property quickly and profitably with TAG Properties.') }}</h3>
                </div>
                <div class="col-lg-3 col-md-4">
                    <a href="{{ route('property-list') }}" class="btn btn-white y-center position-relative d-table xs-mx-auto ms-auto">{{ __('Sell Smarter with TAG') }}</a>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            window.addEventListener('scroll', function() {
                var navbar = document.getElementById('main-navbar');
                if (window.scrollY > 0) {
                    navbar.classList.remove('nav-white');
                    navbar.classList.add('nav-secondary');
                } else {
                    navbar.classList.remove('nav-secondary');
                    navbar.classList.add('nav-white');
                }
            });
            function toggleNavbarColor() {
                const navbar = document.getElementById('main-navbar');
                if (window.innerWidth <= 991.98) { // Check for small screen size
                    navbar.classList.remove('nav-white');
                    navbar.classList.add('nav-secondary');
                } else {
                    navbar.classList.remove('nav-secondary');
                    navbar.classList.add('nav-white');
                }
            }

            // Call the function on page load and window resize
            toggleNavbarColor();
            window.addEventListener('resize', toggleNavbarColor);
        </script>
    @endpush
@endsection