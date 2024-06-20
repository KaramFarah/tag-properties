@extends(config('panel.template') . '.layouts.auth')
@section('content')
    @section('pageTitle', sprintf('%s | %s', __('Sign In'), config('panel.site_title')))
    @section('styles')
        <link href="{{ asset('css/signin.css') }}" rel="stylesheet" />
    @endsection    
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <h2>{{ __('Dashboard - Sign In') }}</h2>
            </div>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" error="{{ $errors->has('email') ? $errors->first('email') : '' }}" inputRequired="required" inputValue="{{ old('email', $email ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
                <x-inputs.text inputName="password" inputId="password" inputLabel="{{ __('Password') }}" error="{{ $errors->has('password') ? $errors->first('password') : '' }}" inputRequired="required" inputClass="" class="mb-30" inputValue="{{ old('password', $password ?? '') }}" inputHint="" type="password"/>
                <div class="mb-30 form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                </div>
                <div class="mb-30 w-50">
                   <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                </div>
                <div class="mb-30">
                    <a href="{{ route('password.request') }}" class="text-muted ms-1"><i class="fa fa-lock me-1"></i>{{ __('Forgot Password') }}</a>
                </div> 
            </form>
        </div>
    </div>
@endsection