<div class="row table-responsive">
    <div class="col mb-30">
        <table class="w-100 items-list bg-transparent">
            <tbody>

                <tr class="bg-white">
                    <th class="w-25">
                        {{ __('Id') }}
                    </th>
                    <td>
                        {{ $installment->id }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Details') }}</h5>
                    </th>
                    <td>
                        <h5 class="text-secondary font-400">{{ $installment->type }}</h5>
                        {{ $installment->milestone }} - {{ $installment->payment }}
                    </td>
                </tr>
                @if(Auth::user()->isAdmin)
                    <tr>
                        <th>
                            {{ __('Created By') }}</h5>
                        </th>
                        <td>
                            {{ $installment->createdBy->name ?? '' }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>
                        {{ __('Created At') }}</h5>
                    </th>
                    <td>
                        {{ $installment->created_at ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ __('Update At') }}</h5>
                    </th>
                    <td>
                        {{ $installment->updated_at ?? '' }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col">
        @if($installment->allowEdit)
            @can('installment_edit')
                <a class="btn btn-primary" href="{{ route('dashboard.installments.edit', $installment->id) }}">
                    <i class="fa fa-edit"></i> {{ __('Edit') }}
                </a>
            @endcan
            @can('installment_delete')
                <form action="{{ route('dashboard.installments.destroy', $installment->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
                </form>
            @endcan
        @endif
    </div>
</div>