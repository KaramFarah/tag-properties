<x-inputs.text inputName="title" inputId="title" inputLabel="{{ __('Title') }}" inputRequired="required" inputValue="{{ old('title', $tag->title ?? '') }}" inputHint="" inputClass="" class="mb-3 form-group" type="text"/>
<button class="btn btn-outline-success" type="submit">
    <i class="bi bi-save"></i> {{ __('Save') }}
</button>