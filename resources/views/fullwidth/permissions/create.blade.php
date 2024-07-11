@extends('fullwidth.layouts.app')
@section('content')
    <div class="row">
        <div class="col mb-30">
            <div class="border rounded bg-white p-30">
                <form method="POST" action="{{ route("dashboard.permissions.store") }}" class="form-boder" enctype="multipart/form-data">
                    @csrf
                    @include('fullwidth.permissions.form', ['permission' => New \App\Models\Permission])
                </form>
            </div>
        </div>
    </div>
@endsection