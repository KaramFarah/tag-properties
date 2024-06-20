
<div class="row">
    <div class="col">
        <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" inputRequired="required" inputValue="{{ old('name', $agent->name ?? '') }}" inputHint="" inputClass="" class="mb-3 form-group" type="text"/>
    </div>
    <div class="col">
        <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" inputRequired="" inputValue="{{ old('email', $agent->email ?? '') }}" inputHint="" inputClass="" class="mb-3 form-group" type="text"/>
    </div>
    <div class="col">
        <x-inputs.text inputName="password" inputId="password" inputLabel="{{ __('Passowrd') }}" inputRequired=""  inputValue="{{ old('password', $agent->password ?? '') }}" inputHint="" inputClass="" class="mb-3 form-group" type="password"/>
    </div>
</div>
<div class="row">
    <div class="col">
        <label for="emitaes_id">Emirates ID</label>
        <input type="text" class="mb-3 form-group" name="emitaes_id" id="emitaes_id" placeholder="784-xxxx-xxxxxxx-x" value="{{ old('emitaes_id', $agent->emitaes_id ?? '') }}">
        {{-- <x-inputs.text inputName="emitaes_id" inputId="emitaes_id" inputLabel="{{ __('Emirates ID') }}" inputRequired="" inputValue="{{ old('emitaes_id', $agent->emitaes_id ?? '') }}" inputHint="" inputClass="" class="mb-3 form-group"  /> --}}
    </div>
    <div class="col">
        <x-inputs.text inputName="brn" inputId="brn" inputLabel="{{ __('BRN') }}" inputRequired="" inputValue="{{ old('brn', $agent->brn ?? '') }}" inputHint="" inputClass="" class="mb-3 form-group" type="text"/>
    </div>
    <div class="col">
        <x-inputs.text inputName="languages" inputId="languages" inputLabel="{{ __('Languages') }}" inputRequired="" inputValue="{{ old('languages', $agent->languages ?? '') }}" inputHint="" inputClass="" class="mb-3 form-group" type="text"/>
    </div>
    <div class="col">
        <x-inputs.text inputName="employee_id_number" inputId="employee_id_number" inputLabel="{{ __('Employment Number') }}" inputRequired="" inputValue="{{ old('employee_id_number', $agent->employee_id_number ?? '') }}" inputHint="" inputClass="" class="mb-3 form-group" type="text"/>
    </div>
</div>
<div class="row">
    <div class="col">
        <label for="birthday">Birth Day</label>
        <input class="form-control mt-2" type="date" id="birthday" name="birthday" value="{{old('birthday', $agent->birthday ?? '')}}">
    </div>
    <div class="col">
        <label for="phone">Phone</label>
        <input class="form-control mt-2" type="text" id="phone" name="phone" value="{{old('phone', $agent->phone ?? '')}}">
    </div>
    <div class="col">
        <x-inputs.select inputName="roles[]" inputId="roles" inputLabel="{{ __('Roles') }}" placeholder="{{ __('Select Roles') }}" inputRequired="required" :inputValue="$agent->roles" :inputData="$roles" inputHint="" inputClass="addFormselect2 select2" class="mb-3 form-group" inputType="multiple" showButtons="false"/>
    </div>
</div>
<br>
<button class="btn btn-outline-success" type="submit">
    <i class="bi bi-save"></i> {{ __('Save') }}
</button>