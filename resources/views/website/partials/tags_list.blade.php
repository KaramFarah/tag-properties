<h6 class="mb-30">{{ __($tagName) }}</h6>
<ul class="row row-cols-lg-3 row-cols-1 custom-check-box mb-30">
    @foreach($features as $feature)
        @if($feature->parent)
            @if($feature->parent->name === $tagName)
                @if ($feature->value_type == \App\Models\Dashboard\Tag::VALUE_TYPE_TEXT)
                    <x-inputs.text inputName="tagTextInput[{{$feature->id}}]" inputId="tagTextInput_{{$feature->id}}" inputLabel="{{$feature->name}}" inputValue="{{ old('tagTextInput_' . $feature->name , $unit->tags()->wherePivot('tag_id' , $feature->id)->first()->pivot->tag_value ?? '') }}" />
                @elseif ($feature->value_type == \App\Models\Dashboard\Tag::VALUE_TYPE_DROPDOWN)
                    {{-- @php($flag = $unit->tags()->wherePivot('tag_id' , $feature->id)->first()) --}}
                    <div>
                        <label style="margin-bottom: 8px" class="" for="tagTextInput_{{$feature->id}}">{{$feature->name}}</label>
                        <select name="tagDropdownInput[{{$feature->id}}]" id="tagTextInput_{{$feature->id}}" class="form-select">
                            <option value="">{{__('-- Choose')}}</option>
                            @foreach ($feature->optionsAsArray as $key => $option)     
                                <option value="{{$key}}" @selected(($unit->tags()->wherePivot('tag_id' , $feature->id)->first()->pivot->tag_value ?? '') == $key)> {{$option}}</option>                        
                            @endforeach
                        </select>
                    </div>
                @else
                    <li class="col">
                        <input type="checkbox" class="custom-control-input hide" id="customCheck-{{$feature->id}}" name="propertyFeatures[]" value="{{$feature->id}}" {{ $unit->tags->contains($feature->id) ? 'checked' : ''}}>
                        <label class="custom-control-label" for="customCheck-{{$feature->id}}">{{ $feature->name}}</label>
                    </li>
                @endif   
            @endif
        @endif
    @endforeach
</ul>