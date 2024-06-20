@extends('dashboard.layouts.app')
@section('pageTitle', sprintf('%s | %s %s', $permission->title, trans('global.edit'), trans('cruds.permission.title_singular')) . ' | ' . trans('panel.site_title'))
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route("dashboard.permissions.update", [$permission->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('dashboard.permissions.form')
            </form>
        </div>
    </div>
@endsection