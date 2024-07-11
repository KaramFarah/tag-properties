@extends('fullwidth.layouts.app')
@section('content')
    <form method="POST" action="{{ route("dashboard.actions.store") }}" class="form-boder" enctype="multipart/form-data">
        @csrf
        @include('fullwidth.calls.form', ['call' => New \App\Models\Dashboard\Call])
    </form>
@endsection