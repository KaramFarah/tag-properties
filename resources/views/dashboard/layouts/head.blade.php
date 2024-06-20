<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="robots" content="noindex">
<meta name="robots" content="nofollow">
<title>@yield('pageTitle')</title>
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/favicon.png') }}">
<!-- App css -->
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/dashboard/libs/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/dashboard/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
<link href="{{ asset('css/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />
@yield('styles')