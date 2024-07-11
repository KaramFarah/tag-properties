<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-4">User Information</h4>
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" inputRequired="required" inputValue="{{ old('name', $user->name ?? '') }}" inputHint="" inputClass="required" class="mb-30" type="text"/>
                </div>
                <div class="col-md-6">
                    <x-inputs.text inputName="birthdate" inputId="birthdate" inputLabel="{{ __('Birthday') }}" inputRequired="" inputValue="{{ old('birthdate', $user->birthdate ?? '') }}" inputHint="" inputClass="date" class="mb-30" type="text"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" inputRequired="required" inputValue="{{ old('email', $user->email ?? '') }}" inputHint="" inputClass="required" class="mb-30" type="text"/>
                </div>
                <div class="col-md-6">
                    <x-inputs.text inputName="password" inputId="password" inputLabel="{{ __('Password') }}" inputRequired="{{ $user->password ? '' : 'required' }}" inputValue="{{ old('password', '') }}" inputHint="" inputClass="" class="mb-30" type="password"/>
                </div>
            </div>
            {{-- __________________________________ --}}

            {{-- __________________________________ --}}
            <x-inputs.select inputName="roles[]" inputId="roles" inputLabel="{{ __('Roles') }}" placeholder="{{ __('Select Roles') }}" inputRequired="required" :inputValue="$user->roles" :inputData="$roles" inputHint="" inputClass="select2 required" class="mb-30" inputType="multiple"/>
            </div>
        </div>
    </div>
    
<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-4">Agent Details</h4>
            {{-- 
            <div class="row">
                <div class="col-md-4">
                    <x-inputs.text inputName="phone" inputId="phone" inputLabel="{{ __('Phone') }}" inputRequired="" inputValue="{{ old('phone', $user->phone ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text" inputAttributes="maxlength=10"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.text inputName="employee_id_number" inputId="employee_id_number" inputLabel="{{ __('Employment Number') }}" inputRequired="" inputValue="{{ old('employee_id_number', $user->employee_id_number ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
                </div>
                <div class="col-md-6">
                    <x-inputs.select inputName="spoken_languages[]" inputId="spoken_languages" inputLabel="{{ __('Spoken Languages') }}" placeholder="{{ __('Select Languages') }}" inputRequired="" :inputValue="old('spoken_languages[]',  $user->tags ?? $languages)" :inputData="$languages" inputClass="select2 mb-30" inputType="multiple" />
                </div>
            </div> --}}
            @include('fullwidth.partials.agent-details')
        </div>
    </div>
</div>
    <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
    <a class="btn btn-secondary" href="{{ route('dashboard.users.index') }}">{{ __('Close') }}</a>

    @can('tag_create')
    @push('scripts')
        <script>
            $(document).ready(function () {
                $("#spoken_languages").select2({
                    tags: true,
                    width: '100%'
                })
            }) 
        </script>
    @endpush
@endcan