@extends('website.layout.app-blog')
@section('pageTitle', __('Submit Your Property') . ' | ' . config('panel.site_title'))
@include('website.partials.stylesPush')
@section('content')
    @include('website.layout.title-banner-black')
    <div class="full-row pt-30">
        <div class="container">

            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0 mt-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="row">
                @if (auth()->user())
                    <div class="col-8">
                        <h4 class="mb-4">{{ __('Submit Your Property')}}</h4>
                        @can('unit_create')
                            @include('fullwidth.units.websiteForm',
                            [
                                'unit' => new \App\Models\Dashboard\Unit,
                                'route' => route('property-create'),
                            ])
                        @endcan
                    </div>
                @else
                    <div class="col-8"> 
                        <h4 class="mb-4">{{ __('Login or sign up now')}}</h4>
                        @include('website.partials.login_form')    
                    </div>
                @endif
                    <div class="col-lg-4">
                        <!-- Message Form -->
                        <h4 class="mb-4">{{__('Or Get Expert Help')}}</h4>
                        @include('website.partials.contact_form')
                    </div>
            </div>
        </div>
    </div>
@endsection