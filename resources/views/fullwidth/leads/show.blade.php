@extends('fullwidth.layouts.app')
@section('content')
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
        @include('fullwidth.partials.lead-accordion-item')
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
@endsection
