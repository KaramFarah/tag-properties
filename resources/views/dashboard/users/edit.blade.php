@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route("dashboard.users.update", [$user->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('dashboard.users.form')
            </form>
        </div>
    </div>
@endsection