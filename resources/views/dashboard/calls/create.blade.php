@extends('dashboard.layouts.app')
@section('pageTitle', sprintf('%s %s', __('Create'), __('Call')) . ' | ' . config('panel.site_title'))
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route("dashboard.calls.store") }}" enctype="multipart/form-data">
                @csrf
                @include('dashboard.calls.form', ['permission' => New \App\Models\Permission])
            </form>
        </div>
    </div>
@endsection