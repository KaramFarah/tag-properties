<div class="Container row mb-3">
    <div class="{{ isset($readonly) ? 'col' : 'col-11'}}">
        <h2 class="accordion-header" id="heading{{$loop_index}}">
            <button style="box-shadow:none" class="accordion-button bg-light text-secondary  text-truncate px-3 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#panel-{{$loop_index}}" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                Range {{$range->unit_type ? '['.$range->rangeTypeText.']' : ''}}
            </button>
        </h2>
        <div id="panel-{{$loop_index}}" class="accordion-collapse collapse" aria-labelledby="heading{{$loop_index}}">
            <div class="accordion-body">
                <div class="form-boder">
                    <div class="row g-1">
                        <input type="hidden" name="inputs[{{$loop_index}}][id]" value="{{$range->id}}">                 
                            @isset($readonly)
                            
                            @else
                                <div class="col">
                                    <x-inputs.select inputName="inputs[{{$loop_index}}][unit_type]" inputId="unit_type{{$loop_index}}" inputLabel="{{ __('Unit Type') }}" inputValue="{{ $range->unit_type }}" :inputData="$range->getRangeTypes()" showButtons="false"/>
                                </div>
                            @endisset
                        <div class="col">   
                            <label class="form-label">{{__('Size from')}}</label>
                            <input {{isset($readonly) ? 'readonly' : ''}} type="number" name="inputs[{{$loop_index}}][min_size]" class="form-control" value="{{ old('inputs[$loop_index][min_size]', $range->min_size ?? '') }}" >
                        </div>
                        <div class="col">
                            <label class="form-label">{{ __('to') }}</label>
                            <input {{isset($readonly) ? 'readonly' : ''}} type="number" name="inputs[{{$loop_index}}][max_size]" class="form-control" value="{{ old('inputs[$loop_index][max_size]', $range->max_size ?? '') }}" >
                        </div>
                        <div class="col">
                            <label class="form-label">{{ __('Price from') }}</label>
                            <input {{isset($readonly) ? 'readonly' : ''}} type="number" name="inputs[{{$loop_index}}][min_price]" class="form-control " value="{{ old('inputs[$loop_index][min_price]', $range->min_price ?? '') }}" >
                        </div>
                        <div class="col">
                            <label class="form-label">{{ __('to') }}</label>
                            <input {{isset($readonly) ? 'readonly' : ''}} type="number" name="inputs[{{$loop_index}}][max_price]" class="form-control" value="{{ old('inputs[$loop_index][max_price]', $range->max_price ?? '') }}" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (!isset($readonly))
        <div class="col-1 d-flex align-items-center">
            <div>
                <button {{(!is_Null($range->id)) ? ('parent-id=' . $loop_index . 'range data-value=' . route('api.ranges.destroy' , $range)) : ''}}  type="button" class="btn btn-outline-danger {{(!is_Null($range->id)) ? 'delete-range' : 'remove-range'}}"><i class="fas fa-trash"></i></button>
            </div>
        </div>         
    @endif
</div>