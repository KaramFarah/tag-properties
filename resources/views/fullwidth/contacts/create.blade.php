@extends('fullwidth.layouts.app')
@section('content')

                <form method="POST" action="{{ route("dashboard.contacts.store") }}" class="form-boder" enctype="multipart/form-data">
                    @csrf
                    @include('fullwidth.contacts.form', ['contact' => New \App\Models\Dashboard\Contact])
                </form>

@endsection