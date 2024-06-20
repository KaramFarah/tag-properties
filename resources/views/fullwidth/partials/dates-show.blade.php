<table class="table table-sm">
    <tr>
        <td colspan="2">
            <h5>{{ __('System Details') }}:</h5>
        </td>
    </tr>
    @if(Auth::user()->isAdmin)
        <tr>
            <th class="w-25">
                {{ __('Created By') }}</h5>
            </th>
            <td>
                {{ $model->createdBy->name ?? '- System User' }}
            </td>
        </tr>
    @endif
    <tr>
        <th>
            {{ __('Created At') }}
        </th>
        <td>
            {{ $model->created_at ?? '' }}
        </td>
    </tr>
    <tr>
        <th>
            {{ __('Updated At') }}
        </th>
        <td>
            {{ $model->updated_at ?? '' }}
        </td>
    </tr>
    @if($model->deleted_at)
    <tr>
        <th>
            {{ __('Deleted At') }}
        </th>
        <td>
            {{ $model->deleted_at ?? '' }}
        </td>
    </tr>
    @endif
</table>