@can('lead_show')
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
                        <table class="w-100 items-list bg-transparent">
                            <tbody>
                                <tr class="bg-white">
                                    <th class="w-25">
                                        {{ __('Id') }}
                                    </th>
                                    <td>
                                        {{ $lead->id ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Email') }}</h5>
                                    </th>
                                    <td>
                                        {{ $lead->email ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Mobile') }}</h5>
                                    </th>
                                    <td>
                                        {{$lead->mobile ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Country') }}</h5>
                                    </th>
                                    <td>
                                        {{ $country ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Cities') }}</h5>
                                    </th>
                                    <td>
                                        @foreach($lead->cities as $_city)
                                            <span class="badge bg-info fs-6 m-1">{{$_city->name}}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Interests') }}</h5>
                                    </th>
                                    <td>
                                        @foreach ($interest_tags as $tag)
                                        <span class="badge bg-info fs-6 m-1">{{$tag->name}}</span>  
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Preferred Languages') }}</h5>
                                    </th>
                                    <td>
                                        @foreach ($langusages_array as $language)
                                            <span class="badge bg-info fs-6 m-1">{{$language->name}}</span> 
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Lead Quality') }}</h5>
                                    </th>
                                    <td>
                                        <x-lead-quality :variable="$lead"></x-lead-quality>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Lead Priority') }}</h5>
                                    </th>
                                    <td>
                                        {{ucfirst($lead->priority)}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Converted') }}</h5>
                                    </th>
                                    <td>
                                        {{($lead->converted) ? 'Converted' : 'Not Converted'}}
                                    </td>
                                </tr>
                                @if(!Auth::user()->isAgent)
                                    <tr>
                                        <th>
                                            {{ __('Agent') }}</h5>
                                        </th>
                                        <td>
                                            @foreach($lead->agents as $_agent)
                                                <span class="badge bg-info fs-6 m-1">{{ $_agent->name }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>
                                        {{ __('Campaign') }}</h5>
                                    </th>
                                    <td>
                                        {{ $lead->campaign->title ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        @include('fullwidth.partials.interested-show', ['lead' => $lead])
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        @include('fullwidth.partials.dates-show', ['model' => $lead])
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan