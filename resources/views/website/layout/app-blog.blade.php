<!doctype html>
<html lang="en">
    <head>
        @section('pageTitle', ($local_title ?? '') . ' | ' . config('panel.website_title'))
        @section('pageDescription', $local_description ?? '')
        @include('website.layout.head')
    </head>
    <body>
        <div class="preloader">
            <div class="loader xy-center"></div>
        </div>
        <div id="page_wrapper" class="bg-light">
            @include('website.layout.topbar-blog')
            @include('website.layout.content')
            @include('website.layout.footer')
        </div>
        @include('website.layout.javascript')
        @includeWhen(Str::endsWith(env('APP_URL'), config('panel.live_domain')), 'website.layout.whatsapp')
    </body>
</html>