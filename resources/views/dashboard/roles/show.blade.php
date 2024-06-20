<div class="card table-responsive">
    <div class="card-body">
        <div class="form-group table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
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
                            {{ $role->title }}
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
                                <span class="badge bg-info">{{ $user->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        @can('role_edit')
            <a class="btn btn-outline-primary btn-sm" href="{{ route('dashboard.roles.edit', $role->id) }}">
                <i class="bi bi-pen"></i> {{ __('Edit') }}
            </a>
        @endcan
        @can('role_delete')
            <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> {{ __('Delete') }}</button>
            </form>
        @endcan
    </div>
</div>