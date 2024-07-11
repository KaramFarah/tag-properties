@extends('fullwidth.layouts.app')
@section('content')

            <form method="POST" action="{{ route("dashboard.blogs.update", [$blog->id]) }}" class="form-boder" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('fullwidth.blogs.form')
            </form>

@endsection