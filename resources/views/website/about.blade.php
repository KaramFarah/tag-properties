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
                                <p>With an intimate understanding of the Syiran real estate market, TAG Properties offers unrivaled expertise in property sales, leasing, investment, and management. Our experienced agents navigate market intricacies to provide you with the best guidance.</p>
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