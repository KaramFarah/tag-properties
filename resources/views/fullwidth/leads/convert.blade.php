@extends('fullwidth.layouts.app')
@section('content')
    <form method="POST" action="{{ route("dashboard.contacts.create-convert" , $contact->id) }}" class="form-boder" enctype="multipart/form-data">
        @csrf
        @include('fullwidth.contacts.form')
    </form>
@endsection