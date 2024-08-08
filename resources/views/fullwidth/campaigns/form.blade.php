<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <div class="row mb-20">
                <div class="col">
                    <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" inputRequired="required" inputValue="{{ old('name', $campaign->name ?? '') }}" inputHint="" inputClass="" class=""/>
                </div>
                <div class="col">
                    <x-inputs.text inputName="description" inputId="description" inputLabel="{{ __('Description') }}" inputRequired="" inputValue="{{ old('description', $campaign->description ?? '') }}" inputHint="" inputClass="" class=""/>
                </div>
            </div>
            <div class="row mb-20">
                <div class="col">                
                    <x-inputs.text inputName="start_date" inputId="start_date" inputLabel="{{ __('Start Date') }}" inputRequired="required" inputValue="{{old('start_date', $campaign->start_date )}}" inputHint="" inputClass=" mb-30" type="date"/>
                </div>
                <div class="col">   
                    <x-inputs.text inputName="end_date" inputId="end_date" inputLabel="{{ __('End Date') }}" inputRequired="required" inputValue="{{old('end_date', $campaign->end_date )}}" inputHint="" inputClass="mb-30 " type="date"/>          
                </div>
            </div>
        </div>
    </div>
</div>            
    <button class="btn btn-primary" type="submit">
        <i class="bi bi-save"></i> {{ __('Save') }}
    </button>
    <a class="btn btn-secondary" href="{{ route('dashboard.campaigns.index') }}">{{ __('Close') }}</a>