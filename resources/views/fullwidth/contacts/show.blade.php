@extends('fullwidth.layouts.app')
@section('content')
    <div class="text-end mb-30 g-30">
        @if($contact->whatsapp)
            <a class="btn btn-info rounded-pill d-lg-none mr-10 mt-10" href="https://wa.me/{{$contact->whatsapp}}" title="{{ __('Whatsapp') }}">
            <i class="fa-brands fa-whatsapp"></i> {{ __('Whatsapp') }}
        </a>
        @endif
        @if($contact->email)
            <a class="btn btn-info rounded-pill mr-10 mt-10" href="mailto:{{$contact->email}}&subject=Tag Properties Contact" title="{{ __('Send Email') }}">
                <i class="fa-regular fa-envelope"></i> {{ __('Send Email') }}
            </a>
        @endif
        @can('call_create')
            <a class="btn btn-success rounded-pill mr-10 mt-10" href="{{route('dashboard.actions.add' , $contact->id)}}" title="{{ __('Add Action Registery') }}">
                <i class="fa-regular fa-calendar-plus"></i> {{ __('Add Action') }}
            </a>
        @endcan
        @if($contact->allowEdit)
            @can('contact_edit')
                <a class="btn btn-primary mr-10 mt-10" href="{{ route('dashboard.contacts.edit', $contact->id) }}">
                    <i class="fa fa-edit"></i> {{ __('Edit') }}
                </a>
            @endcan
            @can('contact_delete')
                <form action="{{ route('dashboard.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger mr-10 mt-10"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
                </form>
            @endcan
            @can('audit_log_access')
                <a class="btn btn-light mr-10 mt-10 viewDetails" href="#" data-title="{{ __('Activities')}}" data-value="{{ route('dashboard.contacts.index-auditlogs', ['id' => $contact->id,'class' => get_class($contact)]) }}">
                    <i class="fa fa-edit"></i> {{ __('Activities') }}
                </a>
            @endcan
        @endif
    </div>
    <div class="accordion" id="accordionShowDetails">
        <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button bg-light text-secondary d-block text-truncate px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#details" aria-expanded="true" aria-controls="details">
                <h5>{{ __('Details') }}</h5>
              </button>
            </h2>
            <div id="details" class="accordion-collapse collapse show" data-bs-parent="#accordionShowDetails">
                <div class="accordion-body">
                    <div class="row bg-white mb-30">
                        <div class="col table-responsive">
                            <table class="w-100 items-list bg-transparent">
                                <tbody>
                                    <tr class="bg-white">
                                        <th class="w-25">
                                            {{ __('Id') }}
                                        </th>
                                        <td>
                                            {{ $contact->id ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Title') }}</h5>
                                        </th>
                                        <td>
                                            {{ $contact->title ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Email') }}</h5>
                                        </th>
                                        <td>
                                            {{ $contact->email ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Mobile') }}</h5>
                                        </th>
                                        <td>
                                            {{$contact->mobile ?? ''}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Date of Birth') }}</h5>
                                        </th>
                                        <td>
                                            {{ $contact->birthday ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('LandLline') }}</h5>
                                        </th>
                                        <td>
                                            {{ $contact->landline ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Whatsapp') }}</h5>
                                        </th>
                                        <td>
                                            {{ ( $contact->whatsapp) ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Address') }}</h5>
                                        </th>
                                        <td>
                                            {{ $contact->address ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Cities') }}</h5>
                                        </th>
                                        <td>
                                            @foreach($contact->cities as $_city)
                                                <span class="badge bg-info fs-6 m-1">{{$_city->name}}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Country') }}</h5>
                                        </th>
                                        <td>
                                            {{ $country ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Preferred Languages') }}</h5>
                                        </th>
                                        <td>
                                            @foreach ($langusages_array as $language)
                                                <span class="badge bg-info fs-6 m-1">{{$language->name}}</span> 
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Interests') }}</h5>
                                        </th>
                                        <td>
                                            @foreach ($interest_tags as $tag)
                                            <span class="badge bg-info fs-6 m-1">{{$tag->name}}</span>  
                                            @endforeach
                                        </td>
                                    </tr>
                                    @if(!Auth::user()->isAgent)
                                        <tr>
                                            <th>
                                                {{ __('Agent') }}</h5>
                                            </th>
                                            <td>
                                                @foreach($contact->agents as $_agent)
                                                    <span class="badge bg-info fs-6 m-1">{{ $_agent->name }}</span>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>
                                            {{ __('Campaign') }}</h5>
                                        </th>
                                        <td>
                                            {{ $contact->campaign->name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Lead Quality') }}</h5>
                                        </th>
                                        <td>
                                            <x-lead-quality :variable="$contact"></x-lead-quality>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Lead Priority') }}</h5>
                                        </th>
                                        <td>
                                            {{ucfirst($contact->priority)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Converted Form Lead') }}
                                        </th>
                                        <td>
                                            {{ $contact->converted ? __('Yes') : __('No')}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">
                                            <h5>{{ __('Detailed Information') }}:</h5>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Occupation') }}</h5>
                                        </th>
                                        <td>
                                            {{ $contact->occupation ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Company') }}</h5>
                                        </th>
                                        <td>
                                            {{ $contact->company ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Passport') }}</h5>
                                        </th>
                                        <td>
                                            {{ $contact->passport ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Passport Expiry') }}</h5>
                                        </th>
                                        <td>
                                            {{ $contact->passport_expiry ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Passport Photocopy') }}</h5>
                                        </th>
                                        <td>
                                            @forelse($contact->getMedia('passport-photos') as $_media)
                                                <a href="{{ $_media->getUrl()}}" target="blank">
                                                    <img src="{{ $_media->getUrl()}}" alt="{{ $_media->name }}">
                                                </a>
                                            @empty
                                                {{ __('No photos') }}
                                            @endforelse
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @include('fullwidth.partials.interested-show', ['lead' => $contact])
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @include('fullwidth.partials.dates-show', ['model' => $contact])
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button bg-light text-secondary d-block text-truncate px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#comments" aria-expanded="false" aria-controls="comments">
                    <h5>{{ __('Comments') }}</h5>
                </button>
            </h2>
            <div id="comments" class="accordion-collapse collapse" data-bs-parent="#accordionShowDetails">
                <div class="accordion-body">
                    @include('fullwidth.partials.comments', ['comments' => $contact->comments ?? [], 'ref_id' => $contact->id, 'show_btn' => true])
                </div>
            </div>
        </div>
        @include('fullwidth.partials.actions-accordion-item', ['actions' => $contact->calls ?? []])
    </div>
@endsection