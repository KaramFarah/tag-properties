@extends(config('panel.template') . '.layouts.app')
@section('pageTitle', sprintf('%s | %s', __('Change Password'), config('panel.site_title')) )
@section('content')
<div class="border rounded bg-white p-30 mb-30">
    <div class="row">
        <div class="col-xl-2">
            <h4 class="mb-4 font-400">{{ __('Change Password') }}</h4>
        </div>
        <div class="col-xl-10">
            <form method="POST" action="{{ route("profile.password.update") }}" class="form-boder">
                @csrf
                <div class="col-lg-6 mb-20">
                    <x-inputs.text inputLabelClass="font-fifteen" inputName="password" inputId="password" inputLabel="{{ __('New Password') }}" error="{{ $errors->has('password') ? $errors->first('password') : '' }}" inputRequired="required" inputClass="" class="mb-3" inputValue="{{ old('password', '') }}" inputHint="" type="password"/>
                </div>
                <div class="col-lg-6 mb-20">
                    <x-inputs.text inputLabelClass="font-fifteen" inputName="password_confirmation" inputId="password_confirmation" inputLabel="{{ __('Confirm New Password') }}" error="{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}" inputRequired="required" inputClass="" class="mb-3" inputValue="{{ old('password_confirmation', '') }}" inputHint="" type="password"/>
                </div>
                <div class="col-lg-12 mb-20">
                    <button class="btn btn-primary" type="submit">
                        {{ __('Save') }} 
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection