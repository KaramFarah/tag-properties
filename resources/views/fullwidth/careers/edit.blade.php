@extends('fullwidth.layouts.app')
@section('content')
    <form method="POST" action="{{ route("dashboard.careers.update", [$career->id]) }}" class="form-boder" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @include('fullwidth.careers.form')
    </form>
@endsection