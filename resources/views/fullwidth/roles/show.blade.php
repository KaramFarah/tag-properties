<div class="row table-responsive">
    <div class="col mb-30">
        <table class="w-100 items-list bg-transparent">
            <tbody>
                <tr class="bg-white">
                    <th class="w-25">
                        {{ __('Id') }}
                    </th>
                    <td>
                        {{ $role->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Title') }}
                    </th>
                    <td>
                        <h5 class="text-secondary font-400">{{ $role->title }}</h5>
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Permissions') }}
                    </th>
                    <td>
                        @foreach($role->permissions as $permissions)
                            <span class="badge bg-info">{{ $permissions->title }}</span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Users') }}
                    </th>
                    <td>
                        @foreach($role->users as $user)
                            <span class="badge bg-info fs-6 m-1">{{ $user->name }}</span>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        @can('role_edit')
            <a class="btn btn-primary btn-sm" href="{{ route('dashboard.roles.edit', $role->id) }}">
                <i class="fa fa-edit"></i> {{ __('Edit') }}
            </a>
        @endcan
        @can('role_delete')
            <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
            </form>
        @endcan
    </div>
</div>