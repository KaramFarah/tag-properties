@extends('fullwidth.layouts.app')
@section('content')
    <form method="POST" action="{{ route("dashboard.projects.store") }}" class="form-boder" enctype="multipart/form-data" id="create-project">
        @csrf
        @include('fullwidth.projects.form', ['project' => New \App\Models\Dashboard\Project])
    </form>
@endsection