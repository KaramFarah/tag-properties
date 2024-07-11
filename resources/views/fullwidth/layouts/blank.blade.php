<!DOCTYPE html>
<html lang="en">
    <head>
        @include('fullwidth.layouts.head')
    </head>
    <!-- body start -->
    <body>
        <main class="">
            @yield('content')            
        </main>
        <!-- end page -->
        @include('fullwidth.layouts.javascript')
    </body>
</html>