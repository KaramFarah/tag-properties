@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route("dashboard.roles.update", [$role->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('dashboard.roles.form')
            </form>
        </div>
    </div>
@endsection