@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                @can('call_create')
                    <a class="btn btn-outline-success waves-effect waves-light mb-2" href="{{ route('dashboard.calls.create') }}" data-value="" data-title="{{ __('Add Call') }}">
                        <i class="bi bi-plus"></i> {{ __('Add Call') }}
                    </a>
                @endcan
            </div>
            <livewire:Dashboard.SearchCalls />
        </div>
    </div>
@endsection