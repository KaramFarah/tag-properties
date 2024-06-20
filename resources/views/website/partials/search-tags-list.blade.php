<h5 class="mb-3">{{$tagName}}</h5>
    <ul class="row row-cols-lg-4 row-cols-md-2 row-cols-1 custom-check-box mb-4">
        @foreach ($features as $feature)
            @if ($feature->parent)
                @if ($feature->parent->name === $tagName)
                    @if ($feature->value_type == \App\Models\Dashboard\Tag::VALUE_TYPE_BOOLEAN)
                        <li class="col">
                            @if (isset($sFeatures))
                                <input {{  in_array(((string)$feature->id), $sFeatures , true) ? 'checked' : '' }} name="sFeatures[]" type="checkbox" class="custom-control-input hide" id="customCheck{{$loop->index}}" value="{{$feature->id}}">
                                <label class="custom-control-label" for="customCheck{{$loop->index}}">{{$feature->name}}</label>
                            @else
                                <input name="sFeatures[]" type="checkbox" class="custom-control-input hide" id="customCheck{{$loop->index}}" value="{{$feature->id}}">
                                <label class="custom-control-label" for="customCheck{{$loop->index}}">{{$feature->name}}</label>
                            @endif
                        </li>
                    @endif
                @endif
            @endif
        @endforeach
    </ul>

    