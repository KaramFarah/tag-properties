<div class="card table-responsive">
    <div class="card-body">
        <table class="table table-bordered form-group">
            <tbody>
                <tr>
                    <th class="w-25">
                        {{ __('Id') }}
                    </th>
                    <td>
                        {{ $tag->id }}
                    </td>
                    
                </tr>
                <tr>
                    <th>
                        {{ __('Title') }}
                    </th>
                    <td>
                        {{ $tag->title }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @can('tag_edit')
        <a class="btn btn-outline-primary btn-sm" href="{{ route('dashboard.tags.edit', $tag->id) }}">
            <i class="bi bi-pen"></i> {{ __('Edit') }}
        </a>
        @endcan
        @can('tag_delete')
            <form action="{{ route('dashboard.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i> {{ __('Delete') }}</button>
            </form>
        @endcan
    </div>
</div>