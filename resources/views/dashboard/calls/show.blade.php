<div class="card table-responsive">
    <div class="card-body">
        <table class="table table-bordered form-group">
            <tbody>
                <tr>
                    <th class="w-25">
                        {{ __('Id') }}
                    </th>
                    <td>
                        {{ $call->id }}
                    </td>
                    
                </tr>
                <tr>
                    <th>
                        {{ __('Title') }}
                    </th>
                    <td>
                        {{ $call->title }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @can('call_edit')
        <a class="btn btn-outline-primary btn-sm" href="{{ route('dashboard.calls.edit', $call->id) }}">
            <i class="bi bi-pen"></i> {{ __('Edit') }}
        </a>
        @endcan
        @can('call_delete')
            <form action="{{ route('dashboard.calls.destroy', $call->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> {{ __('Delete') }}</button>
            </form>
        @endcan
    </div>
</div>