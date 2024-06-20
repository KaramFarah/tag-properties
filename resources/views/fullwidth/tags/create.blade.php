@extends('fullwidth.layouts.app')
@section('content')

                <form method="POST" action="{{ route("dashboard.tags.store") }}" class="form-boder" enctype="multipart/form-data">
                    @csrf
                    @include('fullwidth.tags.form', ['tag' => New \App\Models\Dashboard\Tag])
                </form>

@endsection