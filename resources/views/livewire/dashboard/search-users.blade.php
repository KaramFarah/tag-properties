<div>
    <form class="form" wire:submit.prevent="search">
        <div class="row mb-3 align-items-center border-bottom pb-3">
            <div class="col-md-2">
                <x-inputs.text inputName="id" inputId="id" inputLabel="{{ __('Id') }}" error="{{ $errors->has('id') ? $errors->first('id') : '' }}" inputValue="{{ old('id', request()->id ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=id"/>
            </div>
            <div class="col-md-5">
                <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" error="{{ $errors->has('name') ? $errors->first('name') : '' }}" inputValue="{{ old('name', request()->name ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=name"/>
            </div>
            <div class="col-md-5">
                <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" error="{{ $errors->has('email') ? $errors->first('email') : '' }}" inputValue="{{ old('email', request()->email ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=email"/>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-hover User">
            <thead>
                <tr>
                    <th>
                        {{ __('Id') }}
                    </th>
                    <th>
                        {{ __('Name') }}
                    </th>
                    <th class="w-25">
                        {{ __('Email') }}
                    </th>
                    <th class="d-none">
                        {{ __('Birth Date') }}
                    </th>
                    <th>
                        {{ __('Roles') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $key => $user)
                    <tr data-entry-id="{{ $user->id }}">
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td class="d-none">
                            {{ $user->birthdate }}
                        </td>
                        <td>
                            @foreach($user->roles as $key => $item)
                                <span class="badge bg-info">{{ $item->title }}</span>
                            @endforeach
                        </td>
                        <td>
                            @can('user_show')
                                <a class="btn btn-outline-primary btn-sm viewDetails" role="button" href="#" data-value="{{ route('dashboard.users.show', $user->id) }}" data-title="{{ __('User Details') }}" >
                                    <i class="bi bi-eye"></i>
                                </a>
                            @endcan
                            @can('user_edit')
                                <a class="btn btn-outline-primary btn-sm" href="{{ route('dashboard.users.edit', $user->id) }}" data-value="" data-title="{{ sprintf('%s %s', __('Edit'), $user->name) }}">
                                    <i class="bi bi-pen"></i>
                                </a>
                            @endcan
                            @can('user_delete')
                                <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">Empty</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
