<div>
    <div class="bg-white p-30">
        <div class="row">
            <div class="col-xl">
                <form class="form-boder" wire:submit.prevent="search">
                    <div class="row">
                        <div class="col-md-5">
                            <x-inputs.text inputName="name" inputId="name" inputLabel="" error="{{ $errors->has('name') ? $errors->first('name') : '' }}" inputValue="{{ old('name', request()->name ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=name" inputPlaceholder="{{ __('Name') }}" />
                        </div>
                        <div class="col-md-5">
                            <x-inputs.text inputName="description" inputId="description" inputLabel="" error="{{ $errors->has('name') ? $errors->first('description') : '' }}" inputValue="{{ old('description', request()->description ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=description" inputPlaceholder="{{ __('Description') }}" />
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
                        {{ __('Name') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($developers as $key => $developer)
                    <tr data-entry-id="{{ $developer->id }}">
                        <td>
                            {{ $developer->id }}
                        </td>
                        <td class="w-50">
                            <img class="rounded" src="{{ $developer->logoThumb }}" alt="Logo Alt Text">
                            <h5 class="text-secondary font-400">{{ $developer->name }}</h5>
                            {{ Str::words($developer->description, 4) }}
                        </td>
                        <td>
                            @can('developer_show')
                                <a class="text-primary  me-4 mb-1 viewDetails" href="#" data-value="{{ route('dashboard.developers.show', $developer->id) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                            @can('developer_edit')
                                <a class="text-primary me-4 mb-1" href="{{ route('dashboard.developers.edit', $developer->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('developer_delete')
                                <form action="{{ route('dashboard.developers.destroy', $developer->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
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