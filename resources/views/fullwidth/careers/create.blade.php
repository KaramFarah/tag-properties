@extends('fullwidth.layouts.app')
@section('content')
    
                <form method="POST" action="{{ route("dashboard.careers.store") }}" class="form-boder" enctype="multipart/form-data">
                    @csrf
                    @include('fullwidth.careers.form', ['career' => New \App\Models\Dashboard\Career])
                </form>

@endsection