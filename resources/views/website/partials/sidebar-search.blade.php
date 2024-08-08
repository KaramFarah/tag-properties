<div class="widget advance_search_widget">
    <h5 class="mb-30">{{ __('Search Property') }}</h5>
    <form class="rounded quick-search form-icon-right" action="{{route('properties')}}" method="GET">
        <div class="row g-3">
            <div class="col-12">
                <input type="text" class="form-control" name="skeyword" placeholder="{{ __('Enter Keyword') }}..." value="{{request()->get('skeyword')}}">
            </div>
            <div class="col-12">
                <select class="form-select py-2" name="sproperty_type" >
                    <option value="">{{__('- Property Type')}}</option>
                    @foreach ($propertyTypes as $key => $type)
                        <option @selected(request()->get('sproperty_type') == $key) value="{{$key}}">{{$type}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <select class="form-select py-2" name="sproperty_purpose" >
                    <option value="">{{__('- Property Purpose')}}</option>
                    @foreach ($propertyPurposes as $key => $purpose)
                        <option @selected(request()->get('sproperty_purpose') == $key) value="{{$key}}">{{$purpose}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <select class="form-select py-2" name="sproperty_status">
                    <option value="">{{__('- Property Status')}}</option>
                    @foreach ($propertyStatuses as $key => $status)
                        <option @selected(request()->get('sproperty_status') == $key) value="{{$key}}">{{$status}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <div class="position-relative">
                    <input type="text" value="{{request()->get('saddress')}}" class="form-control" name="saddress" placeholder="Address">
                    <i class="flaticon-placeholder flat-mini icon-font y-center text-dark"></i>
                </div>
            </div>
            <div class="col-12">
                <div class="position-relative">
                    <button class="form-control price-toggle toggle-btn" data-target="#data-range-price">{{ __('Price') }} <i class="fas fa-angle-down font-mini icon-font y-center text-dark"></i></button>
                    <div id="data-range-price" class="price_range price-range-toggle w-100">
                        <div class="area-filter price-filter">
                            <span class="price-slider">
                                <input class="filter_price" type="text" name="sprice"
                                value="{{$price_string ?? '0;10000000'}}" />
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <input type="text" class="form-control" name="sbedrooms" placeholder="Max Bedrooms" value="{{$search['sbedrooms'] ?? ''}}">
            </div>
            <div class="col-12">
                <input type="text" class="form-control" name="sbathrooms" placeholder="Max Bathrooms" value="{{$search['sbathrooms'] ?? ''}}">                                  
            </div>
            {{-- <div class="col-12">
                <select class="form-control" name="sgarage">
                    <option value="">Garage</option>
                    <option  @selected(request()->get('sgarage') == 1) value="1">Yes</option>
                    <option @selected(request()->get('sgarage') == 0) value="0">No</option>
                </select>
            </div> --}}
            <div class="col-6">
                <input type="text" class="form-control" name="smin_area" value="{{request()->get('smin_area')}}" placeholder="{{__('Min Area')}}">
            </div>
            <div class="col-6">
                <input type="text" class="form-control" name="smax_area" value="{{request()->get('smax_area')}}" placeholder="{{__('Max Area')}}">
            </div>
            <div class="col-12">
                <div class="position-relative">
                    <button class="form-control text-start toggle-btn" data-target="#aditional-features">{{__('Advanced')}} <i class="fas fa-ellipsis-v font-mini icon-font y-center text-dark"></i></button>
                </div>
            </div>
            <div class="col-12 position-relative">
                <div id="aditional-features" class="aditional-features visible-static p-5">
                    <h5 class="mb-3">{{__('Amenities')}}</h5>
                    <ul class="row row-cols-1 custom-check-box mb-4">
                        @foreach ($features as $key => $_feature)
                            @if($_feature->value_type == \App\Models\Dashboard\Tag::VALUE_TYPE_BOOLEAN)    
                                <li class="col">
                                    <input @checked(request()->has('sFeatures') && in_array($_feature->id, request()->get('sFeatures'))) name="sFeatures[]" type="checkbox" class="custom-control-input hide" id="customCheck{{$loop->index}}" value="{{$_feature->id}}">
                                    <label class="custom-control-label" for="customCheck{{$loop->index}}">{{$_feature->name}}</label>
                                </li>
                            @endif
                        @endforeach
                        {{-- <li class="col">
                            <input type="checkbox" class="custom-control-input hide" id="customCheck2">
                            <label class="custom-control-label" for="customCheck2">Garage Facility</label>
                        </li> --}}
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <a href="{{route('properties')}}">
                    <button class="btn btn-primary w-100">{{ __('Search') }}</button>
                </a>
            </div>
        </div>
    </form>
</div>