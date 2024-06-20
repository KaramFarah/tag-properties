@extends('fullwidth.layouts.app')
@section('pageTitle', sprintf('%s %s', __('Create'), __('Agent')) . ' | ' . config('panel.site_title'))
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route("dashboard.agents.store") }}" enctype="multipart/form-data">
                @csrf
                @include('dashboard.agents.form', ['agent' => New \App\Models\Dashboard\Agent])
            </form>
        </div>
    </div>
@endsection