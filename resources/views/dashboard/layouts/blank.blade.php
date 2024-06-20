<!DOCTYPE html>
<html lang="en">
    <head>
        @include('dashboard.layouts.head')
    </head>
    <!-- body start -->
    <body>
        <main class="">
            @yield('content')            
        </main>
        <!-- end page -->
        @include('dashboard.layouts.javascript')
    </body>
</html>