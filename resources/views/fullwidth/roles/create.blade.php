@extends('fullwidth.layouts.app')
@section('content')
    <div class="row">
        <div class="col mb-30">
            <div class="border rounded bg-white p-30">
                <form method="POST" action="{{ route("dashboard.roles.store") }}" enctype="multipart/form-data" class="form-boder">
                    @csrf
                    @include('fullwidth.roles.form', ['role' => new \App\Models\Role ])
                </form>
            </div>
        </div>
    </div>
@endsection