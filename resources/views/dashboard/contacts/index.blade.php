@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                @can('contact_create')
                    <a class="btn btn-outline-success waves-effect waves-light mb-2" href="{{ route('dashboard.contacts.create') }}" data-value="" data-title="{{ __('Add Contact') }}">
                        <i class="bi bi-plus"></i> {{ __('Add Contact') }}
                    </a>
                @endcan
            </div>
            <livewire:Dashboard.SearchContacts />
        </div>
    </div>
@endsection