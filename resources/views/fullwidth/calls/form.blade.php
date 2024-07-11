<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <div class="row mb-30">
                <div class="col-md-4">
                    <label for="date" class="required mb-10">{{__('Date')}}</label>
                    <input class="form-control" type="text" name="date" id="date" value="{{old('date', $action->date )}}" required>
                    @error('date')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <x-inputs.select inputName="type" inputId="type" inputLabel="{{ __('Action Type') }}" error="{{ $errors->has('type') ? $errors->first('type') : '' }}" :inputData="$type" showButtons="false" inputValue="{{ old('type', $action->type ?? '') }}" inputClass="required select2" inputRequired="required"/>
                </div>
                <div class="col-md-4">
                    <x-inputs.select inputName="status" inputId="status" inputLabel="{{ __('Status') }}" error="{{ $errors->has('status') ? $errors->first('status') : '' }}" :inputData="$status" showButtons="false" inputValue="{{ old('status', $action->status ?? '') }}" inputClass="required select2" inputRequired="required"/>
                </div>
            </div>
            <div class="row mb-30">
                @if (!auth()->user()->isAgent)
                    <div class="col-md-6">
                        <label class="form-label" for="developers">{{ __('Agent') }}</label>
                        <div class="input-group">
                            <select class="select2 {{ $errors->has('agent_id') ? 'is-invalid' : '' }}" name="agent_id" placeholder="{{ __('Agent') }}" id="agent_id">
                                @foreach($agents as $id => $item)
                                    <option value="{{ $id }}"{{(old('agent_id') == $id) ? 'selected' : (($action->agent->id ?? '-1') == $id ? ' selected' : '') }}>{{ $item }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('agent_id'))
                                <span class="text-danger">{{ $errors->first('agent_id') }}</span>
                            @endif
                        </div>
                    </div>
                @else
                    <input type="hidden" name="agent_id" value="{{Auth::user()->id}}">
                @endif
                <div class="col">
                    <x-inputs.select inputName="contact_id" inputId="contact_id" inputRequired="required" inputLabel="{{ __('Contact') }}" :inputData="$contacts" showButtons="false" inputValue="{{ old('contact_id',  $action->contact_id ?? '') }}" inputClass="select2" class="w-100"/>
                    {{-- <div class="d-flex align-items-end">
                        <x-inputs.select inputName="contact_id" inputId="contact_id" inputRequired="required" inputLabel="{{ __('Contact') }}" :inputData="$contacts" showButtons="false" inputValue="{{ old('contact_id',  $action->contact_id ?? '') }}" inputClass="select2" class="w-100"/>
                        @can('lead_create')
                            <button class="btn btn-light ms-10 h-75" id="openModelAddNewLead" type="button" data-bs-toggle="modal" data-bs-target="#addLeadModal"><i class="fa fa-plus"></i></button>                            
                        @endcan 
                    </div> --}}
                    
                </div>
            </div>
            <x-inputs.text inputName="topic" inputId="topic" inputLabel="{{ __('Topic') }}" inputValue="{{ old('topic', $action->topic ?? '') }}"  class="mb-30" />
            <x-inputs.textarea inputName="summary" inputId="summary" inputLabel="{{ __('Feedback') }}" inputValue="{{ old('summary', $action->summary ?? '') }}" inputHint="" class="mb-30"/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-4">{{ __('Internal Details') }}</h4>
            @include('fullwidth.partials.interested')
        </div>
    </div>
</div>
<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            @include('fullwidth.partials.comments', ['comments' => $action->comments, 'call_id' => $action->id])
        </div>
    </div>
</div>
<button class="btn btn-primary pe-10" type="submit"><i class="bi bi-save"></i> {{ __('Save') }}</button>
<a class="btn btn-secondary" href="{{ route('dashboard.actions.index') }}">{{ __('Close') }}</a>


{{-- @can('lead_create')
    @include('fullwidth.modals.leadsModal')
@endcan --}}

@push('scripts')
<script>
    flatpickr("#date", {
        enableTime: true,
        dateFormat: "Y/m/d H:i",
        time_24hr: true,
        minuteIncrement: 1,
        defaultHour: 0,
        defaultMinute: 0,
        noSeconds: true,
    });
</script>
@endpush
@can('tag_create')
    @push('scripts')
        <script>
            $(document).ready(function () {
                $("#tags").select2({
                    tags: true,
                    width: '100%'
                });
            }) 
        </script>
    @endpush
@endcan