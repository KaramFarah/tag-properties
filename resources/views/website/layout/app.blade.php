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

    <div id="page_wrapper" class="bg-white">
        <!--============== Header Section Start ==============-->
        @include('website.layout.topbar')
        <!--============== Header Section End ==============-->

        <!--============== Slider Area Start ==============-->
        @include('website.layout.content')
        @include('website.layout.footer')
    </div>
    @include('website.layout.javascript')
    @push('scripts')
    <script>
    function toggleIconClass(icon) {
    var link = icon.parentNode.getAttribute("link");
    if (icon.classList.contains("fa") && icon.classList.contains("fa-heart")) {
        icon.classList.remove("fa");
        icon.classList.remove("fa-heart");
        icon.classList.add("flaticon-like-1");
        // Submit the link
        window.location.href = link;
    } else if (icon.classList.contains("flaticon-like-1")) {
        icon.classList.remove("flaticon-like-1");
        icon.classList.add("fa");
        icon.classList.add("fa-heart");
        // Submit the link
        window.location.href = link;
    }
    event.preventDefault();
    }
    </script>
    @endpush
    @includeWhen(Str::endsWith(env('APP_URL'), config('panel.live_domain')), 'website.layout.whatsapp')
</body>
</html>