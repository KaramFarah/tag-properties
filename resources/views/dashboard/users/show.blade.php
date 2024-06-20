<div class="card table-responsive">
    <div class="card-body">
        <table class="table">
            <tbody>
                <tr>
                    <th class="w-25">
                        {{ __('Id') }}
                    </th>
                    <td class="w-75">
                        {{ $user->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Name') }}
                    </th>
                    <td>
                        {{ $user->name }}
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
                <tr>
                    <th>
                        {{ __('Created At') }}
                    </th>
                    <td>
                        {{ $user->created_at }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Updated At') }}
                    </th>
                    <td>
                        {{ $user->updated_at }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @can('user_edit')
            <a class="btn btn-outline-primary btn-sm" href="{{ route('dashboard.users.edit', $user->id) }}" data-value="">
                <i class="bi bi-pen"></i> {{ __('Edit') }}
            </a>
        @endcan
        @can('user_delete')
            <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> {{ __('Delete') }}</button>
            </form>
        @endcan
    </div>
</div>