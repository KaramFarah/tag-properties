<div class="row">
    <div class="col">
        <x-inputs.text inputName="type" inputId="type" inputLabel="{{ __('Type') }}" inputRequired="required" inputValue="{{ old('type', $installment->type) }}" class="mb-30" />
    </div>
</div>
<div class="row">
    <div class="col">
        <x-inputs.text inputName="milestone" inputId="milestone" inputLabel="{{ __('Milestone') }}" inputRequired="required" inputValue="{{ old('milestone', $installment->milestone) }}" class="mb-30" />
    </div>
</div>
<div class="row">
    <div class="col">
        <x-inputs.text inputName="payment" inputId="payment" inputLabel="{{ __('Payment') }}" inputRequired="required" inputValue="{{ old('payment', $installment->payment) }}" class="mb-30" />
    </div>
</div>
<button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> {{ __('Save') }}</button>
<a class="btn btn-secondary" href="{{ route('dashboard.installments.index') }}">{{ __('Close') }}</a>