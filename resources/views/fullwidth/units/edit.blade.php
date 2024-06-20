@extends('fullwidth.layouts.app')
@include('website.partials.stylesPush')
@section('content')
    {{-- <form class="form-boder" action="{{ route('dashboard.units.update', [$unit->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('fullwidth.units.form')
    </form> --}}
    @include('fullwidth.units.websiteForm',
    [
        'route' => route('dashboard.units.update', [$unit->id]),
    ])
@endsection
