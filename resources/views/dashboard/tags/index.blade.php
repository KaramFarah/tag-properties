@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                @can('tag_create')
                    <a class="btn btn-outline-success waves-effect waves-light mb-2" href="{{ route('dashboard.tags.create') }}" data-value="" data-title="{{ __('Add Tag') }}">
                        <i class="bi bi-plus"></i> {{ __('Add Tag') }}
                    </a>
                @endcan
            </div>
            <livewire:Dashboard.SearchTags />
        </div>
    </div>
@endsection