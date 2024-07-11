@extends('website.layout.app-blog')
@section('pageTitle', __('About Us') . ' | ' . config('panel.site_title'))
@section('content')
    @include('website.layout.title-banner-black')
<!--============== Page Banner End ==============-->

    <div class="full-row bg-light pb-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <div class="text-secondary mb-lg-5">
                        <span class="tagline-2 text-primary">About TAG Properties</span>
                        <h2 class="text-secondary mb-4">Elevating Real Estate Experiences</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row row-cols-xl-2 row-cols-1">
                <div class="col px-0"><img src="assets/images/new/bg-5.jpg" alt="play video image"></div>
                <div class="col bg-white" style="margin-top: -100px;">
                    <div class="w-75 w-lg-100 sm-px-0" style="padding:50px 80px">
                        <div class="simple-video-play d-flex mb-3">
                            <div class="position-relative d-inline-block">
                                <a data-fancybox href="https://www.youtube.com/watch?v=zSVjsQ34otY" class="rounded-circle position-relative bg-secondary" style="z-index: 10"><i class="flaticon-play-button position-relative xy-center flat-mini rounded-circle text-white"></i></a>
                                <div class="loader position-absolute xy-center">
                                    <div class="loader-inner ball-scale-multiple">
                                        <div></div>
                                        <div></div>
                                    </div><span class="tooltip">
                                <b>ball-scale-multiple</b></span>
                                </div>
                            </div>
                            <div class="ps-4 text-secondary font-medium">Play Video</div>
                        </div>

                        <h2 class="text-secondary mb-5">At TAG Properties, we're more than real estate; we're the architects of your aspirations.</h2>
                        <div class="bb-accordion ac-single-show accordion-plus-left">
                            <div class="ac-card">
                                <a class="ac-toggle text-dark text-truncate active" href="#">Realizing Dreamsn</a>
                                <div class="ac-collapse show" style="display: block;">
                                    <p>With a profound understanding of the UAE's real estate intricacies, TAG Properties is your trusted guide in property sales, leasing, investment advisory, concierge service, mortgage advice, and property management. We're committed to turning your property dreams into reality.</p>
                                </div>
                            </div>
                            <div class="ac-card">
                                <a class="ac-toggle text-dark text-truncate" href="#">Unwavering Excellence</a>
                                <div class="ac-collapse">
                                    <p>Our seasoned agents provide unwavering support, navigating the complexities of the market to ensure a seamless experience for buyers and sellers. We pride ourselves on leaving no stone unturned to find your perfect home.</p>
                                </div>
                            </div>
                            <div class="ac-card">
                                <a class="ac-toggle text-dark text-truncate" href="#">A Vision for You</a>
                                <div class="ac-collapse">
                                    <p>TAG Properties is dedicated to delivering professional, honest, and personalized service. Our mission is to establish ourselves as the preferred real estate brokerage in the UAE, based on excellence and trust. We're here to build long-lasting relationships, and we live by our ethos: "Service Beyond the Sale”.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!--============== Banner Start ==============-->
    <div class="full-row paraxify" style="background-image: url(assets/images/new/bg-4.jpg); background-repeat: no-repeat; background-position: center center; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-8">
                    <div class="text-white">
                        <span class="tagline text-primary">Explore TAG Properties</span>
                        <h3 class="mb-4 text-white">Get to know us better, our values, and our commitment to elevating your real estate experience.</h3>
                        <p>At TAG Properties, we're not just real estate experts; we're dream weavers. We're passionate about creating exceptional experiences for our clients, providing innovative solutions, and setting new standards in the industry.</p>
                        <p>
                            Our partnerships with top-tier developers, our insightful blog, and our dedicated team exemplify our commitment to excellence. We're here to elevate your real estate journey, one exceptional experience at a time.
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============== Banner End ==============-->

    <!--============== Features Start ==============-->
    <div class="full-row pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="text-secondary mb-5">
                        <span class="tagline-2 text-primary">Why Choose TAG Properties?</span>
                        <h2 class="text-secondary mb-4">Your Key to Real Estate Excellence</h2>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row row-cols-md-2 row-cols-1">
                        <div class="col border-start border-geay mb-5">
                            <div class="simple-thumb transation px-4">
                                <span class="h3 down-line text-general mb-4 d-table">01</span>
                                <h5 class="my-3"><a href="#" class="text-secondary">Expertise Beyond Compare:</a></h5>
                                <p>With an intimate understanding of the UAE real estate market, TAG Properties offers unrivaled expertise in property sales, leasing, investment, and management. Our experienced agents navigate market intricacies to provide you with the best guidance.</p>
                            </div>
                        </div>
                        <div class="col border-start border-geay mb-5">
                            <div class="simple-thumb transation px-4">
                                <span class="h3 down-line text-general mb-4 d-table">02</span>
                                <h5 class="my-3"><a href="#" class="text-secondary">Personalized Service:</a></h5>
                                <p>At TAG Properties, we are dedicated to delivering a service that is tailored to your unique needs. We ensure that every unit listed with us receives the attention and care it deserves, guiding you through the complexities of the real estate journey.</p>
                            </div>
                        </div>
                        <div class="col border-start border-geay mb-5">
                            <div class="simple-thumb transation px-4">
                                <span class="h3 down-line text-general mb-4 d-table">03</span>
                                <h5 class="my-3"><a href="#" class="text-secondary">Trusted Partnerships</a></h5>
                                <p>We have established trust with renowned developers and industry leaders, which enables us to bring you exclusive opportunities and the latest insights. Our blog and resourceful team reflect our commitment to staying at the forefront of real estate trends.</p>
                            </div>
                        </div>
                        <div class="col border-start border-geay mb-5">
                            <div class="simple-thumb transation px-4">
                                <span class="h3 down-line text-general mb-4 d-table">04</span>
                                <h5 class="my-3"><a href="#" class="text-secondary">Exceptional Client Focus:</a></h5>
                                <p>Beyond the sale, TAG Properties is devoted to creating enduring relationships with our clients. Our core values center on professionalism, honesty, and delivering services that go the extra mile. Your real estate journey with us is defined by service that's always beyond your expectations.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============== Features End ==============-->

    <!--============== Agents Start ==============-->
    <div class="full-row">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="md-mb-30">
                        <span class="tagline-2 text-primary">Awards & Honors</span>
                        <h2 class="text-secondary mb-0">Awards</h2>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row row-cols-md-4 row-cols-sm-2 row-cols-2 g-4 ">
                        <div class="col">
                            <a href="#" class="hover-img-upshow overflow-hidden pe-5 d-block">
                                <img src="{{asset('assets/images/new/oh_logo_01-min.png')}}" alt="awards 1 image">
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="hover-img-upshow overflow-hidden pe-5 d-block">
                                <img src="{{asset('assets/images/new/oh_logo_02-min.png')}}" alt="awards 2 image">
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="hover-img-upshow overflow-hidden pe-5 d-block">
                                <img src="{{ asset('assets/images/new/oh_logo_03-min.png') }}" alt="awards 3 image">
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="hover-img-upshow overflow-hidden pe-5 d-block">
                                <img src="{{asset('assets/images/new/oh_logo_04-min.png')}}" alt="awards 4 image">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============== Agents End ==============-->

    <!--============== Testimonials Start ==============-->
    <div class="full-row bg-white" style="background-image: url(assets/images/new/oh_bg-min.jpg); background-size: 100%">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 mx-auto position-relative">
                    <span class="tagline text-primary">Insights from Our Valued Clients</span>
                    <h2 class="mb-5"><span class="font-weight-bold">Explore Client</span> Feedback on TAG Properties</h2>
                    <div class="owl-carousel single-carusel testimonial-slider dot-disable position-static">
                        <div class="testimonial-item font-medium">
                            <span class="flaticon-right-quote quote-icon flat-medium text-primary"></span>
                            <p>TAG Properties exceeded our expectations. Their commitment to excellence is unmatched. From finding our dream home to expert investment advice, they were our guiding light.</p>
                            <span class="name text-secondary h6 font-weight-medium mt-4 d-table">Jane Smith, Happy Homeowner</span>
                        </div>
                        <div class="testimonial-item font-medium">
                            <span class="flaticon-right-quote quote-icon flat-medium text-primary"></span>
                            <p>The concierge service from TAG Properties made all the difference. They don't just sell properties; they create experiences. We couldn't be happier with our choice.</p>
                            <span class="name text-secondary h6 font-weight-medium mt-4 d-table">John Doe, Delighted Client</span>
                        </div>
                        <div class="testimonial-item font-medium">
                            <span class="flaticon-right-quote quote-icon flat-medium text-primary"></span>
                            <p>TAG Properties is a trusted partner. Their expertise in property management has made our lives easier, and their innovative approach to real estate development is truly visionary.</p>
                            <span class="name text-secondary h6 font-weight-medium mt-4 d-table">Emily Davis, Property Investor</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============== Testimonials End ==============-->

    <!--============== Accordian Start ==============-->

@endsection