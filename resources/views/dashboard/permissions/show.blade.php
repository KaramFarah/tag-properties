<div class="card table-responsive">
    <div class="card-body">
        <table class="table table-bordered form-group">
            <tbody>
                <tr>
                    <th class="w-25">
                        {{ __('Id') }}
                    </th>
                    <td>
                        {{ $permission->id }}
                    </td>
                    
                </tr>
                <tr>
                    <th>
                        {{ __('Title') }}
                    </th>
                    <td>
                        {{ $permission->title }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @can('permission_edit')
        <a class="btn btn-outline-primary btn-sm" href="{{ route('dashboard.permissions.edit', $permission->id) }}">
            <i class="bi bi-pen"></i> {{ __('Edit') }}
        </a>
        @endcan
        @can('permission_delete')
            <form action="{{ route('dashboard.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> {{ __('Delete') }}</button>
            </form>
        @endcan
    </div>
</div>