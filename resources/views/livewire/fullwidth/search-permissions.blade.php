<div>
    <div class="bg-white p-30">
        <div class="row">
            <div class="col-xl">
                <form class="form-boder" wire:submit.prevent="search">
                    <div class="row">
                        <div class="col-10">
                            <x-inputs.text inputName="title" inputId="title" inputLabel="" error="{{ $errors->has('title') ? $errors->first('title') : '' }}" inputValue="{{ old('title', request()->title ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=title" inputPlaceholder="{{ __('Title') }}" />
                        </div>
                        <div class="col-2">
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
        <table class="w-100 items-list bg-transparent">
            <thead>
                <tr class="bg-white">
                    <th>
                        {{ __('Id') }}
                    </th>
                    <th>
                        {{ __('Title') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $key => $permission)
                    <tr data-entry-id="{{ $permission->id }}">
                        <td>
                            {{ $permission->id ?? '' }}
                        </td>
                        <td>
                            <h5 class="text-secondary font-400">{{ $permission->title ?? '' }}</h5>
                        </td>
                        <td>
                            @can('permission_show')
                                <a class="text-primary  me-4 mb-1 viewDetails" href="#" data-value="{{ route('dashboard.permissions.show', $permission->id) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                            @can('permission_edit')
                                <a class="text-primary me-4 mb-1" href="{{ route('dashboard.permissions.edit', $permission->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('permission_delete')
                                <form action="{{ route('dashboard.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-mini btn-outline-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
