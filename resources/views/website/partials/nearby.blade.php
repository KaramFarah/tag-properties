
    <div class="property-overview border rounded bg-white p-30 mb-30">
        <div class="row row-cols-1">
            <div class="col">
                <h5 class="mb-3">{{ __('Nearby Places') }}</h5>
                <div class="tab-simple tab-action">
                    <ul class="nav-tab-line list-color-secondary d-table mb-3">
                        @if ($unit->hasHospital)
                            <li class="{{($unit->hasHospital) ? 'active' : ''}}" data-target="#tb-panel-1">Hospital</li>
                        @endif
                        @if ($unit->hasShopping)
                            <li class="{{(!$unit->hasHospital && $unit->hasShoppin) ? 'active' : ''}}" data-target="#tb-panel-2">Shopping</li>
                        @endif
                        @if ($unit->hasSchool)
                            <li class="{{(!$unit->hasHospital && !$unit->hasShopping && $unit->hasSchool) ? 'active' : ''}}" data-target="#tb-panel-3">School</li>
                        @endif
                        @if ($unit->hasResturant)
                            <li class="{{(!$unit->hasHospital && !$unit->hasShopping && !$unit->hasSchool && $unit->hasResturant) ? 'active' : ''}}" data-target="#tb-panel-4">Resturant</li>
                        @endif
                    </ul>
                    {{--  --}}
                    <div class="tab-element">
                        <!-- Hosiptal data -->
                        @if ($unit->hasHospital)
                            <div class="tab-pane tab-hide" id="tb-panel-1" style="display: block;">
                                <div class="table-striped overflow-x-scroll pb-2">
                                    <table class="w-100">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="font-fifteen">Name</th>
                                                <th scope="col" class="font-fifteen">Distance (km)</th>
                                                <th scope="col" class="font-fifteen">Minutes</th>
                                                <th scope="col" class="font-fifteen">Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($unit->places as $hospital)
                                                @if ($hospital->main_type == 'hospital')
                                                    <tr>
                                                        <td class="text-break">{{$hospital->name}}</td>
                                                        <td class="text-break">{{$hospital->distance}}</td>
                                                        <td class="text-break">{{$hospital->minutes}}</td>
                                                        <td class="text-break">{{$hospital->sub_type}}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                        <!-- Shpping Data -->
                        @if ($unit->hasShopping)
                            <div class="tab-pane tab-hide" id="tb-panel-2" style="display: block;">
                                <div class="table-striped overflow-x-scroll pb-2">
                                    <table class="w-100">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="font-fifteen">Name</th>
                                                <th scope="col" class="font-fifteen">Distance</th>
                                                <th scope="col" class="font-fifteen">Minutes</th>
                                                <th scope="col" class="font-fifteen">Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($unit->places as $shopping)
                                                @if ($shopping->main_type == 'shopping')
                                                    <tr>
                                                        <td class="text-break">{{$shopping->name}}</td>
                                                        <td class="text-break">{{$shopping->distance}}</td>
                                                        <td class="text-break">{{$shopping->minutes}}</td>
                                                        <td class="text-break">{{$shopping->sub_type}}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                        <!-- Shpping Data -->
                        @if ($unit->hasSchool)
                            <div class="tab-pane tab-hide" id="tb-panel-3" style="display: block;">
                                <div class="table-striped overflow-x-scroll pb-2">
                                    <table class="w-100">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="font-fifteen">Name</th>
                                                <th scope="col" class="font-fifteen">Distance</th>
                                                <th scope="col" class="font-fifteen">Minutes</th>
                                                <th scope="col" class="font-fifteen">Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($unit->places as $school)
                                                @if ($school->main_type == 'school')
                                                    <tr>
                                                        <td class="text-break">{{$school->name}}</td>
                                                        <td class="text-break">{{$school->distance}}</td>
                                                        <td class="text-break">{{$school->minutes}}</td>
                                                        <td class="text-break">{{$school->sub_type}}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                        <!-- Shopping Data -->
                        @if ($unit->hasResturant)
                            <div class="tab-pane tab-hide" id="tb-panel-4" style="display: block;">
                                <div class="table-striped overflow-x-scroll pb-2">
                                    <table class="w-100">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="font-fifteen">Name</th>
                                                <th scope="col" class="font-fifteen">Distance</th>
                                                <th scope="col" class="font-fifteen">Minutes</th>
                                                <th scope="col" class="font-fifteen">Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($unit->places as $resturant)
                                                @if ($resturant->main_type == 'resturant')
                                                    <tr>
                                                        <td class="text-break">{{$resturant->name}}</td>
                                                        <td class="text-break">{{$resturant->distance}}</td>
                                                        <td class="text-break">{{$resturant->minutes}}</td>
                                                        <td class="text-break">{{$resturant->sub_type}}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>