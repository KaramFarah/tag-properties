
@extends('website.layout.app-blog')
@section('pageTitle', $local_title . ' | ' . config('panel.site_title'))
@section('content')
    @include('website.layout.title-banner')
    <div class="full-row pt-30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h4 class="mb-4">{{__('Submit Your CV')}}</h4>
                    <form id="apply_form" action="{{route('apply-store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="career_id" value="{{$career->id}}">
                        <input type="hidden" name="user_id" value="{{Auth::user()->id ?? 0}}">
                        <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Full Name') }}" inputRequired="required" inputValue="{{ old('name', Auth::user()->name ?? '') }}" class="mb-30"/>
                        <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" inputRequired="required" inputValue="{{ old('email', Auth::user()->email ?? '') }}" class="mb-30"/>
                        <x-inputs.text inputName="birthday" inputId="birthday" inputLabel="{{ __('Birthday') }}" inputRequired="required" inputValue="{{ old('birthday', Auth::user()->birthday ?? '') }}" type="date" class="mb-30"/>
                        <div class="row">
                            <div class="col-lg-6">
                                @include('fullwidth.partials.apply-inputs', [
                                    'selected_country' => 'AE',
                                    'countryName' => 'residence',
                                    'countryId' => 'residence',
                                    'countryLabel' =>  __('Residence')
                                ])
                            </div>
                            <div class="col-lg-6">                                
                                @include('fullwidth.partials.apply-inputs', [
                                    'selected_country' => '',
                                    'countryName' => 'nationality',
                                    'countryId' => 'nationality',
                                    'countryLabel' =>  __('Nationality')
                                ]) 
                            </div>
                        </div>
                        <x-inputs.select inputName="city" inputId="city" inputLabel="{{ __('City') }}" :inputData="$cities" showButtons="false" inputValue="{{ old('city','') }}" class="mb-30"/>
                        @include('fullwidth.partials.inte-phone')
                        <div class="mb-20">
                            <label class="mb-2 required">CV</label>
                            <input type="file" class="form-control" id="cv" name="cv" value="{{old('cv')}}" required>
                            @if($errors->has('cv'))
                                <div class="text-danger">{{ $errors->first('cv') }}</div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary" name="submit" type="submit">{{__('Apply')}}</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <h4 class="mb-4">{{__('Or Get Expert Help')}}</h4>
                    @include('website.partials.contact_form')
                </div>
            </div>
        </div>
    </div>
@endsection