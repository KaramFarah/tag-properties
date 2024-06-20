@extends('fullwidth.layouts.app')
@section('content')
    <form method="POST" action="{{ route("dashboard.users.store") }}" enctype="multipart/form-data" class="form-boder">
        @csrf
        @include('fullwidth.users.form', ['user' => New \App\Models\User ])
    </form>
@endsection