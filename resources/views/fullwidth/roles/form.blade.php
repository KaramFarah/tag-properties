<div class="row">
    <div class="col-md-12">
        <x-inputs.text inputName="title" inputId="title" inputLabel="{{ __('Title') }}" inputRequired="required" inputValue="{{ old('title', $role->title ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <x-inputs.select inputName="permissions[]" inputId="permissions" inputLabel="{{ __('Permissions') }}" placeholder="{{ __('Select Permissions') }}" inputRequired="required" :inputValue="$role->permissions" :inputData="$permissions" inputHint="" inputClass="select2" class="mb-30" inputType="multiple"/>
    </div>
</div>
<button class="btn btn-primary" type="submit">
    <i class="bi bi-save"></i> {{ __('Save') }}
</button>
<a class="btn btn-secondary" href="{{ route('dashboard.roles.index') }}">{{ __('Close') }}</a>