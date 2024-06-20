@extends('dashboard.layouts.app')
@section('pageTitle', sprintf('%s | %s %s', $agent->title, __('Edit'), __('Agent')) . ' | ' . config('panel.site_title'))
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route("dashboard.agents.update", [$agent]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('dashboard.agents.form')
            </form>
        </div>
    </div>
@endsection