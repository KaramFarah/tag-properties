@extends('fullwidth.layouts.app')
@section('content')
    <form method="POST" action="{{ route("dashboard.leads.update", [$lead->id]) }}" class="form-boder" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @include('fullwidth.leads.form')
    </form>
@endsection