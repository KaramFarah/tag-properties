<div class="card mb-30">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" inputRequired="required" inputValue="{{ old('name', $agent->name ?? '') }}" inputHint="" inputClass="required" class="mb-30" type="text"/>
            </div>
            <div class="col">
                <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" inputRequired="required" inputValue="{{ old('email', $agent->email ?? '') }}" inputHint="" inputClass="required" class="mb-30" type="text"/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="birthday">{{__('Birthday')}}</label>
                <input class="form-control mb-30" type="date" id="birthday" name="birthday" value="{{old('birthday', $agent->birthday )}}">
            </div>
            <div class="col">
                @include('fullwidth.partials.inte-phone')
                {{-- <label for="phone">{{__('Phone')}}</label>
                <input maxlength="10" class="form-control mb-30" type="text" id="phone" name="phone" value="{{old('phone', $agent->phone ?? '')}}"> --}}
            </div>
        </div>
        <div class="row">
            <div class="col">
                <x-inputs.text inputName="emitaes_id" inputId="emitaes_id" inputLabel="{{ __('Emirates ID') }}" inputRequired="" inputValue="{{ old('emitaes_id', $agent->emitaes_id ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text" inputPlaceholder="784-xxxx-xxxxxxx-x"/>
            </div>
            <div class="col">
                <x-inputs.text inputName="brn" inputId="brn" inputLabel="{{ __('BRN') }}" inputRequired="" inputValue="{{ old('brn', $agent->brn ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
            </div>
            <div class="col">
                <x-inputs.text inputName="employee_id_number" inputId="employee_id_number" inputLabel="{{ __('Employment Number') }}" inputRequired="" inputValue="{{ old('employee_id_number', $agent->employee_id_number ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
            </div>
        </div>
        <div class="row">
            {{-- <div class="col">
                @include('fullwidth.partials.countries', ['selected_country' => $agent->country])
            </div> --}}
            <div class="col">
                <x-inputs.select inputName="preferred_languages[]" inputId="preferred_languages" inputLabel="{{ __('Spoken Languages') }}" placeholder="{{ __('Select Languages') }}" inputRequired="" :inputValue="old('preferred_languages[]',  $agent->tags ?? $languages)" :inputData="$languages" inputClass="select2 mb-30" inputType="multiple" />
            </div>
        </div>
            
    </div>
</div>
<button class="btn btn-primary" type="submit">
    <i class="bi bi-save"></i> {{ __('Save') }}
</button>
<a class="btn btn-secondary" href="{{ route('dashboard.agents.index') }}">{{ __('Close') }}</a>

@can('tag_create')
    @push('scripts')
        <script>
            $(document).ready(function () {
                $("#preferred_languages").select2({
                    tags: true,
                    width: '100%'
                })
            }) 
        </script>
    @endpush
@endcan