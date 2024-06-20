@extends('fullwidth.layouts.app')
@section('content')
    <div class="row">
        <div class="col mb-30">
            <div class="border rounded bg-white p-30">
                <form method="POST" action="{{ route("dashboard.developers.store") }}" class="form-boder" enctype="multipart/form-data" id="create-developer">
                    @csrf
                    @include('fullwidth.developers.form', ['developer' => New \App\Models\Dashboard\Developer])
                </form>
            </div>
        </div>
    </div>
@endsection