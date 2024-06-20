@extends('fullwidth.layouts.app')
@section('content')
    <div class="row">
        <div class="col mb-30">
            <div class="border rounded bg-white p-30">
                <form method="POST" action="{{ route("dashboard.installments.store") }}" class="form-boder" enctype="multipart/form-data" id="create-installment">
                    @csrf
                    @include('fullwidth.installments.form', ['installment' => New \App\Models\Dashboard\Installment])
                </form>
            </div>
        </div>
    </div>
@endsection