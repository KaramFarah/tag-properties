<div class="property-overview border rounded bg-white p-30 mb-30">
    <div class="row row-cols-1">
        <div class="col">
            <h5 class="mb-3">{{ __('Floor Plans') }}</h5>
            
            <div class="row">
                @foreach($unit->floorPlanPhotos as $_media)
                <div class="col-12">
                    <img src="{{ $_media->getUrl()}}" alt="{{ $_media->name }} floor plan image" class="mb-10 img-thumbnail">
                </div>
                @endforeach
            </div>

            @foreach ($unit->floors as $floor)
                <div class="simple-collaps mb-2">
                    <span class="accordion bg-light text-secondary d-block px-4 py-2">{{ucfirst($floor->title)}} [ {{$floor->space}} sqft ]</span>
                    <div class="panel">
                        <div class="px-4 py-3">
                            <ul class="d-inline-block">
                                <li class="float-start me-3"><span class="text-secondary">{{ __('Bed') }}: </span>{{$floor->master_bed ? $floor->master_bed . ' Sqft': ''}}</li>
                                <li class="float-start me-3"><span class="text-secondary">{{ __('Kitchen') }}: </span>{{$floor->kitchen ? $floor->kitchen . ' Sqft'  : ''}}</li>
                                <li class="float-start me-3"><span class="text-secondary">{{ __('Dining') }}: </span>{{$floor->diding ? $floor->diding . ' Sqft' : ''}}</li>
                                <li class="float-start me-3"><span class="text-secondary">{{ __('Bath') }}: </span>{{$floor->baths ? $floor->baths . ' Sqft'  : ''}} </li>
                                <li class="float-start me-3"><span class="text-secondary">{{ __('Storage') }}: </span>{{$floor->storage ? $floor->storage . ' Sqft'  : ''}}</li>
                            </ul>
                            <img src="{{$floor->websitePreview ?? __('No Image')}}" alt="{{ $unit->name }} {{ $floor->title }} image">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>