<div>
    <form class="form" wire:submit.prevent="search">
        <div class="row mb-3 align-items-center border-bottom pb-3">
            <div class="col-md-2">
                <x-inputs.text inputName="id" inputId="id" inputLabel="{{ __('Id') }}" error="{{ $errors->has('id') ? $errors->first('id') : '' }}" inputValue="{{ old('id', request()->id ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=id"/>
            </div>
            <div class="col-md-5">
                <x-inputs.text inputName="title" inputId="title" inputLabel="{{ __('Name') }}" error="{{ $errors->has('title') ? $errors->first('title') : '' }}" inputValue="{{ old('title', request()->title ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=title"/>
            </div>
            <div class="col-md-5">
                <x-inputs.select inputName="permission" inputId="permission" inputLabel="{{ __('Permission') }}" error="{{ $errors->has('permission') ? $errors->first('permission') : '' }}" :inputData="$permissions" inputValue="{{ old('permission', request()->permission ?? '') }}" inputClass="select2" class="mb-3" inputAttributes="wire:change=search wire:model=permission" showButtons="false" />
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-hover Role">
            <thead>
                <tr>
                    <th class="">
                        {{ __('Id') }}
                    </th>
                    <th>
                        {{ __('Name') }}
                    </th>
                    <th class="w-50">
                        {{ __('Permissions') }}
                    </th>
                    <th class="w-25">
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $key => $role)
                    <tr data-entry-id="{{ $role->id }}">
                        <td>
                            {{ $role->id }}
                        </td>
                        <td>
                            {{ $role->title }}
                        </td>
                        <td>
                            @foreach($role->permissions as $key => $item)
                                <span class="badge bg-info">{{ $item->title }}</span>
                            @endforeach
                        </td>
                        <td>
                            @can('role_show')
                                <a class="btn btn-outline-primary btn-sm viewDetails" href="#" data-value="{{ route('dashboard.roles.show', $role->id) }}" data-title="{{ __('Role Details') }}">
                                    <i class="bi bi-eye"></i>
                                </a>
                            @endcan
                            @can('role_edit')
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('dashboard.roles.edit', $role->id) }}" data-value="" data-title="Edit">
                                    <i class="bi bi-pen"></i>
                                </a>
                            @endcan
                            @can('role_delete')
                                <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-outline-danger waves-effect waves-light btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Empty</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
