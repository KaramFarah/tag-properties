<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="robots" content="noindex">
<meta name="robots" content="nofollow">
<meta name="author" content="digipro">
<title>@yield('pageTitle')</title>
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}">

<!-- Google Font -->
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

 <link href="{{ asset('assets/fullwidth/css/fonts/family-Sen.css') }}" rel="stylesheet">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="{{ asset('assets/fullwidth/css/fonts/Barlow.css') }}" rel="stylesheet">

<link href="{{ asset('assets/fullwidth/css/fonts/Material+icon.css') }}" rel="stylesheet">

<!-- Required style of the theme -->
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/animate.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/webfonts/flaticon/flaticon.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/owl.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/jquery.fancybox.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/layerslider.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/template.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/colors/color.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/loader.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/bootstrap-datetimepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/float-buttons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/dropzone.min.css') }}">

<link rel="stylesheet" href="{{asset('assets/fullwidth/css/flatpicker/flatpicker.min.css')}}">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

{{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}" /> --}}
@yield('styles')