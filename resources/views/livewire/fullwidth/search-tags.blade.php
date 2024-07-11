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
                            <x-inputs.text inputName="type" inputId="type" inputLabel="" error="{{ $errors->has('type') ? $errors->first('type') : '' }}" inputValue="{{ old('type', request()->type ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=type" inputPlaceholder="{{ __('Type') }}" />
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
                        {{ __('Type') }}
                    </th>
                    <th>
                        {{ __('Parent') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                    <tr wire:key="{{ $tag->id }}">
                        <td>
                            {{ $tag->id }}
                        </td>
                        <td>
                            <h5 class="text-secondary font-400">{{ $tag->name }}</h5>
                        </td>
                        <td>
                            {{ $tag->type }}
                        </td>
                        <td>
                            {{ $tag->parent->name ?? '' }}
                        </td>
                        <td>
                            @can('tag_show')
                                <a class="text-primary me-4 mb-1 viewDetails" href="#" data-value="{{ route('dashboard.tags.show', $tag->id) }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                            @endcan
                            @can('tag_edit')
                                <a class="text-primary me-4 mb-1" href="{{ route('dashboard.tags.edit', $tag->id) }}">
                                    <i class="fa fa-edit"></i>
                                </a>
                            @endcan
                            @can('tag_delete')
                                <form action="{{ route('dashboard.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
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