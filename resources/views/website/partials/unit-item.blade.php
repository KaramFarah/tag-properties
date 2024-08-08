<div class="property-grid-1 property-block bg-white transation-this hover-shadow">
    <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom">
        <div class="cata position-absolute"><span class="sale bg-secondary text-white">{{$unit->propertyStatusText}}</span></div>
        <a href="{{ route('propertyShow' , ['unit' => $unit->slug ?? 'test']) }}"><img src="{{ ($unit->getMedia('unit-photos')->count()) ? $unit->websiteImage : 'assets/images/new/property-grid-1.jpg'}}" alt="Image Not Found!"></a>
        <a href="#" class="listing-ctg text-white"><i class="fa-solid fa-building"></i><span>{{$unit->property_type}}</span></a>
        <ul class="position-absolute quick-meta">
            @if (auth()->user())
                <li><a href="#" link="{{route('api.new-favorite' , ['unit' => $unit])}}" title="Add Favourite"><i class="{{$unit->isFavourite ? 'fa fa-heart' : 'flaticon-like-1'}} flat-mini" onclick="toggleIconClass(this)"></i></a></li>
            @endif   
            {{-- asd  href="#"--}}                         
            {{-- <li class="md-mx-none"><a class="quick-view vModal" href="#quick-view{{$unit->id}}"  title="Quick View"><i class="flaticon-zoom-increasing-symbol flat-mini"></i></a></li> --}}
        </ul>
    </div>
    <div class="property_text p-4">
        <span class="listing-price">{{ config('panel.currency') }} {{$unit->price}}<small> ( {{ $unit->propertyPurposeText }})</small></span>
        <h5 class="listing-title"><a href="{{ route('propertyShow' , ['unit' => $unit->slug ?? 'test']) }}">{{$unit->name}}{!! !$unit->published ? ' - <small class="text-warning">Unpublished</small>' : ''!!}</a></h5>
        <span class="listing-location"><i class="fas fa-map-marker-alt"></i> {{$unit->project->address ?? 'No loaction Info'}} </span>
        <ul class="d-flex quantity font-fifteen">
            <li title="Beds"><span><i class="fa-solid fa-bed"></i></span>{{$unit->bedrooms}}</li>
            <li title="Baths"><span><i class="fa-solid fa-shower"></i></span>{{$unit->bathrooms}}</li>
            <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>{{$unit->area_sqft}}</li>
            <li title="Gas"><span><i class="fa-solid fa-fire"></i></span>{{$unit->gas ? 'Yes' : 'No'}}</li>
        </ul>
    </div>
    <div class="d-flex align-items-center post-meta mt-2 py-3 px-4 border-top">
        <div class="agent">
            <a href="#" class="d-flex text-general align-items-center"><img class="rounded-circle me-2" src="{{
            ($unit->project) ? $unit->project->developers->first()->logoThumb ?? '' : ''
            }}" alt="avata"><span>{{$unit->developerName}}</span></a>
        </div>
        <div class="post-date ms-auto"><span>{{$unit->postDate}}</span></div>
    </div>
</div>

{{-- <div class="overlay-dark modal fade quick-view-modal" id="quick-view{{$unit->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="close view-close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body property-block summary p-3">
                <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom m-2">
                    <a href="#"><img  src="{{$unit->quickView ?? 'assets/images/property/2.png'}}" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div> --}}