@extends('dashboard.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route("dashboard.users.store") }}" enctype="multipart/form-data">
                @csrf
                @include('dashboard.users.form', ['user' => New \App\Models\User ])
            </form>
        </div>
    </div>
@endsection