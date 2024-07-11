<div class="card mb-30">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" inputRequired="required" inputValue="{{ old('name', $agent->name ?? '') }}" inputHint="" inputClass="required" class="mb-30" type="text"/>
            </div>
            <div class="col">
                <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" inputRequired="required" inputValue="{{ old('email', $agent->email ?? '') }}" inputHint="" inputClass="required" class="mb-30" type="text"/>
            </div>
            <div class="col">
                <label for="birthday">{{__('Birthday')}}</label>
                <input class="form-control mb-30" type="date" id="birthday" name="birthday" value="{{old('birthday', $agent->birthday )}}">
            </div>
        </div>
        @include('fullwidth.partials.agent-details')
            
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