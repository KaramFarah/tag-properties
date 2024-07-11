@extends('fullwidth.layouts.app')
@section('content')
    <div class="text-end mb-3">
        @if($agent->allowEdit)
            @can('agent_edit')
                <a class="btn btn-primary" href="{{ route('dashboard.agents.edit', $agent->id) }}">
                    <i class="fa fa-edit"></i> {{ __('Edit') }}
                </a>
            @endcan
            @can('agent_delete')
                <form action="{{ route('dashboard.agents.destroy', $agent->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
                </form>
            @endcan
            @can('audit_log_access')
                <a class="btn btn-light viewDetails" href="#" data-title="{{ __('Activities')}}" data-value="{{ route('dashboard.agents.index-auditlogs', ['id' => $agent->id,'class' => get_class($agent)]) }}">
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
                    <div class="row table-responsive">
                        <div class="col mb-30">
                            <table class="w-100 items-list bg-transparent">
                                <tbody>
                                    <tr>
                                        <th class="w-25">
                                            {{ __('Id') }}
                                        </th>
                                        <td>
                                            {{ $agent->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Email') }}
                                        </th>
                                        <td>
                                            {{ $agent->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Phone') }}
                                        </th>
                                        <td>
                                            {{ $agent->phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Birthday') }}
                                        </th>
                                        <td>
                                            {{ $agent->birthday }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Emitaes ID') }}
                                        </th>
                                        <td>
                                            {{ $agent->emitaes_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('BRN') }}
                                        </th>
                                        <td>
                                            {{ $agent->brn }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Languages') }}
                                        </th>
                                        <td>
                                            {{-- {{ $agent->languages }} --}}
                                            @foreach ($agent->tags as $tag)
                                                <span class="badge bg-info fs-6 m-1">{{$tag->name}}</span>  
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Employment Number') }}
                                        </th>
                                        <td>
                                            {{ $agent->employee_id_number }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @include('fullwidth.partials.dates-show', ['model' => $agent])
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button bg-light text-secondary d-block text-truncate px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#leads" aria-expanded="false" aria-controls="leads">
                <h5>{{ __('Leads') }}</h5>
            </button>
            </h2>
            <div id="leads" class="accordion-collapse collapse" data-bs-parent="#accordionShowDetails">
                <div class="accordion-body">
                    <div class="row table-responsive">
                        <div class="col mb-30">
                            <table>
                                <tr>
                                    <thead>
                                        <th>Name</th>
                                        <th></th>
                                    </thead>
                                </tr>
                                @forelse($agent->leads as $lead)
                                    <tbody>
                                        <tr>
                                            <td>{{$lead->name}}</td>
                                            <td>
                                                @can('lead_show')
                                                    <a class="text-primary p-10" href="{{ route('dashboard.leads.show', $lead->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    </tbody>
                                @empty
                                        <tr>
                                            <td colspan="2">No Leads assigned</td>
                                        </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
            <button class="accordion-button bg-light text-secondary d-block text-truncate px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#contacts" aria-expanded="false" aria-controls="contacts">
                <h5>{{ __('Contacts') }}</h5>
            </button>
            </h2>
            <div id="contacts" class="accordion-collapse collapse" data-bs-parent="#accordionShowDetails">
                <div class="accordion-body">
                    <div class="row table-responsive">
                        <div class="col mb-30">
                            <table>
                                <tr>
                                    <thead>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th></th>
                                    </thead>
                                </tr>
                                @forelse($agent->contacts as $contact)
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{$contact->name}}</td>
                                            <td>
                                                @can('lead_show')
                                                    <a class="text-primary p-10" href="{{ route('dashboard.leads.show', $contact->id) }}">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    </tbody>
                                @empty
                                        <tr>
                                            <td colspan="3">No contacts assigned</td>
                                        </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('fullwidth.partials.actions-accordion-item', ['actions' => $contact->calls ?? []])
    </div>
@endsection