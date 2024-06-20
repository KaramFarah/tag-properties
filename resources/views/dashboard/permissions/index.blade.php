@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            @can('permission_create')
                <div class="mb-3">
                    <a class="btn btn-outline-success" href="{{ route('dashboard.permissions.create') }}">
                        <i class="bi bi-plus"></i> {{ __('Add') }} {{ __('Permission') }}
                    </a>
                </div>
            @endcan
            <livewire:Dashboard.SearchPermissions/>
        </div>
    </div>
@endsection