@extends('fullwidth.layouts.app')
@section('content')
<div class="row">
    <div class="col">
        <div class="dashboard-panel border bg-white rounded overflow-hidden w-100">
            <div class="overflow-x-scroll font-fifteen">
                <div class="m-30">
                    @can('user_create')
                        <a class="btn btn-success rounded-pill" href="{{ route('dashboard.users.create') }}" data-value="" data-title="{{ __('Add User') }}">
                            <i class="fa fa-plus"></i> {{ __('Add User') }}
                        </a>
                    @endcan
                    <div class="bg-white p-30">
                        <div class="row">
                            <div class="col-xl">
                                <form class="form-boder" action={{route('dashboard.users.index')}}>
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <x-inputs.text inputName="id" inputId="id" inputLabel="{{ __('Id') }}" error="{{ $errors->has('id') ? $errors->first('id') : '' }}" inputValue="{{ old('id', request()->get('id') ?? '') }}" />
                                        </div>
                                        <div class="col-md-4">
                                            <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" error="{{ $errors->has('name') ? $errors->first('name') : '' }}" inputValue="{{ old('name', request()->get('name') ?? '') }}"/>
                                        </div>
                                        <div class="col-md-4">
                                            <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" error="{{ $errors->has('email') ? $errors->first('email') : '' }}" inputValue="{{ old('email', request()->get('email') ?? '') }}" />
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-filter"></i> {{ __('Apply') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table w-100 items-list bg-transparent">
                            <thead>
                                <tr class="bg-white">
                                    <th>
                                        {{ __('Id') }}
                                    </th>
                                    <th>
                                        {{ __('Name') }}
                                    </th>
                                    <th>
                                        {{ __('Roles') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $key => $user)
                                    <tr data-entry-id="{{ $user->id }}">
                                        <td>
                                            {{ $user->id }}
                                        </td>
                                        <td class="w-50">
                                            <h5 class="text-secondary font-400">{{ $user->name }}</h5>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            @foreach($user->roles as $key => $item)
                                                <span class="badge bg-info fs-6 m-1">{{ $item->title }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('user_show')
                                                <a class="text-primary me-4 mb-1" role="button" href="{{ route('dashboard.users.show', $user->id) }}" data-value="" data-title="{{ __('User Details') }}" >
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('user_edit')
                                                <a class="text-primary me-4 mb-1" href="{{ route('dashboard.users.edit', $user->id) }}" data-value="" data-title="{{ sprintf('%s %s', __('Edit'), $user->name) }}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('user_delete')
                                                <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="btn btn-mini btn-outline-danger"><i class="fa fa-trash"></i></button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">Empty</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{$users->links()}}
                        </div>
                        <div class="d-flex justify-content-center" >
                            @include('fullwidth.partials.pagnitaion' , ['items' => $users]);                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection