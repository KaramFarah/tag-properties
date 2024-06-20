<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <div class="row">
                <div class="col-md-12">
                    <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" inputRequired="required" inputValue="{{ old('name', $tag->name ?? '') }}" inputHint="" inputClass="" class="mb-30"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.select inputName="type" inputId="type" :inputData="$types" inputValue="{{old('type', $tag->type ?? request()->get('type'))}}" showButtons="false" inputLabel="{{__('Type')}}" inputRequired="required"/>
                </div>
                <div class="col-md-6">
                    <x-inputs.select inputName="parent_id" inputId="parent_id" inputLabel="{{ __('Parent') }}" error="{{ $errors->has('parent_id') ? $errors->first('parent_id') : '' }}" :inputData="$parents" showButtons="false" inputValue="{{ old('parent_id', $tag->parent_id ?? '') }}" inputClass="select2" class="mb-3" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.select inputName="value_type" inputId="value_type" :inputData="$value_types" inputValue="{{old('value_type', $tag->value_type ?? request()->get('value_type'))}}" showButtons="false" inputLabel="{{__('Value Type')}}" inputRequired=""/>
                </div>
                <div class="col-md-6">
                    <x-inputs.text inputName="value_options" inputId="value_options" inputLabel="{{ __('Value Options') }}" inputRequired="" inputValue="{{ old('value_options', $tag->value_options ?? '') }}" inputHint="" inputClass="" class="mb-30"/>
                    {{-- <x-inputs.select inputName="parent_id" inputId="parent_id" inputLabel="{{ __('Parent') }}" error="{{ $errors->has('parent_id') ? $errors->first('parent_id') : '' }}" :inputData="$parents" showButtons="false" inputValue="{{ old('parent_id', $tag->parent_id ?? '') }}" inputClass="select2" class="mb-3" /> --}}
                </div>
            </div>
        </div>
    </div>
</div>            
<button class="btn btn-primary" type="submit">
    <i class="bi bi-save"></i> {{ __('Save') }}
</button>
<a class="btn btn-secondary" href="{{ route('dashboard.tags.index') }}">{{ __('Close') }}</a>