@extends('fullwidth.layouts.app')
@section('content')

            <form method="POST" action="{{ route("dashboard.users.update", [$user->id]) }}" enctype="multipart/form-data" class="form-boder">
                @method('PUT')
                @csrf
                @include('fullwidth.users.form')
            </form>
@endsection