@extends('fullwidth.layouts.app')
@section('content')
<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <form method="POST" action="{{ route("dashboard.roles.update", [$role->id]) }}" enctype="multipart/form-data" class="form-boder">
                @method('PUT')
                @csrf
                @include('fullwidth.roles.form')
            </form>
        </div>
    </div>
</div>
@endsection