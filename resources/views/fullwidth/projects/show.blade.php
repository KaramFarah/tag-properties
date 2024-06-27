@extends('fullwidth.layouts.app')
@include('website.partials.website-map-integration')
@section('content')
    <div class="text-end mb-30">
        <a class="btn btn-secondary" target="_blank" href="{{ route('projects.show', $project->slug) }}">
            <i class="fa fa-edit"></i> {{ __('Preview') }}
        </a>
        @can('project_edit')
            <a class="btn btn-primary" href="{{ route('dashboard.projects.edit', $project->id) }}">
                <i class="fa fa-edit"></i> {{ __('Edit') }}
            </a>
        @endcan
        @can('project_delete')
            <form action="{{ route('dashboard.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
            </form>
        @endcan
        @can('audit_log_access')
            <a class="btn btn-light viewDetails" href="#" data-title="{{ __('Activities')}}" data-value="{{ route('dashboard.projects.index-auditlogs', ['id' => $project->id,'class' => get_class($project)]) }}">
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
                            <div class="col table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="w-25">
                                                <b>{{ __('Id') }}</b>
                                            </td>
                                            <td>
                                                {{ $project->id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>{{ __('Description') }}</b>
                                            </td>
                                            <td>
                                                {{ $project->description }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Developer') }}</h5>
                                            </th>
                                            <td>
                                                @forelse($project->developers as $_item)
                                                    <span class="badge bg-info fs-6 m-1">{{ $_item->name ?? '' }}</span>
                                                @empty
                                                    {{ __('No developers') }}
                                                @endforelse
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Status') }}</h5>
                                            </th>
                                            <td>
                                                {{ $project->statusText }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Opening Date') }}</h5>
                                            </th>
                                            <td>
                                                {{ $project->opening_date }}
                                            </td>
                                        {{-- </tr>
                                        <tr>
                                            <th>
                                                {{ __('Cities') }}</h5>
                                            </th>
                                            <td>
                                                @foreach($project->cities as $_city)
                                                    <span class="badge bg-info fs-6 m-1">{{$_city->name}}</span>
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Emirate') }}</h5>
                                            </th>
                                            <td>
                                                {{ $project->province }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Country') }}</h5>
                                            </th>
                                            <td>
                                                {{ $countries[$project->country] ?? '' }}
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <th>
                                                {{ __('Address') }}</h5>
                                            </th>
                                            <td>
                                                {{ $project->fullLocation }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Location') }}</h5>
                                            </th>
                                            <td>
                                                {{ $project->location }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Project Type') }}</h5>
                                            </th>
                                            <td>
                                                {{Str::ucfirst($project->project_type)}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Project Features') }}</h5>
                                            </th>
                                            <td>
                                                {!! $project->project_features !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Cover') }}</h5>
                                            </th>
                                            <td>
                                                @forelse($project->attachments as $_file)
                                                    <p>
                                                        <img src="{{ $_file->getUrl()}}" alt="{{ $_file->name }} image" class="img-thumbnail">
                                                        {{-- <a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a> --}}
                                                    </p>
                                                @empty
                                                    <span>No Cover</span>
                                                @endforelse
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Project Photos') }}</h5>
                                            </th>
                                            <td>
                                                @forelse($project->projectPhotos as $_file)
                                                    <p>
                                                        <img src="{{ $_file->getUrl()}}" alt="{{ $_file->name }} image" class="img-thumbnail">
                                                        {{-- <a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a> --}}
                                                    </p>
                                                @empty
                                                    <span>No Photos</span>
                                                @endforelse
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Availability List') }}</h5>
                                            </th>
                                            <td>
                                                @forelse($project->availabilityList as $_file)
                                                    <p>
                                                        <a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a>
                                                    </p>
                                                @empty
                                                    <span>{{ __('No Availability List File') }}</span>
                                                @endforelse
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Payment Plans') }}</h5>
                                            </th>
                                            <td>
                                                @forelse($project->paymentPlan as $_file)
                                                    <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a></p>
                                                @empty
                                                    <span>{{ __('No Payment Plan File') }}</span>
                                                @endforelse
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('Brochure') }}</h5>
                                            </th>
                                            <td>
                                                @forelse($project->brochure as $_file)
                                                    <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a></p>
                                                @empty
                                                    <span>No Brochure</span>
                                                @endforelse
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                @include('fullwidth.partials.dates-show', ['model' => $project])
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @if ($project->location ?? false)
                                    <input type="hidden" name="location" id="location" value="{{ $project->location ?? '35.52052844635452;35.80705384863964' }}">
                                    <div class="property-overview border rounded bg-white p-30 mb-30">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <h5 class="mb-3">{{__('Location')}}</h5>
                                                <div id="map" style="height: 400px; width: 100%" class="mb-30"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if ($project->ranges->count())
                                    <div class="accordion" id="formContainer">
                                        <h5>{{__('Size & Price Ranges')}}</h5>
                                        @foreach ($project->ranges as $range)
                                            <div class="accordion-item" style="border: none" id="{{$loop->index}}range">
                                                @include('fullwidth.projects.rangePlans', ['loop_index' => $loop->index , 'readonly' => true])
                                            </div>
                                        @endforeach
                                    </div>    
                                @endif
                                @if($project->places->count()) 
                                    <div class="tab-simple tab-action">
                                        <div class="tab-element">
                                            <div class="tab-pane tab-hide" >
                                                <div class="form-boder">
                                                    <div id="placeContainer" class="mb-30">
                                                        <h5>{{__('Places')}}</h5>
                                                        @foreach ($project->places as $nearbyPlace)
                                                        @include('fullwidth.units.nearByPlaces', ['loop_index' => $loop->index ?? 0 , 'readonly' => true ])
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection