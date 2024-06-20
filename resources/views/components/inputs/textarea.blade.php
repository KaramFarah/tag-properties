<div {{ $attributes }}>
    @if($inputLabel)
        <label class="mb-2 {{ $inputLabelClass }} {{ $inputRequired }}" for="{{ $inputId }}">{{ $inputLabel }}</label>
    @endif
    <textarea name="{{ $inputName }}" id="{{ $inputId }}" cols="30" rows="5" class="form-control {{ $inputClass ?? ''}} {{ isset($errors) && $errors->has($inputId) ? 'is-invalid' : '' }}" {{ $inputRequired }} {{ $inputAttributes }} placeholder="{{ $inputPlaceholder ?? '' }}">{{ $inputValue }}</textarea>
    @if(isset($errors) && $errors->has($inputId))
        <span class="text-danger">{{ $errors->first($inputId) }}</span>
    @endif
    <span class="help-block">{{ $inputHint }}</span>
</div>