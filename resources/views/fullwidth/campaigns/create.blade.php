@extends('fullwidth.layouts.app')
@section('content')
    
                <form method="POST" action="{{ route("dashboard.campaigns.store") }}" class="form-boder" enctype="multipart/form-data">
                    @csrf
                    @include('fullwidth.campaigns.form', ['campaign' => New \App\Models\Dashboard\Campaign])
                </form>

@endsection