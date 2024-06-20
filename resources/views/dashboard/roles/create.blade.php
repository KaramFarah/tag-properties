@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route("dashboard.roles.store") }}" enctype="multipart/form-data">
                @csrf
                @include('dashboard.roles.form', ['role' => new \App\Models\Role ])
            </form>
        </div>
    </div>
@endsection