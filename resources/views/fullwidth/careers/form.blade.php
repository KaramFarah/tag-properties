<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <div class="row mb-20">
                <div class="col">
                    <x-inputs.text inputName="job_title" inputId="job_title" inputLabel="{{ __('Job Title') }}" inputRequired="required" inputValue="{{ old('job_title', $career->job_title ?? '') }}" />
                </div>
                <div class="col">
                    <x-inputs.text inputName="employment_type" inputId="employment_type" inputLabel="{{ __('Employment Type') }}" inputRequired="" inputValue="{{ old('employment_type', $career->employment_type ?? '') }}" />
                </div>
            </div>
            <div class="row mb-20">
                <div class="col">
                    <x-inputs.textarea inputName="requirements" inputId="requirements" inputLabel="{{ __('Requirements') }}" inputRequired="" inputValue="{{ old('requirements', $career->requirements ?? '') }}" />
                </div>
                <div class="col">
                    <x-inputs.textarea inputName="qualifications" inputId="qualifications" inputLabel="{{ __('Qualifications') }}" inputRequired="" inputValue="{{ old('qualifications', $career->qualifications ?? '') }}" />
                </div>
            </div>
            <div class="row mb-20">
                <div class="col">                
                    <x-inputs.text inputName="expiry_date" inputId="expiry_date" inputLabel="{{ __('Expiry Date') }}" inputRequired="" inputValue="{{old('expiry_date', $career->expiry_date )}}" inputHint="" inputClass=" mb-30" type="date"/>
                </div>
            </div>
            <div class="row mb-20">
                <div class="col-md-12">
                    <x-inputs.textarea inputName="job_description" inputId="job_description" inputLabel="{{ __('Job Description') }}" inputRequired="" inputValue="{{ old('job_description', $career->job_description ?? '') }}" />
                </div>
            </div>
        </div>
    </div>
</div>            
    <button class="btn btn-primary" type="submit">
        <i class="bi bi-save"></i> {{ __('Save') }}
    </button>
    <a class="btn btn-secondary" href="{{ route('dashboard.careers.index') }}">{{ __('Close') }}</a>