@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            @can('role_create')
                <div class="mb-3">
                    <a class="btn btn-outline-success" href="{{ route('dashboard.roles.create') }}">
                        <i class="bi bi-plus"></i> {{ __('Add Role') }}
                    </a>
                </div>
            @endcan 
            <livewire:Dashboard.SearchRoles />
        </div>
    </div>
@endsection