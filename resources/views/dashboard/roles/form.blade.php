<x-inputs.text inputName="title" inputId="title" inputLabel="{{ __('Title') }}" inputRequired="required" inputValue="{{ old('title', $role->title ?? '') }}" inputHint="" inputClass="" class="mb-3 form-group" type="text"/>
<x-inputs.select inputName="permissions[]" inputId="permissions" inputLabel="{{ __('Permissions') }}" placeholder="{{ __('Select Permissions') }}" inputRequired="required" :inputValue="$role->permissions" :inputData="$permissions" inputHint="" inputClass="select2 select2-multiple" class="form-group mb-3" inputType="multiple" />
<button class="btn btn-outline-success" type="submit">
    <i class="bi bi-save"></i> {{ __('Save') }}
</button>