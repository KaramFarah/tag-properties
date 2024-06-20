<div {{ $attributes }}>
    <label class="form-label {{ $inputRequired }}" for="{{ $inputId }}">{{ $inputLabel }}</label>
    <select class="form-select {{ $inputClass }} {{ $errors->has($inputId) ? 'is-invalid' : '' }}" name="{{ $inputName }}" placeholder="{{ $placeholder }}" id="{{ $inputId }}"{{ $inputType }} {{ $inputRequired }} {{ $inputAttributes }}>

        @foreach($inputData as $id => $item)
            <option value="{{ $id }}"{{ $isSelected($id, $inputValue) ? ' selected' : '' }}>{{$item}}</option>
        @endforeach
    </select>
    @if ($showButtons == 'true')
        <div class="pt-1 text-end">
            <span class="btn btn-mini btn-light select-all" style="border-radius: 0">{{ __('Select All') }}</span>
            <span class="btn btn-mini btn-light deselect-all" style="border-radius: 0">{{ __('Deselect All') }}</span>
        </div>
    @endif
    @if($errors->has($inputId))
        <span class="text-danger">{{ $errors->first($inputId) }}</span>
    @endif
    <span class="help-block">{{ $inputHint }}</span>
</div>