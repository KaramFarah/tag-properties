<div>
    <div class="bg-white p-30">
        <div class="row">
            <div class="col-xl">
                <form class="form-boder" wire:submit.prevent="search">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <x-inputs.text inputName="description" inputId="description" inputLabel="{{ __('Description') }}" error="{{ $errors->has('description') ? $errors->first('description') : '' }}" inputValue="{{ old('description', request()->description ?? '') }}" inputAttributes="wire:change=search wire:model=description"/>
                        </div>
                        <div class="col-md-1">
                            <x-inputs.text inputName="subject_id" inputId="subject_id" inputLabel="{{ __('Ref Id') }}" error="{{ $errors->has('subject_id') ? $errors->first('subject_id') : '' }}" inputValue="{{ old('subject_id', request()->subject_id ?? '') }}" inputAttributes="wire:change=search wire:model=subject_id"/>
                        </div>
                        <div class="col-md-3">
                            <x-inputs.text inputName="subject_type" inputId="subject_type" inputLabel="{{ __('Ref Type') }}" error="{{ $errors->has('subject_type') ? $errors->first('subject_type') : '' }}" inputValue="{{ old('subject_type', request()->subject_type ?? '') }}" inputAttributes="wire:change=search wire:model=subject_type"/>
                        </div>
                        <div class="col-md-2">
                            <x-inputs.text inputName="user_id" inputId="user_id" inputLabel="{{ __('User') }}" error="{{ $errors->has('user_id') ? $errors->first('user_id') : '' }}" inputValue="{{ old('user_id', request()->user_id ?? '') }}" inputAttributes="wire:change=search wire:model=user_id"/>
                        </div>
                        <div class="col-md-2">
                            <x-inputs.text inputName="host" inputId="host" inputLabel="{{ __('Host') }}" error="{{ $errors->has('host') ? $errors->first('host') : '' }}" inputValue="{{ old('host', request()->host ?? '') }}" inputAttributes="wire:change=search wire:model=host"/>
                        </div>
                        <div class="col-md-2">
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
        <table class="table w-100 items-list bg-transparent">
            <thead>
                <tr class="bg-white">
                    <th>Activity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php($_offset = 1)
                @forelse($auditLogs as $_item)
                    <tr data-entry-id="{{ $_item->id }}">
                        <td>
                            {!! $_item->activity !!}
                        </td>
                        <td>
                            @can('audit_log_show')
                                <a class="text-primary me-4 viewDetails" href="#" role="button" data-title="{{ __('Activity Log') }}" data-value="{{ route('dashboard.audit-logs.show', $_item->id) }}">
                                    <i class="fa fa-eye"></i>
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