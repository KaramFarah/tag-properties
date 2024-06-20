<div {{ $attributes }}>
    @if($inputLabel)
        <label class="mb-2 {{ $inputLabelClass }} {{ $inputRequired }}" for="{{ $inputId }}">{{ $inputLabel }}</label>
    @endif
    @if($type == 'password')
        <div class="input-group">
    @endif
    <input type="{{ $type }}" class="form-control {{ $inputClass ?? ''}} {{ $errors->has($inputId) ? 'is-invalid' : '' }}" name="{{ $inputName }}" id="{{ $inputId }}" value="{{ $inputValue }}" {{ $inputRequired }} {{ $inputAttributes }} placeholder="{{ $inputPlaceholder ?? '' }}">
    @if($type == 'password')
        <button class="btn btn-small btn-light" id="{{ $inputId }}-show-pass-btn" type="button"><i class="flaticon-eye"></i></button>
        @push('scripts')
            <script>
                $(document).ready(function () {
                    $('#{{ $inputId }}-show-pass-btn').click(function(){
                        if ($('#{{ $inputId }}').attr('type') == 'password'){
                            $('#{{ $inputId }}').attr('type', 'text')
                            $(this).children().removeClass('flaticon-eye')
                            $(this).children().addClass('flaticon-eye-1')
                        }
                        else{
                            $('#{{ $inputId }}').attr('type', 'password')
                            $(this).children().removeClass('flaticon-eye-1')
                            $(this).children().addClass('flaticon-eye')
                        }
                    })
                })
            </script>
        @endpush
    @endif
    @if($errors->has($inputId))
        <div class="invalid-feedback">{{ $errors->first($inputId) }}</div>
    @endif
    <span class="help-block">{{ $inputHint }}</span>
    @if($type == 'password')
        </div>
    @endif
</div>