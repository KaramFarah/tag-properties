@section('styles')
<style>
body {
  background: #eee;
}

#select2-us-states-results img {
  border-radius: 0.4rem;
}
</style>
@endsection
<input type="hidden" name="is_lead" value="no">
<div class="row mb-30">
    <div class="col">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-30">{{ _('Basic Information') }}</h4>
            <input type="hidden" name="forward" value="form">
            <input type="hidden" name="converted" value="{{isset($converted) ? $converted : 0}}">
            <div class="row mb-30">
                <div class="col-lg-2">
                    <x-inputs.text inputName="title" inputId="title" inputLabel="{{ __('Title') }}" inputValue="{{ old('title', $contact->title ?? '') }}"  />
                </div>
                <div class="col-lg">
                    <x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" inputRequired="required" inputValue="{{ old('name', $contact->name ?? '') }}" inputClass="required" />
                </div>
                <div class="col-lg">
                    <x-inputs.text inputName="email" inputId="email" inputLabel="{{ __('Email') }}" inputRequired="required" inputValue="{{ old('email', $contact->email ?? '') }}" inputClass="required" />
                </div>
            </div>
            <div class="row mb-30">
                <div class="col-lg">
                    <x-inputs.text inputAttributes="maxlength=15" inputName="landline" inputId="landline" inputLabel="{{ __('Landline') }}" inputValue="{{ old('landline', $contact->landline ?? '') }}" />
                </div>
                <div class="col-lg">
                    <x-inputs.text  inputAttributes="maxlength=15" inputName="mobile" inputId="mobile" inputLabel="{{ __('Mobile') }}" inputRequired="required" inputValue="{{ old('mobile', $contact->mobile ?? '') }}" inputClass="required" maxlength="15"   pattern="[0-9]*" />
                </div>
                <div class="col-lg">
                    <x-inputs.text  inputAttributes="maxlength=15" inputName="whatsapp" inputId="whatsapp" inputLabel="{{ __('Whatsapp') }}" inputValue="{{ old('whatsapp', $contact->whatsapp ?? '') }}" maxlength="15"  pattern="[0-9]*" />
                </div>
            </div>
            <div class="row mb-30">
                <div class="col-lg">
                    <x-inputs.text inputName="address" inputId="address" inputLabel="{{ __('Address') }}" inputValue="{{ old('address', $contact->address ?? '') }}" />
                </div>
                <div class="col-lg">
                    <x-inputs.select inputName="cities[]" inputId="cities" inputLabel="{{ __('Cities') }}" placeholder="{{ __('Select Cities') }}" :inputValue="old('cities',  $contact->cities ?? '')" :inputData="$cities" inputClass="select2 mb-30" inputType="multiple"/>
                    {{-- <x-inputs.text inputName="city" inputId="city" inputLabel="{{ __('City') }}" inputValue="{{ old('city', $contact->city ?? '') }}" /> --}}
                </div>
                <div class="col-lg">
                    @include('fullwidth.partials.countries', ['selected_country' => $contact->country])
                </div>
            </div>
            <div class="row mb-30">
                <div class="col-lg">
                    <x-inputs.select inputName="language_tags[]" inputId="preferred_languages" inputLabel="{{ __('Preferred Languages') }}" placeholder="{{ __('Select Languages') }}" :inputValue="old('language_tags[]',  $langusages_array ??  $contact->tags)" :inputData="$languages" inputClass="select2" inputType="multiple" showButtons="false"/>
                </div>
                <div class="col-lg">                        
                    <x-inputs.text inputName="birthday" inputId="birthday" inputLabel="{{ __('Birthday') }}" inputValue="{{ old('birthday', $contact->birthday ?? '') }}" inputClass="date" />                        
                </div>
            </div>
            <div class="row mb-30">
                <div class="col-lg">
                    <label class="form-label required" for="developers">{{ __('Campaign') }}</label>
                    <div class="input-group">
                        <select class="form-select {{ $errors->has('campaign_id') ? 'is-invalid' : '' }}" name="campaign_id" placeholder="{{ __('Campaign') }}" id="campaign_id" required>
                            @foreach($campaigns as $id => $item)
                                <option value="{{ $id }}"{{(old('campaign_id') == $id) ? 'selected' : (($contact->campaign->id ?? '-1') == $id ? ' selected' : '') }}>{{ $item }}</option>
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
                        <x-inputs.select inputName="agents[]" inputId="agents" inputLabel="{{ __('Agents') }}" placeholder="{{ __('Select Agents') }}" :inputValue="old('agents',  $contact->agents)" :inputData="$agents" inputClass="select2" inputType="multiple"/>
                    </div>
                @else
                    <input type="hidden" value="{{ Auth::user()->id }}" name="agents[]">
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col-lg">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-30">Detailed Information</h4>
            <div class="row">
                <div class="col-lg">
                    <x-inputs.text inputName="passport" inputId="passport" inputLabel="{{ __('Passport') }}" inputValue="{{ old('passport', $contact->passport ?? '') }}" />
                </div>
                <div class="col-lg">
                    <x-inputs.text inputName="passport_expiry" inputId="passport_expiry" inputLabel="{{ __('Passport Expiry') }}" inputValue="{{ old('passport_expiry', $contact->passport_expiry ?? '') }}" type="date"/>
                </div>   
            </div>
            <div class="row mb-30">
                <div class="col-lg">
                    <label for="photos">Passport Photocopy</label>
                    <input type="file" id="photos" name="photos[]" class="form-control" multiple>
                </div>
            </div>
            <div class="row mb-30">
                <div class="col-md">
                    <x-inputs.text inputName="occupation" inputId="occupation" inputLabel="{{ __('Occupation') }}" inputValue="{{ old('occupation', $contact->occupation ?? '') }}" />
                </div>
                <div class="col-md">
                    <x-inputs.text inputName="company" inputId="company" inputLabel="{{ __('Company') }}" inputValue="{{ old('company', $contact->company ?? '') }}" />
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-4">{{ __('Internal Details') }}</h4>
            <div class="row mb-30 pb-30 border-bottom">
                <div class="col-lg-4">
                    <ul class="row row-cols-lg-3 row-cols-1 custom-check-box mb-30">
                        <li class="col">
                            <input type="checkbox" class="custom-control-input hide" id="availability" name="converted_display" value="1" {{ $contact->converted || (isset($converted) && $converted) ? 'checked' : ''}}>
                            <label class="custom-control-label" for="converted-display">{{ __('Converted') }}</label>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <x-inputs.select inputName="lead_quality" inputId="lead_quality" inputLabel="{{ __('Lead Quality') }}" placeholder="{{ __('Select Lead Quality') }}" showButtons="false" :inputValue="old('lead_quality', $contact->lead_quality)" :inputData="$LeadQuality" inputClass="select2"/>
                </div>
                <div class="col-lg-4">
                    <x-inputs.select inputName="priority" inputId="priority" inputLabel="{{ __('Priority') }}" placeholder="{{ __('Select Priority') }}" showButtons="false" :inputValue="old('priority', $contact->priority)" :inputData="$leadPriority" inputClass="select2"/>
                </div>
            </div>
            @include('fullwidth.partials.interested', ['lead' => $contact])
        </div>
    </div>
</div>
<div class="row mb-30">
    <div class="col">
        <div class="border rounded bg-white p-30">
            @include('fullwidth.partials.comments', ['comments' => $contact->comments ?? [], 'ref_id' => $contact->id])
        </div>
    </div>
</div>
<button class="btn btn-primary" type="submit">
    <i class="bi bi-save"></i> {{ __('Save') }}
</button>
<a class="btn btn-secondary" href="{{ route('dashboard.contacts.index') }}">{{ __('Close') }}</a>
@include('fullwidth.modals.tagsModal')
@include('fullwidth.modals.compaignsModal')
@can('tag_create')
    @push('scripts')
        <script>
            $(document).ready(function () {
                $("#tags").select2({
                    tags: true
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