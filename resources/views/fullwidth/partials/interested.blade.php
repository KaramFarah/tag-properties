<div class="text-center">
    <input type="checkbox" {{ $lead->interested ? 'checked ' : ''}}class="btn-check" id="btn-interested-outlined" autocomplete="off" name="interested" value="1">
    <label class="btn btn-outline-primary w-50" for="btn-interested-outlined" data-bs-toggle="collapse" data-bs-target="#interestedBox">{{ __('Is Interested?')}}</label>
</div>
<div id="interestedBox" class="border p-30 collapse{{ $lead->interested ? ' show' : ''}}">
    <div class="row mb-30">
        <div class="col-md-4">
            <x-inputs.select inputName="financing" inputId="financing" inputLabel="{{ __('Financing') }}" error="{{ $errors->has('financing') ? $errors->first('financing') : '' }}" :inputData="$Financial" showButtons="false" inputValue="{{ old('financing', $lead->financing ?? '') }}" inputClass="select2" />
        </div>
        <div class="col-md-4">
            <x-inputs.text inputName="budget" inputId="budget" inputLabel="{{ __('Budget') }}" inputRequired="" inputValue="{{ old('budget', $lead->budget ?? '') }}"/>
        </div>
        <div class="col-md-4">
            <x-inputs.text inputName="expected_purchase_time" inputId="expected_purchase_time" inputLabel="{{ __('Expected Purchase Time') }}" inputRequired="" inputValue="{{ old('expected_purchase_time', $lead->expected_purchase_time ?? '') }}" type="date" />
        </div>
    </div>
    <div class="row mb-30">
        <div class="col-md-3">
            <x-inputs.select inputName="client_type" inputId="client_type" inputLabel="{{ __('Client Type') }}" error="{{ $errors->has('client_type') ? $errors->first('client_type') : '' }}" :inputData="$client_type" showButtons="false" inputValue="{{ old('client_type', $lead->client_type ?? '') }}" inputClass="select2" />
        </div>
        <div class="col-md-3">
            <x-inputs.select inputName="looking_for" inputId="looking_for" inputLabel="{{ __('Looking For') }}" error="{{ $errors->has('looking_for') ? $errors->first('looking_for') : '' }}" :inputData="$looking_for" showButtons="false" inputValue="{{ old('looking_for', $lead->looking_for ?? '') }}" inputClass="select2" />
        </div>
        <div class="col-md-3">
            <x-inputs.text inputName="rooms" inputId="rooms" inputLabel="{{ __('Wanted Bedrooms') }}" inputRequired="" inputValue="{{ old('rooms', $lead->rooms ?? '') }}" type="number"/>
        </div>
        <div class="col-md-3">
            <x-inputs.select inputName="resident" inputId="resident" inputLabel="{{ __('Resident') }}" error="{{ $errors->has('resident') ? $errors->first('resident') : '' }}" :inputData="$resident" showButtons="false" inputValue="{{ old('resident', $lead->resident ?? '') }}" inputClass="select2" />
        </div>
    </div>
    <x-inputs.select inputName="tags[]" inputId="tags" inputLabel="{{ __('Intersets') }}" placeholder="{{ __('Select Tags') }}" inputRequired="" :inputValue="old('tags[]',  $lead->tags)" :inputData="$tags" inputClass="select2 mb-30" inputType="multiple"/>
</div>