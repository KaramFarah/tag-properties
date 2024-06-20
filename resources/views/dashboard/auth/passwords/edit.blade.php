@extends(config('panel.template') . '.layouts.app')
@section('pageTitle', sprintf('%s | %s', __('Change Password'), config('panel.site_title')) )
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                {{ __('My Profile') }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route("profile.password.updateProfile") }}">
                    @csrf
                    <div class="mb-3">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="mb-3">
                        {{ old('email', auth()->user()->email) }}
                    </div>
                    {{-- <div class="form-group">
                        <button class="btn btn-outline-primary waves-effect waves-light" type="submit" disabled>
                            {{ trans('global.save') }}
                        </button>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                {{ __('Change Password') }}
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route("profile.password.update") }}">
                    @csrf
                    <div class="form-group">
                        <x-inputs.text inputName="password" inputId="password" inputLabel="{{ __('New Password') }}" error="{{ $errors->has('password') ? $errors->first('password') : '' }}" inputRequired="required" inputClass="" class="mb-3" inputValue="{{ old('password', '') }}" inputHint="" type="password"/>
                    </div>
                    <div class="form-group">
                        <x-inputs.text inputName="password_confirmation" inputId="password_confirmation" inputLabel="{{ __('Confirm New Password') }}" error="{{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}" inputRequired="required" inputClass="" class="mb-3" inputValue="{{ old('password_confirmation', '') }}" inputHint="" type="password"/>
                    </div>
                    <button class="btn btn-outline-success" type="submit">
                        <i class="bi bi-save"></i> {{ __('Save') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- <div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                {{ trans('global.delete_account') }}
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route("profile.password.destroyProfile") }}" onsubmit="return prompt('{{ __('global.delete_account_warning') }}') == '{{ auth()->user()->email }}'">
                    @csrf
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.delete') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div> --}}
@endsection