@extends('fullwidth.layouts.app')
@section('content')
    <form method="POST" action="{{ route("dashboard.projects.update", [$project->id]) }}" class="form-boder" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @include('fullwidth.projects.form')
    </form>
@endsection