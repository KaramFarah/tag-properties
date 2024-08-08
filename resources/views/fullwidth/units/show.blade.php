@extends('fullwidth.layouts.app')
@include('website.partials.website-map-integration' , ['project' => $unit])
@section('content')
    <div class="text-end mb-30">
        <a class="btn btn-secondary" target="_blank" href="{{ route('propertyShow', $unit->slug) }}">
            <i class="fa fa-edit"></i> {{ __('Preview') }}
        </a>
        @can('unit_edit')
            <a class="btn btn-primary" href="{{ route('dashboard.units.edit', $unit->id) }}">
                <i class="fa fa-edit"></i> {{ __('Edit') }}
            </a>
        @endcan
        @can('unit_delete')
            <form action="{{ route('dashboard.units.destroy', $unit->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
            </form>
        @endcan
        @can('audit_log_access')
            <a class="btn btn-light viewDetails" href="#" data-title="{{ __('Activities')}}" data-value="{{ route('dashboard.units.index-auditlogs', ['id' => $unit->id,'class' => get_class($unit)]) }}">
                <i class="fa fa-edit"></i> {{ __('Activities') }}
            </a>
        @endcan
    </div>
    <div class="accordion" id="accordionShowDetails">
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button bg-light text-secondary d-block text-truncate px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#details" aria-expanded="true" aria-controls="details">
                <h5>{{ __('Details') }}</h5>
            </button>
            </h2>
            <div id="details" class="accordion-collapse collapse show" data-bs-parent="#accordionShowDetails">
                <div class="accordion-body">
                    <div class="row bg-white mb-30">
                        <div class="col table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <b>{{ __('Address') }}</b>
                                        </td>
                                        <td>
                                            {{ $unit->address ?? '' }}
                                        </td>
                                        
                                        <td>
                                            <b>{{ __('Project') }}</b>
                                        </td>
                                        <td colspan="5">
                                            {{ $unit->project->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>{{ __('Id') }}</b>
                                        </td>
                                        <td colspan="5">
                                            {{ $unit->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>{{ __('Description') }}</b>
                                        </td>
                                        <td colspan="5">
                                            {!! $unit->description !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>{{ __('Property Type') }}</b>
                                        </td>
                                        <td>
                                            {{ $unit->property_type_text }}
                                        </td>
                                        <td>
                                            <b>{{ __('Property Status') }}</b>
                                        </td>
                                        <td>
                                            {{ $unit->property_status_text }}
                                        </td>
                                        <td>
                                            <b>{{ __('Property Purpose') }}</b>
                                        </td>
                                        <td>
                                            {{ $unit->property_purpose_text }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>{{ __('All Inclusive Price ') . '( '. config('panel.currency') . ') '}}</b>
                                        </td>
                                        <td>
                                            {{ $unit->price }}
                                        </td>
                                        <td>
                                            <b>{{ __('Area Sqft') }}</b>
                                        </td>
                                        <td col="3">
                                            {{ $unit->area_sqft }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>{{ __('Bed Rooms') }}</b>
                                        </td>
                                        <td>
                                            {{ $unit->bedrooms }}
                                        </td>
                                        <td>
                                            <b>{{ __('Bathrooms') }}</b>
                                        </td>
                                        <td>
                                            {{ $unit->bathrooms }}
                                        </td>
                                        <td>
                                            <b>{{ __('Parking') }}</b>
                                        </td>
                                        <td>
                                            {{ $unit->garage ? 'Yes' : 'No' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>{{ __('Property Id') }}</b>
                                        </td>
                                        <td>
                                            {{ $unit->property_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                      
                                        <td>
                                            <b>{{ __('Property Ownership') }}</b>
                                        </td>
                                        <td colspan="3">
                                            {{ $unit->propertyOwnershipText }}
                                        </td>
                                    </tr>
                                
                                    <tr>   
                                   
                                    @if ($unit->location ?? false)
                                        <input type="hidden" name="location" id="location" value="{{ $unit->location ?? '35.52052844635452;35.80705384863964' }}">
                                        <div class="property-overview border rounded bg-white p-30 mb-30">
                                            <div class="row row-cols-1">
                                                <div class="col">
                                                    <h5 class="mb-3">{{__('Location')}}</h5>
                                                    <div id="map" style="height: 400px; width: 100%" class="mb-30"></div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                   
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>{{ __('Availablitiy') }}</b>
                                        </td>
                                        <td>
                                            {{ $unit->availability ? __('Yes') : __('No') }}
                                        </td>
                                        <td>
                                            <b>{{ __('Published') }}</b>
                                        </td>
                                        <td>
                                            {{ $unit->published ? __('Yes') : __('No') }}
                                        </td>
                                        <td>
                                            <b>{{ __('Featured') }}</b>
                                        </td>
                                        <td>
                                            {{ $unit->featuered ? __('Yes') : __('No') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>{{__('Agents')}}</b></td>
                                        <td colspan="5">
                                            @foreach ($unit->assignee as $_agent)
                                                <span class="badge bg-info fs-6">{{$_agent->name}}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><b>{{ __('Amenities') }}</b>:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            @forelse($unit->tags as $_tag)
                                                <span class="badge bg-primary text-white fs-6 m-1">{{$_tag->parent ? $_tag->parent->name . ': ' : '' }}{{$_tag->name}}{{$_tag->value_type == \App\Models\Dashboard\Tag::VALUE_TYPE_TEXT ? ': ' . ($_tag->units()->wherePivot('unit_id', $unit->id)->first()->pivot->tag_value ?? '') : ($_tag->value_type == \App\Models\Dashboard\Tag::VALUE_TYPE_DROPDOWN ? ($_tag->units()->wherePivot('unit_id', $unit->id)->first() && $_tag->units()->wherePivot('unit_id', $unit->id)->first()->pivot->tag_value ? ': ' . $_tag->optionsAsArray[$_tag->units()->wherePivot('unit_id', $unit->id)->first()->pivot->tag_value ?? ''] : '') : '')}}</span>
                                            @empty
                                                {{ __('No tags') }}
                                            @endforelse
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><b>{{ __('Photos') }}</b>:</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            @forelse($unit->getMedia('unit-photos') as $_media)
                                                <img src="{{ $_media->getUrl()}}" alt="{{ $_media->name }} image" class="img-thumbnail">
                                            @empty
                                                {{ __('No photos') }}
                                            @endforelse
                                        </td>
                                    </tr>
                                    @if($unit->attachments->count())
                                        <tr>
                                            <td colspan="6"><b>{{ __('Attachments') }}</b>:</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">
                                                @forelse($unit->attachments as $_media)
                                                    <a href="{{ $_media->getUrl()}}" target="_blank" class="primary-link"><i class="fa fa-file"></i> {{ $_media->name }}</a>
                                                @empty
                                                    {{ __('No Attachment') }}
                                                @endforelse
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="6"><b>{{__('Floor Plans')}}</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            @forelse($unit->floorPlanPhotos as $_media)
                                                <img src="{{ $_media->getUrl('thumb')}}" alt="{{ $_media->name }} image" class="mb-10 img-thumbnail">
                                                <br>
                                            @empty
                                                {{ __('No photos') }}
                                            @endforelse
                                            @if ($unit->floors->count())
                                                <div class="accordion" id="formContainer">
                                                    @foreach ($unit->floors as $floor)
                                                        <div class="accordion-item" style="border: none" id="{{$loop->index}}floor">
                                                            @include('fullwidth.units.floorPlans', ['loop_index' => $loop->index , 'readonly' => true])
                                                        </div>
                                                    @endforeach
                                                </div>    
                                            @else
                                                <i>No items</i>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><b>{{__('NearBy Places')}}</b></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            @if ($unit->places->count())
                                                <div class="tab-simple tab-action">
                                                    <div class="tab-element">
                                                        <div class="tab-pane tab-hide" >
                                                            <div class="form-boder">
                                                                <div id="placeContainer" class="mb-30">
                                                                    @foreach ($unit->places as $nearbyPlace)
                                                                        @include('fullwidth.units.nearByPlaces', ['loop_index' => $loop->index ?? 0 , 'readonly' => true ])
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <i>No items</i>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @include('fullwidth.partials.dates-show', ['model' => $unit])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection