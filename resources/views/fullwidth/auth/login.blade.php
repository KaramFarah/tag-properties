@extends('website.layout.app-blog')
@section('pageTitle', sprintf('%s | %s', __('User Login'), config('panel.site_title')))
@section('content')
    @include('website.layout.title-banner-black')
    <div class="full-row pt-30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    @include('website.partials.login_form')
                </div>
            </div>
        </div>
    </div>
@endsection