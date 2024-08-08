<!--============== Footer Section Start ==============-->
<footer class="full-row footer-default-dark bg-footer" style="padding-bottom: 30px">
    <div class="container">
        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-1">
            <div class="col">
                <div class="footer-widget mb-4">
                    <div class="footer-logo mb-4">
                        <a href="#"><img src="{{ asset('assets/fullwidth/images/logo-new/logo-white.png') }}" alt="Image not found!" /></a>
                    </div>
                    <p>Committed to elevating your real estate endeavors with our extensive expertise and personalized guidance in the dynamic Syrian market. Our seasoned team of professionals brings years of experience in property advisory, investment analysis, and real estate consultation, ensuring that your unique goals and needs are not only met but exceeded.</p>
                </div>
                <div class="footer-widget media-widget mb-4">
                    <a href="#" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
            <div class="col">
                <div class="footer-widget contact-widget mb-4">
                    <h3 class="widget-title mb-4">{{__('Contact Info')}}</h3>
                    <ul>
                        <li>Tag Properties Business Bay, Tishreen-University, Lattakia, SY.</li>
                        <li> {{config('panelphone')}} </li>
                        <li>{{config('panel.website_email')}}</li>
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="footer-widget footer-nav mb-4">
                    <h3 class="widget-title mb-4">Quick Links</h3>
                    <ul>
                        <li><a href="{{route('properties')}}">      {{__('All Properties')}}</a></li>
                        <li><a href="{{route('developers.index')}}">{{__('Developers')}}</a></li>
                        <li><a href="{{ route('about') }}">         {{__('About Us')}}</a></li>
                        <li><a href="{{ route('blog.index') }}">    {{__('Blog')}}</a></li>
                        <li><a href="{{ route('contact') }}">       {{__('Contact')}}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="footer-widget newslatter-widget mb-4">
                    <h4 class="widget-title mb-4">Free Consultation</h4>
                    <p>Have questions or need guidance? Schedule a free consultation with our experts and explore your property's full potential.</p>
                    <a href="#" class="btn btn-primary w-100">Book Your Call</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--============== Footer Section End ==============-->

<!--============== Copyright Section Start ==============-->

{{-- <div class="copyright bg-footer text-default py-4">
    <div class="container">
        <div class="row row-cols-md-2 row-cols-1">
            <div class="col">
                <span class="text-white">© 2023 Tag Properties All right reserved</span>
            </div>
            <div class="col">
                <ul class="line-menu float-end list-color-gray">
                    <li><a href="#">Privacy & Policy </a></li>
                    <li>|</li>
                    <li><a href="#">Site Map</a></li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}

<!--============== Copyright Section End ==============-->

<!-- Scroll to top -->
<div class="scroll-top-vertical xs-mx-none" id="scroll">Go Top <i class="ms-2 fa-solid fa-arrow-right-long"></i></div>
<!-- End Scroll To top -->
<form id="logoutform-profile" action="{{ route('logout') }}" onsubmit="return confirm('{{ __('Are you sure you want to logout now?') }}');" method="POST" class="d-none">
    {{ csrf_field() }}
</form>