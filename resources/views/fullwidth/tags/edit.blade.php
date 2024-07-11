@extends('fullwidth.layouts.app')
@section('content')

            <form method="POST" action="{{ route("dashboard.tags.update", [$tag->id]) }}" class="form-boder" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('fullwidth.tags.form')
            </form>

@endsection