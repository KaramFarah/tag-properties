@extends('fullwidth.layouts.app')
@section('content')

            <form method="POST" action="{{ route("dashboard.campaigns.update", [$campaign->id]) }}" class="form-boder" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('fullwidth.campaigns.form')
            </form>
@endsection