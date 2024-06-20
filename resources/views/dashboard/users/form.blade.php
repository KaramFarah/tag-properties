<div class="row">
    <div class="col-md-6 form-group">
        <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" inputRequired="required" inputValue="{{ old('name', $user->name ?? '') }}" inputHint="" inputClass="" class="mb-3" type="text"/>
    </div>
    <div class="col-md-6 form-group">
        <x-inputs.text inputName="birthdate" inputId="birthdate" inputLabel="{{ __('Birthday') }}" inputRequired="required" inputValue="{{ old('birthdate', $user->birthdate ?? '') }}" inputHint="" inputClass="date" class="mb-3" type="text"/>
    </div>
</div>
<div class="row">
    <div class="col-md-6 form-group">
        <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" inputRequired="required" inputValue="{{ old('email', $user->email ?? '') }}" inputHint="" inputClass="" class="mb-3" type="text"/>
    </div>
    <div class="col-md-6 form-group">
        <x-inputs.text inputName="password" inputId="password" inputLabel="{{ __('Password') }}" inputRequired="{{ $user->password ? '' : 'required' }}" inputValue="{{ old('password', '') }}" inputHint="" inputClass="" class="mb-3" type="password"/>
    </div>
</div>
<x-inputs.select inputName="roles[]" inputId="roles" inputLabel="{{ __('Roles') }}" placeholder="{{ __('Select Roles') }}" inputRequired="required" :inputValue="$user->roles" :inputData="$roles" inputHint="" inputClass="addFormselect2 select2" class="mb-3 form-group" inputType="multiple"/>
<button class="btn btn-outline-success" type="submit">
    <i class="bi bi-save"></i> {{ __('Save') }}
</button>