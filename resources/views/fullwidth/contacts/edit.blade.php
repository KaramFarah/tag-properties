@extends('fullwidth.layouts.app')
@section('content')
    <form method="POST" action="{{ route("dashboard.contacts.update", [$contact->id]) }}" class="form-boder" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @include('fullwidth.contacts.form')
    </form>
@endsection