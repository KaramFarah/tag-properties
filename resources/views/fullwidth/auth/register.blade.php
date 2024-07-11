@extends('website.layout.app-blog')
@section('pageTitle', sprintf('%s | %s', __('Register'), config('panel.site_title')))
@section('content')
    @include('website.layout.title-banner-black')
    <div class="full-row pt-30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="bg-white xs-p-20 p-30 border rounded">
                        <div class="form-icon-left rounded form-boder">
                            <h4 class="mb-4">{{ __('User Register') }}</h4>
                            <form id="register_form" action="{{ route('register') }}" method="POST">
                                @csrf
                                <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="name" inputId="name" inputLabel="{{ __('Name') }}" error="{{ $errors->has('email') ? $errors->first('email') : '' }}" inputRequired="required" inputValue="{{ old('name', $name ?? '') }}" inputHint="" inputClass="" class="mb-3" type="text"/>
                                <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="email" inputId="email" inputLabel="{{ __('Email') }}" error="{{ $errors->has('email') ? $errors->first('email') : '' }}" inputRequired="required" inputValue="{{ old('email', $email ?? '') }}" inputHint="" inputClass="" class="mb-3" type="text"/>
                                <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="password" inputId="password" inputLabel="{{ __('Password') }}" error="{{ $errors->has('password') ? $errors->first('password') : '' }}" inputRequired="required" inputClass="" class="mb-3" inputValue="{{ old('password', $password ?? '') }}" inputHint="" type="password"/>
                                <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="phone" inputId="phone" inputLabel="{{ __('Phone') }}" error="{{ $errors->has('phone') ? $errors->first('phone') : '' }}" inputRequired="" inputClass="" class="mb-3" inputValue="{{ old('phone', $phone ?? '') }}" inputHint="" type="text"/>
                                <input type="hidden" name="roles" value="{{$role}}">
                                <div class="mb-3 d-grid gap-2">
                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                    >{{ __('Register') }}
                                </button>
                                </div>
                                <div class="mb-3">
                                    <a href="{{ route('login') }}" class="text-dark d-table py-1">{{ __('Already Have an Account') }}</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection