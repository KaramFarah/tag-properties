@extends('fullwidth.layouts.app')
@section('content')
    <form method="POST" action="{{ route("dashboard.actions.update", [$action->id]) }}" class="form-boder" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @include('fullwidth.calls.form')
    </form>
@endsection