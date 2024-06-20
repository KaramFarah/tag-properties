@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                @can('campaign_create')
                    <a class="btn btn-outline-success waves-effect waves-light mb-2" href="{{ route('dashboard.campaigns.create') }}" data-value="" data-title="{{ __('Add Campaign') }}">
                        <i class="bi bi-plus"></i> {{ __('Add Campaign') }}
                    </a>
                @endcan
            </div>
            <div class="title">Campaigns</div>
        </div>
    </div>
@endsection