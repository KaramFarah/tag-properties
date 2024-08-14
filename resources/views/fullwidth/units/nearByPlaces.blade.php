<div class="row g-3 mb-3 Container" id="{{$loop_index}}nearbyPlace">
    <input type="hidden" name="places[{{$loop_index}}][id]" value="{{$nearbyPlace->id ?? null}}">
    <div class="col-xl-2 col-lg-6 col-md-6">
        <select {{isset($readonly) ? 'disabled' : ''}} name="places[{{$loop_index}}][main_type]" id="main_type{{$loop_index}}" class="form-select pb-3">
            <option {{ ($nearbyPlace['main_type'] == 'hospital') ? 'selected' : ''}} value="hospital">Hospital</option>
            <option {{ ($nearbyPlace['main_type'] == 'school') ? 'selected' : ''}} value="school">School</option>
            <option {{ ($nearbyPlace['main_type'] == 'shopping') ? 'selected' : ''}} value="shopping">Shopping</option>
            <option {{ ($nearbyPlace['main_type'] == 'resturant') ? 'selected' : ''}} value="resturant">Resturant</option>
            <option {{ ($nearbyPlace['main_type'] == 'airport') ? 'selected' : ''}} value="airPort">Airport</option>
        </select>
        
            {{-- <select {{isset($readonly) ? 'disabled' : ''}} name="places[{{$loop_index}}][main_type]" id="main_type{{$loop_index}}" class="form-select pb-3">
                @foreach ($places as $key => $place)
                    <option {{ ($nearbyPlace['main_type'] == $key) ? 'selected' : ''}} value="{{$key}}">{{$place}}</option>                    
                @endforeach
            </select> --}}
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6">
        <input {{isset($readonly) ? 'readonly' : ''}} type="text" name="places[{{$loop_index}}][name]" value="{{ old('places[$loop_index][name]', $nearbyPlace->name ?? '') }}" class="form-control" placeholder="Name of the places">
    </div>
    <div class="col-xl-2 col-lg-6 col-md-6">
        <input {{isset($readonly) ? 'readonly' : ''}} type="number" name="places[{{$loop_index}}][distance]" value="{{ old('places[$loop_index][distance]', $nearbyPlace->distance ?? '') }}" class="form-control" placeholder="Distance (km)">
    </div>
    <div class="col-xl-2 col-lg-6 col-md-6">
        <input {{isset($readonly) ? 'readonly' : ''}} type="number" name="places[{{$loop_index}}][minutes]" value="{{ old('places[$loop_index][minutes]', $nearbyPlace->minutes ?? '') }}" class="form-control" placeholder="Minutes">
    </div>
    <div class="col-xl-2 col-lg-6 col-md-6">
        <input {{isset($readonly) ? 'readonly' : ''}} type="text" name="places[{{$loop_index}}][sub_type]" value="{{ old('places[$loop_index][sub_type]', $nearbyPlace->sub_type ?? '') }}" class="form-control" placeholder="Type">
    </div>
    @if (!isset($readonly))
        <div class="col-xl-2 col-lg-6 col-md-6">
            <button {{(!is_Null($nearbyPlace->id)) ? ('parent-id=' . $loop_index . 'nearbyPlace data-value=' . route('api.nearbyPlaces.destroy' , $nearbyPlace)) : ''}} class="btn btn-outline-danger {{(!is_Null($nearbyPlace->id)) ? 'delete-place' : 'remove-place'}} " type="button"><i class="fas fa-trash"></i></button>
        </div>
    @endif
</div>