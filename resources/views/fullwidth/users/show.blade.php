@extends('fullwidth.layouts.app')
@section('content')
<div class="text-end mb-30">
    @can('user_edit')
        <a class="btn btn-primary btn-sm" href="{{ route('dashboard.users.edit', $user->id) }}" data-value="">
            <i class="fa fa-edit"></i> {{ __('Edit') }}
        </a>
    @endcan
    @can('user_delete')
        <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
        </form>
    @endcan
</div>
<div class="accordion" id="accordionShowDetails">
    <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button bg-light text-secondary d-block text-truncate px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#details" aria-expanded="true" aria-controls="details">
            <h5>{{ __('Details') }}</h5>
          </button>
        </h2>
        <div id="details" class="accordion-collapse collapse show" data-bs-parent="#accordionShowDetails">
            <div class="accordion-body">
                <div class="row bg-white mb-30">
                    <div class="col table-responsive">
                        <table class="w-100 items-list bg-transparent">
                            <tbody>
                                <tr class="">
                                    <th class="w-25">
                                        {{ __('Id') }}
                                    </th>
                                    <td class="w-75">
                                        {{ $user->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Email') }}
                                    </th>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Birthday') }}
                                    </th>
                                    <td>
                                        {{ $user->birthdate }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Email Verified At') }}
                                    </th>
                                    <td>
                                        {{ $user->email_verified_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ __('Roles') }}
                                    </th>
                                    <td>
                                        @foreach($user->roles as $key => $roles)
                                            <span class="badge rounded-pill bg-info">{{ $roles->title }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                @if($user->isAgent)
                                    <tr>
                                        <td colspan="2"><h5>Agent Details</h5></td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Emirates ID') }}
                                        </th>
                                        <td>
                                            {{ $user->emitaes_id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('BRN') }}
                                        </th>
                                        <td>
                                            {{ $user->brn }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Languages') }}
                                        </th>
                                        <td>
                                            {{-- {{ $user->languages }} --}}
                                            @foreach ($user->tags as $tag)
                                                    <span class="badge bg-info fs-6 m-1">{{$tag->name}}</span>  
                                                @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Phone') }}
                                        </th>
                                        <td>
                                            {{ $user->phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Employment No.') }}
                                        </th>
                                        <td>
                                            {{ $user->employee_id_number }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="{{route('dashboard.agents.show', ['agent' => $user->id])}}">Show more details</a></td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="2">
                                        @include('fullwidth.partials.dates-show', ['model' => $user])
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection