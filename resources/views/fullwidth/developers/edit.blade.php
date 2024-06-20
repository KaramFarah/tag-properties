@extends('fullwidth.layouts.app')
@section('content')
    <div class="row">
        <div class="col mb-30">
            <div class="border rounded bg-white p-30">
                <form method="POST" action="{{ route("dashboard.developers.update", [$developer->id]) }}" class="form-boder" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    @include('fullwidth.developers.form')
                </form>
            </div>
        </div>
    </div>
@endsection