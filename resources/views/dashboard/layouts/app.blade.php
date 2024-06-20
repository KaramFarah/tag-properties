<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @section('pageTitle', ($local_title ?? '') . ' | ' . config('panel.site_title'))
        @include('dashboard.layouts.head')
        @livewireStyles
    </head>
    <body class="preloadMain">
        @include('dashboard.layouts.topbar')
        <div class="container-fluid">
            <div class="row">{{-- Start Page Content here --}}
                @include('dashboard.layouts.left-side')
                @include('dashboard.layouts.content')
                @include('partials.modal')
                @include('partials.modal-form')
            </div>{{-- End Page content --}}
        </div>{{-- END wrapper --}}
        {{-- @include('dashboard.layouts.footer') --}}
        @include('dashboard.layouts.javascript')
        @livewireScripts
    </body>
</html>