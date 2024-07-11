@extends('fullwidth.layouts.app')
@section('content')
    <form method="POST" id="agent_form" action="{{ route("dashboard.agents.store") }}" class="form-boder" enctype="multipart/form-data">
        @csrf
        @include('fullwidth.agents.form', ['agent' => New \App\Models\Dashboard\Agent])
    </form>
@endsection