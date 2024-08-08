<div class="property-list-2 p-2 bg-white property-block border transation-this hover-shadow">
    <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom">
        <div class="cata position-absolute"><span class="sale bg-secondary text-white">{{$unit->propertyStatusText}}</span></div>
        <div class="owl-carousel single-carusel dot-disable nav-between-in">
            <div class="item">
                <a href="{{ route('propertyShow', ['unit' => $unit]) }}"><img src="{{ ($unit->getMedia('unit-photos')->count()) ? $unit->websiteImage : 'assets/images/new/property-grid-1.jpg'}}" alt="{{$unit->name}} image {{$loop->iteration}}"></a>
            </div>
            {{-- <div class="item">
                <a href="{{ route('propertyShow', ['unit' => $unit]) }}"><img src="assets/images/property_grid/property-grid-2.png" alt="Image Not Found!"></a>
            </div> --}}
        </div>
        <a href="{{ route('propertyShow', ['unit' => $unit]) }}" class="listing-ctg text-white"><i class="{{ $unit->property_type_icon }}"></i><span>{{$unit->propertyTypeText}}</span></a>
        <ul class="position-absolute quick-meta">
            <li onclick="toggleIconClass(this.querySelector('i:first-child'))"><a href="#"
                link="{{route('api.new-favorite' , ['unit' => $unit])}}"
                title="Add Favourite"><i class="{{$unit->isFavourite ? 'fa fa-heart' : 'flaticon-like-1'}} flat-mini"></i></a></li>
        </ul>
    </div>
    <div class="property_text px-3">
        <a href="{{ route('propertyShow', ['unit' => $unit]) }}">
            <span class="listing-price">{{config('panel.currency')}} {{$unit->price}}<small> ( {{$unit->propertyPurposeText}} )</small></span>
        </a>
        <h5 class="listing-title"><a href="{{ route('propertyShow', ['unit' => $unit]) }}">{{$unit->name}}</a></h5>
        <span class="listing-location"><i class="fas fa-map-marker-alt"></i> {{$unit->address ?? ($unit->project->fullLocation ?? 'No Location')}}</span>
        <ul class="d-flex quantity font-fifteen">
            <li title="Beds"><span><i class="fa-solid fa-bed"></i></span>{{$unit->bedrooms}}</li>
            <li title="Baths"><span><i class="fa-solid fa-shower"></i></span>{{$unit->bathrooms}}</li>
            @if ($unit->area_sqft)
                <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>{{$unit->area_sqft}}</li>
            @endif
            @if ($unit->gas)
                <li title="Gas"><span><i class="fa-solid fa-fire"></i></span>{{$unit->gas ? 'Yes' : 'No'}}</li>
            @endif
        </ul>
        <p>{!! Str::words($unit->description, 15) !!} <a href="{{ route('propertyShow', ['unit' => $unit]) }}" class="btn-link">{{ __('More Info') }}...</a></p>
        <div class="d-flex align-items-center post-meta mt-2">
            @if($unit->project)
                @foreach ($unit->project->developers as $developer)
                    <div class="agent">
                        <a href="{{route('developers.show' , ['developer' => $developer])}}" class="d-flex text-general align-items-center"><img class="rounded-circle me-2" src="{{$developer->logoThumb}}" alt="{{$unit->developerName}}"><span>{{$unit->developerName}}</span></a>
                    </div>
                @endforeach
            @endif
            <div class="post-date ms-auto"><span>{{$unit->postDate}}</span></div>
        </div>
    </div>
</div>