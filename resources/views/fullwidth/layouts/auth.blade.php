<!DOCTYPE html>
<html lang="en">
    <head>
        @include('fullwidth.layouts.head')
    </head>
    <!-- body start -->
    <body>
        <div class="preloader">
            <div class="loader xy-center"></div>
        </div>
        <div id="page_wrapper" class="bg-light">
            <div class="full-row">
                <div class="container">
                    <x-session-alert/>
                    <div class="text-center">
                        <a href="{{ route('dashboard.home') }}" class="text-decoration-none"><img class="mb-4" src="{{ asset('assets/fullwidth/images/logo-new/logo1.png') }}" alt=""></a>
                    </div>
                    @yield('content')
                </div>
            </div>
            <!-- Scroll to top -->
            <a href="#" class="text-general scroll-top-vertical xs-mx-none" id="scroll">Scroll to top</a>
        </div>
        <!-- end page -->
        @include('fullwidth.layouts.javascript')
    </body>
</html>