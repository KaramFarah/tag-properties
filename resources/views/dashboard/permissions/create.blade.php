@extends('dashboard.layouts.app')
@section('pageTitle', sprintf('%s %s', __('Create'), __('Permission')) . ' | ' . config('panel.site_title'))
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route("dashboard.permissions.store") }}" enctype="multipart/form-data">
                @csrf
                @include('dashboard.permissions.form', ['permission' => New \App\Models\Permission])
            </form>
        </div>
    </div>
@endsection