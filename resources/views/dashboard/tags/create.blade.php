@extends('dashboard.layouts.app')
@section('pageTitle', sprintf('%s %s', __('Create'), __('Tag')) . ' | ' . config('panel.site_title'))
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route("dashboard.tags.store") }}" enctype="multipart/form-data">
                @csrf
                @include('dashboard.tags.form', ['permission' => New \App\Models\Permission])
            </form>
        </div>
    </div>
@endsection