@extends(config('panel.template') . '.layouts.auth')
@section('content')
@section('pageTitle', __('Reset Password') . ' | ' . config('panel.site_title'))
@section('styles')
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet" />
@endsection
<div class="row">
    <div class="col-xl-5 col-lg-6 mx-auto">
        <div class="bg-white xs-p-20 p-30 border rounded">
            <div class="form-icon-left rounded form-boder">
                <form method="POST" action="{{ route('password.request') }}">
                    @csrf
                    <input name="token" value="{{ $token }}" type="hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" error="{{ $errors->has('email') ? $errors->first('email') : '' }}" inputRequired="required" class="mb-3" inputValue="{{ old('email', $email ?? '') }}" inputHint="" inputClass="" class="mb-3" type="text"/>
                            <x-inputs.text inputName="password" inputId="password" inputLabel="{{ __('New Password') }}" error="{{ $errors->has('password') ? $errors->first('password') : '' }}" inputRequired="required" class="mb-3" inputValue="{{ old('password', $password ?? '') }}" inputHint="" inputClass="" class="mb-3" type="password"/>
                            <x-inputs.text inputName="password_confirmation" inputId="password-confirm" inputLabel="{{ __('Confirm New Password') }}" error="{{ $errors->has('password-confirm') ? $errors->first('password-confirm') : '' }}" inputRequired="required" class="mb-3" inputValue="{{ old('password-confirm', $password ?? '') }}" inputHint="" inputClass="" class="mb-3" type="password"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-flat btn-block">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection