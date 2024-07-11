<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @section('pageTitle', ($local_title ?? '') . ' | ' . config('panel.site_title'))
        @include('fullwidth.layouts.head')
        {{-- <style>
            *{
                direction: rtl !important;
            }
        </style> --}}
        @livewireStyles
    </head>
    <body>
        <div class="preloader">
            <div class="loader xy-center"></div>
        </div>
        <div id="page_wrapper" class="bg-gray vh-100">
            <div class="container-fluid">
                <div class="row">{{-- Start Page Content here --}}
                    <div class="col-md-4 col-lg-3 col-xl-2 px-0">
                        @include('fullwidth.layouts.left-side')
                    </div>
                    <div class="col-md-8 col-lg-9 col-xl-10 px-0 dashboard-body border-start" style="height: 100vh; overflow-y: scroll;">
                        @include('fullwidth.layouts.topbar')
                        @include('fullwidth.layouts.content')
                        @include('fullwidth.layouts.footer')
                    </div>
                    @include('partials.modal')
                </div>{{-- End Page content --}}
            </div>
        </div>
        @include('fullwidth.layouts.javascript')
        @livewireScripts
    </body>
</html>