<div class="text-end mb-30">
    @if($lead->whatsapp)
        <a class="btn btn-info rounded-pill" href="https://web.whatsapp.com/send/?phone={{$lead->whatsapp}}" title="{{ __('Whatsapp') }}">
        <i class="fa-brands fa-whatsapp"></i> {{ __('Whatsapp') }}
    </a>
    @endif
    @if($lead->email)
        <a class="btn btn-info rounded-pill" href="mailto:{{$lead->email}}&subject=Tag Properties Contact" title="{{ __('Send Email') }}">
            <i class="fa-regular fa-envelope"></i> {{ __('Send Email') }}
        </a>
    @endif
    @can('call_create')
        <a class="btn btn-success rounded-pill" href="{{route('dashboard.actions.add' , $lead->id)}}" title="{{ __('Add Action Registery') }}">
            <i class="fa-regular fa-calendar-plus"></i> {{ __('Add Action') }}
        </a>
    @endcan
    @can('contact_create')
        <a class="btn btn-success rounded-pill" href="{{ route('dashboard.leads.convert', $lead->id) }}" title="{{ __('Convert to Client') }}">
            <i class="fa-solid fa-people-arrows"></i> {{ __('Convert') }}
        </a>
    @endcan
    @if($lead->allowEdit)
        @can('lead_edit')
            <a class="btn btn-primary" href="{{ route('dashboard.leads.edit', $lead->id) }}">
                <i class="fa fa-edit"></i> {{ __('Edit') }}
            </a>
        @endcan
        @can('lead_delete')
            <form action="{{ route('dashboard.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
            </form>
        @endcan
        @can('audit_log_access')
            <a class="btn btn-light viewDetails" href="#" data-title="{{ __('Activities')}}" data-value="{{ route('dashboard.leads.index-auditlogs', ['id' => $lead->id,'class' => get_class($lead)]) }}">
                <i class="fa fa-edit"></i> {{ __('Activities') }}
            </a>
        @endcan
    @endif
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
                                {{-- <tr>
                                    <th>
                                        {{ __('Name') }}</h5>
                                    </th>
                                    <td>
                                        <h5 class="text-secondary font-400">{{ $lead->name }}</h5>
                                    </td>
                                </tr> --}}
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
                                        {{ __('City') }}</h5>
                                    </th>
                                    <td>
                                        {{ $lead->city ?? '' }}
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
                                        {{ $lead->campaign->name ?? '' }}
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
    @can('comment_access')
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button bg-light text-secondary d-block text-truncate px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#comments" aria-expanded="false" aria-controls="comments">
                    <h5>{{ __('Comments') }}</h5>
                </button>
            </h2>
            <div id="comments" class="accordion-collapse collapse" data-bs-parent="#accordionShowDetails">
                <div class="accordion-body">
                    @include('fullwidth.partials.comments', ['comments' => $lead->comments ?? [], 'ref_id' => $lead->id, 'show_btn' => true])
                </div>
            </div>
        </div>
    @endcan
    @include('fullwidth.partials.actions-accordion-item', ['actions' => $lead->calls ?? []])
</div>