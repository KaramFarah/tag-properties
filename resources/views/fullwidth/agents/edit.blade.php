@extends('fullwidth.layouts.app')
@section('content')
    <form method="POST" id="agent_form" action="{{route("dashboard.agents.update", [$agent->id])}}" class="form-boder" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        @include('fullwidth.agents.form')
    </form>
@endsection