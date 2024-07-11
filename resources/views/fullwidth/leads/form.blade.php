<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
                <input type="hidden" name="is_lead" value="yes">
                <div class="row">
                    <div class="col">
                        <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" inputRequired="required" inputValue="{{ old('name', $lead->name ?? '') }}" inputHint="" inputClass="required" class="mb-30" type="text"/>
                    </div>
                    <div class="col">
                        <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" inputRequired="required" inputValue="{{ old('email', $lead->email ?? '') }}" inputHint="" inputClass="required" class="mb-30" type="text" />
                    </div>
                    <div class="col">
                        <x-inputs.text inputAttributes="maxlength=10" inputName="mobile" inputId="mobile" inputLabel="{{ __('Mobile') }}" inputRequired="required" inputValue="{{ old('mobile', $lead->mobile ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <x-inputs.select inputName="cities[]" inputId="cities" inputLabel="{{ __('Cities') }}" placeholder="{{ __('Select Cities') }}" :inputValue="old('cities',  $lead->cities ?? '')" :inputData="$cities" inputClass="select2 mb-30" inputType="multiple"/>
                    </div>
                    <div class="col">
                       @include('fullwidth.partials.countries', ['selected_country' => $lead->country])
                    </div>
                    <div class="col">
                        <x-inputs.select inputName="language_tags[]" inputId="preferred_languages" inputLabel="{{ __('Preferred Languages') }}" placeholder="{{ __('Select Languages') }}" inputRequired="" :inputValue="old('language_tags[]',  $langusages_array ??  $lead->tags)" :inputData="$languages" inputClass="select2 mb-30" inputType="multiple" showButtons="false"/>
                    </div>
                    </div>
                    <div class="row">

                        {{-- @can('tag_create')
                            <div class="col-1">
                                <a class="btn btn-light mt-4" id="openModelAddNewCenters" type="button" data-bs-toggle="modal" data-bs-target="#addTagModal" style="display:inline-block"><i class="fa fa-plus"></i></a>                        
                            </div>
                        @endcan  --}}
                    </div>
                <div class="row mb-30">
                    <div class="col">
                        <label class="form-label required" for="developers">{{ __('Campaign') }}</label>
                        <div class="input-group mb-3">
                            <select class="form-select {{ $errors->has('campaign_id') ? 'is-invalid' : '' }}" name="campaign_id" placeholder="{{ __('Campaign') }}" id="campaign_id" class="select2" required>
                                @foreach($campaigns as $id => $item)
                                    <option value="{{ $id }}"{{(old('campaign_id') == $id) ? 'selected' : (($lead->campaign->id ?? '-1') == $id ? ' selected' : '') }}>{{ $item }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('campaign_id'))
                                <span class="text-danger">{{ $errors->first('campaign_id') }}</span>
                            @endif
                            @can('campaign_create')
                                <button class="btn btn-light" id="openModelAddNewCenters" type="button" data-bs-toggle="modal" data-bs-target="#addCampaignModal"><i class="fa fa-plus"></i></button>
                            @endcan
                        </div>
                    </div>
                    
                    @if(!Auth::user()->isAgent)
                        <div class="col">
                            <x-inputs.select inputName="agents[]" inputId="agents" inputLabel="{{ __('Agents') }}" placeholder="{{ __('Select Agents') }}" :inputValue="old('agents',  $lead->agents)" :inputData="$agents" inputClass="select2 mb-30" inputType="multiple"/>
                        </div>
                    @else
                        <input type="hidden" value="{{ Auth::user()->id }}" name="agents[]">
                    @endif
                </div>
                <div class="row">

                </div>
                {{-- <input class="form-check-input " type="checkbox" id="myCheckbox" onchange="toggleDisplay()">
                <label for="myCheckbox">
                    Default checkbox
                </label> --}}
                
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-4">{{ __('Internal Details') }}</h4>
            <div class="row mb-30 pb-30 border-bottom">
                <div class="col-md-6">
                    <x-inputs.select inputName="lead_quality" inputId="lead_quality" inputLabel="{{ __('Lead Quality') }}" placeholder="{{ __('Select Lead Quality') }}" showButtons="false" inputRequired="required" :inputValue="old('lead_quality') ?? $lead->lead_quality" :inputData="$LeadQuality" inputHint="" inputClass="select2"/>
                </div>
                <div class="col-md-6">
                    <x-inputs.select inputName="priority" inputId="priority" inputLabel="{{ __('Priority') }}" placeholder="{{ __('Select Priority') }}" showButtons="false" inputRequired="required" :inputValue="old('priority') ?? $lead->priority" :inputData="$leadPriority" inputHint="" inputClass="select2"/>
                </div>
            </div>
            @include('fullwidth.partials.interested')
        </div>
    </div>
</div>

<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            @include('fullwidth.partials.comments', ['comments' => $lead->comments ?? [], 'ref_id' => $lead->id])
        </div>
    </div>
</div>

<button class="btn btn-primary" type="submit">
    <i class="bi bi-save"></i> {{ __('Save') }}
</button>
<a class="btn btn-secondary" href="{{ route('dashboard.leads.index') }}">{{ __('Close') }}</a>


@include('fullwidth.modals.tagsModal')
@include('fullwidth.modals.compaignsModal')
@can('tag_create')
    @push('scripts')
        <script>
            $(document).ready(function () {
                $("#tags").select2({
                    tags: true,
                    width: '100%'
                })
                $("#preferred_languages").select2({
                    tags: true,
                    width: '100%'
                })
                $("#cities").select2({
                    tags:true,
                })
            }) 
        </script>
    @endpush
@endcan