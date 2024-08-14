@isset($recentProperties)
    <div class="widget widget_recent_property">
        <h5 class="text-secondary mb-4">{{__('Recent Property')}}</h5>
        <ul>
            @forelse ($recentProperties as $recent)
                <li>
                    {{-- {{dd($recent->ThumbImage)}} --}}
                    <a href="{{route('propertyShow' , ['unit' => $recent->slug])}}">
                        <img style="width: 80px; height: 80px;" src="{{$recent->recent ?? asset('assets/images/new/property-grid-1.jpg')}}" alt="{{$recent->name}} thumbnail image">
                    </a>
                    <div class="thumb-body">
                        <h6 class="listing-title"><a href="{{route('propertyShow' , ['unit' => $recent->slug])}}">{{$recent->name}}</a></h6>
                        <span class="listing-price">{{config('panel.currency')}} {{$recent->price}}<small> ({{$recent->propertyPurposeText}})</small></span>
                        <ul class="d-flex quantity font-fifteen">
                            <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>{{$recent->area_sqft}} Sqft</li>
                        </ul>
                    </div>
                </li>
            @empty
                <li>{{__('No Results')}}</li>
            @endforelse
        </ul>
    </div>
@endisset