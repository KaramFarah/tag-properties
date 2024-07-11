<!doctype html>
<html lang="en">
    <head>
        @include('website.layout.head')
    </head>
<body>

    <div class="preloader">
		<div class="loader xy-center"></div>
	</div>

    <div id="page_wrapper" class="bg-light">
        <!--============== Header Section Start ==============-->
        <!--============== Header Section End ==============-->

        <!--============== Slider Area Start ==============-->
        @include('website.layout.content')

        <!--============== Modal Start ==============-->

    @include('website.layout.javascript')

</body>
</html>