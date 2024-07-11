<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="robots" content="noindex">
<meta name="robots" content="nofollow">
<meta name="author" content="digipro">
<title>@yield('pageTitle')</title>
<meta name="description" content="@yield('pageDescription')">
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}">

<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,700;1,400&display=swap" rel="stylesheet">

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
{{-- <link rel="stylesheet" href="{{asset('assets/fullwidth/css/font/bootstrap-icons.min.css')}}"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
{{-- <link rel="stylesheet" href="{{ asset('css/custom.css') }}" /> --}}
<link rel="stylesheet" href="{{ asset('assets/fullwidth/css/select2/select2.min.css') }}">
@yield('styles')
@includeWhen(Str::endsWith(env('APP_URL'), config('panel.live_domain')), 'website.layout.brevo')