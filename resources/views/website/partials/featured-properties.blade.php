@if($featueredProperties->count())
    <div class="widget property_carousel_widget">
        <h5 class="mb-30">{{$listTitle ?? 'Feature Property'}}</h5>
        <div class="single-carusel owl-carousel nav-disable">
            @foreach ($featueredProperties as $_unit)
                <div class="item">
                    <div class="property-grid-2 property-block transation mb-3">
                        <div class="overflow-hidden position-relative transation thumbnail-img rounded bg-secondary hover-img-zoom">
                                    <div class="cata position-absolute">
                                        <span class="sale bg-secondary text-white">{{$_unit->propertyTypeText}}</span>
                                    </div>
                                    <a href="{{ route('propertyShow' ,['unit' => $_unit->slug]) }}"><img src="{{ ($_unit->getMedia('unit-photos')->count()) ? $_unit->Featured : 'Featured assets/images/new/property-grid-1.jpg'}}" alt="$_unit->slug"></a>
                                    <ul class="position-absolute quick-meta">
                                        @if (auth()->user())
                                            <li onclick="toggleIconClass(this.querySelector('i:first-child'))">
                                                <a href="#" link="{{route('api.new-favorite' , ['unit' => $_unit])}}" title="Add Favourite">
                                                    <i class="{{$_unit->isFavourite ? 'fa fa-heart' : 'flaticon-like-1'}} flat-mini" ></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                        </div>
                        <div class="post-content py-3">
                                    <h5 class="listing-title"><a href="{{ route('propertyShow' ,['unit' => $_unit->slug]) }}">{{$_unit->name}}</a></h5>
                                    <span class="listing-location"><i class="fas fa-map-marker-alt pe-1"></i>{{$_unit->project->fullLocation ?? 'No loaction Info'}}</span>
                                    <ul class="d-flex quantity font-fifteen">
                                        {{-- karam --}}
                                        <li title="Beds"><span><i class="fa-solid fa-bed"></i></span>{{$_unit->bedrooms}}</li>
                                        <li title="Baths"><span><i class="fa-solid fa-shower"></i></span>{{$_unit->bathrooms}}</li>
                                        <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>{{$_unit->area_sqft}}</li>
                                        <li title="Gas"><span><i class="fa-solid fa-fire"></i></span>{{$_unit->gas ? 'Yes' : 'No'}}</li>
                                    </ul>
                                    <span class="listing-price">{{config('panel.currency')}} {{$_unit->price}}<small> ({{$_unit->propertyPurposeText}})</small></span>
                        </div>
                    </div>
                </div> 
            @endforeach
        </div>
    </div>
@endif