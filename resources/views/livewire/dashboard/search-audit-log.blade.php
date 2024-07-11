<div>
    <form class="form" wire:submit.prevent="search">
        <div class="row mb-3 align-items-center border-bottom pb-3">
            <div class="col-md-2">
                <x-inputs.text inputName="description" inputId="description" inputLabel="{{ __('Description') }}" error="{{ $errors->has('description') ? $errors->first('description') : '' }}" inputValue="{{ old('description', request()->description ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=description"/>
            </div>
            <div class="col-md-1">
                <x-inputs.text inputName="subject_id" inputId="subject_id" inputLabel="{{ __('Ref Id') }}" error="{{ $errors->has('subject_id') ? $errors->first('subject_id') : '' }}" inputValue="{{ old('subject_id', request()->subject_id ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=subject_id"/>
            </div>
            <div class="col-md-3">
                <x-inputs.text inputName="subject_type" inputId="subject_type" inputLabel="{{ __('Ref Type') }}" error="{{ $errors->has('subject_type') ? $errors->first('subject_type') : '' }}" inputValue="{{ old('subject_type', request()->subject_type ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=subject_type"/>
            </div>
            <div class="col-md-2">
                <x-inputs.text inputName="user_id" inputId="user_id" inputLabel="{{ __('User') }}" error="{{ $errors->has('user_id') ? $errors->first('user_id') : '' }}" inputValue="{{ old('user_id', request()->user_id ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=user_id"/>
            </div>
            <div class="col-md-2">
                <x-inputs.text inputName="host" inputId="host" inputLabel="{{ __('Host') }}" error="{{ $errors->has('host') ? $errors->first('host') : '' }}" inputValue="{{ old('host', request()->host ?? '') }}" class="mb-3" inputAttributes="wire:change=search wire:model=host"/>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-filter"></i>
                    <span role="status">{{ __('Apply') }}</span>
                </button>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>
                        {{ trans('id') }}
                    </th>
                    <th>
                        {{ trans('Description') }}
                    </th>
                    <th>
                        {{ trans('Ref Id') }}
                    </th>
                    <th>
                        {{ trans('Ref Type') }}
                    </th>
                    <th>
                        {{ trans('User') }}
                    </th>
                    <th>
                        {{ trans('Host') }}
                    </th>
                    <th>
                        {{ trans('Created At') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @php($_offset = 1)
                @forelse($auditLogs as $item)
                    <tr data-entry-id="{{ $item->id }}">
                        <td>
                            {{ $_offset+(request()->input('page') > 1 ? (request()->input('page')-1)*100 : 0) }}
                        </td>
                        <td>
                            {{ $item->description }}
                        </td>
                        <td>
                            {{ $item->subject_id }}
                        </td>
                        <td>
                            {{ $item->subject_type }}
                        </td>
                        <td>
                            {{ $item->user->name ?? '' }}
                        </td>
                        <td>
                            {{ $item->host }}
                        </td>
                        <td>
                            {{ $item->created_at }}
                        </td>
                        <td>
                            @can('audit_log_show')
                                <a class="btn btn-outline-primary btn-sm viewDetails" href="#" role="button" data-title="{{ __('Audit Log Details') }}" data-value="{{ route('dashboard.audit-logs.show', $item->id) }}">
                                    {{-- data-bs-target="#exampleModal" --}}
                                    {{-- {{ route('dashboard.audit-logs.show', $item->id) }} --}}
                                    <i class="bi bi-eye"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                    @php($_offset++)
                    @empty
                        <tr>
                            <td colspan="8">Empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        {{-- {{ $auditLogs->links() }} --}}
    </div>
</div>

