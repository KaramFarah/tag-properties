@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                @can('user_create')
                    <a class="btn btn-outline-success waves-effect waves-light mb-2" href="{{ route('dashboard.users.create') }}" data-value="" data-title="{{ __('Add User') }}">
                        <i class="bi bi-plus"></i> {{ __('Add User') }}
                    </a>
                @endcan
            </div>
            <livewire:Dashboard.SearchUsers />
        </div>
    </div>
@endsection