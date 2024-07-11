@extends('fullwidth.layouts.app')
@section('content')
    
                <form method="POST" action="{{ route("dashboard.blogs.store") }}" class="form-boder" enctype="multipart/form-data">
                    @csrf
                    @include('fullwidth.blogs.form', ['blog' => New \App\Models\Dashboard\Blog])
                </form>

@endsection