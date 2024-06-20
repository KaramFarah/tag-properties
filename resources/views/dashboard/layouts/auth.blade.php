<!DOCTYPE html>
<html lang="en">
    <head>
        @include('dashboard.layouts.head')
    </head>
    <!-- body start -->
    <body>
        <main class="container w-50 p-3">
            <x-session-alert/>
            <div class="text-center">
                <a href="{{ route('dashboard.home') }}" class="text-decoration-none"><img class="" src="{{ asset('assets/dashboard/images/dashboard-Logo-1.png') }}" alt="" width="250"></a>
                {{-- <h1 class=""><a href="{{ route('dashboard.home') }}" class="text-decoration-none">{{ config('panel.site_title') }}</a></h1> --}}
            </div>
            @yield('content')
        </main>
        <!-- end page -->
        @include('dashboard.layouts.javascript')
    </body>
</html>