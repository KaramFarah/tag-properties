@extends('fullwidth.layouts.app')
@include('website.partials.stylesPush')
@section('content')

{{-- <form class="form-boder" action="{{ route('dashboard.units.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('fullwidth.units.form', ['unit' => new \App\Models\Dashboard\Unit])
</form> --}}
    @include('fullwidth.units.websiteForm',
    [
        'unit' => new \App\Models\Dashboard\Unit,
        'route' => route('dashboard.units.store'),
    ])
@endsection