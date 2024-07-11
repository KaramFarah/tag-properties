<div>
    <form class="form" wire:submit.prevent="search">
        <x-inputs.text inputName="title" inputId="title" inputLabel="{{ __('Title') }}" error="{{ $errors->has('title') ? $errors->first('title') : '' }}" inputValue="{{ old('title', request()->title ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=title"/>
    </form>
    <div class="table-responsive">
        <table class="table table-hover Permission">
            <thead>
                <tr>
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
                            {{ $permission->title ?? '' }}
                        </td>
                        <td>
                            @can('permission_show')
                                <a class="btn btn-outline-primary btn-sm viewDetails" href="#" data-value="{{ route('dashboard.permissions.show', $permission->id) }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                            @endcan
                            @can('permission_edit')
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('dashboard.permissions.edit', $permission->id) }}">
                                    <i class="bi bi-pen"></i>
                                </a>
                            @endcan
                            @can('permission_delete')
                                <form action="{{ route('dashboard.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-outline-danger waves-effect waves-light btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
