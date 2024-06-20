<div class="row">
    <div class="col-md-12">
        <x-inputs.text inputName="title" inputId="title" inputLabel="{{ __('Title') }}" inputRequired="required" inputValue="{{ old('title', $permission->title ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
    </div>
</div>
<button class="btn btn-primary" type="submit">
    <i class="bi bi-save"></i> {{ __('Save') }}
</button>
<a class="btn btn-secondary" href="{{ route('dashboard.permissions.index') }}">{{ __('Close') }}</a>