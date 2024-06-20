@extends(config('panel.template') . '.layouts.auth')
@section('content')
@section('pageTitle', sprintf('%s | %s', __('User Reset Password'), config('panel.site_title')))
@section('styles')
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet" />
@endsection
<div class="row">
    <div class="col-xl-5 col-lg-6 mx-auto">
        <div class="bg-white xs-p-20 p-30 border rounded">
            <div class="form-icon-left rounded form-boder">
                <h4 class="mb-4">{{ __('User Reset Password') }}</h4>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" error="{{ $errors->has('email') ? $errors->first('email') : '' }}" inputRequired="required" class="mb-3" inputValue="{{ old('email', $email ?? '') }}" inputHint="" inputClass="" class="mb-3" type="text"/>
                    <div class="mb-3 d-grid gap-2">
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
@endsection