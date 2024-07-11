<div class="row">
    <div class="col">
        @include('fullwidth.partials.inte-phone')
    </div>
    <div class="col">
        <x-inputs.text inputName="employee_id_number" inputId="employee_id_number" inputLabel="{{ __('Employment Number') }}" inputRequired="" inputValue="{{ old('employee_id_number', $agent->employee_id_number ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
    </div>
</div>
<div class="row">
    <div class="col">
        <x-inputs.select inputName="preferred_languages[]" inputId="preferred_languages" inputLabel="{{ __('Spoken Languages') }}" placeholder="{{ __('Select Languages') }}" inputRequired="" :inputValue="old('preferred_languages[]',  $agent->tags ?? $languages)" :inputData="$languages" inputClass="select2 mb-30" inputType="multiple" />
    </div>
</div>