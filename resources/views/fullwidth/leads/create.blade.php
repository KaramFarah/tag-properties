@extends('fullwidth.layouts.app')
@section('content')

    <form method="POST" action="{{ route("dashboard.leads.store") }}" class="form-boder" enctype="multipart/form-data">
        @csrf
        @include('fullwidth.leads.form', ['lead' => New \App\Models\Dashboard\Contact])
    </form>
@endsection