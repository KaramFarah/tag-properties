@extends('fullwidth.layouts.app')
@section('content')
    <div class="text-end mb-30 g-30">
        @if($career->allowEdit)
            @can('contact_edit')
                <a class="btn btn-primary mr-10 mt-10" href="{{ route('dashboard.careers.edit', $career->id) }}">
                    <i class="fa fa-edit"></i> {{ __('Edit') }}
                </a>
            @endcan
            @can('contact_delete')
                <form action="{{ route('dashboard.careers.destroy', $career->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger mr-10 mt-10"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
                </form>
            @endcan
            @can('audit_log_access')
                <a class="btn btn-light mr-10 mt-10 viewDetails" href="#" data-title="{{ __('Activities')}}" data-value="{{ route('dashboard.careers.index-auditlogs', ['id' => $career->id,'class' => get_class($career)]) }}">
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
                                            {{ $career->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Employment Type') }}</h5>
                                        </th>
                                        <td>
                                            {{ $career->employment_type }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Expiry Date') }}</h5>
                                        </th>
                                        <td>
                                            {{ $career->expiry_date ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Requirements') }}</h5>
                                        </th>
                                        <td>
                                            {{ $career->requirements ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Qualifications') }}</h5>
                                        </th>
                                        <td>
                                            {{ $career->qualifications ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Job Description') }}</h5>
                                        </th>
                                        <td>
                                            {{ $career->job_description ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @include('fullwidth.partials.dates-show', ['model' => $career])
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
                <button class="accordion-button bg-light text-secondary d-block text-truncate px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#cvs" aria-expanded="false" aria-controls="cvs">
                    <h5>{{ __('CVs') }}</h5>
                </button>
            </h2>
            <div id="cvs" class="accordion-collapse collapse" data-bs-parent="#accordionShowDetails">
                <div class="accordion-body">
                    <div class="row bg-white mb-30">
                        <div class="col table-responsive">
                            <table class="w-100 items-list bg-transparent table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Birthday</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Residence</th>
                                        <th scope="col">Nationality</th>
                                        <th scope="col">CV</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($career->careerCvs as $_cv)
                                        <tr>
                                            <th scope="col">{{$_cv->name}}</th>
                                            <td>{{$_cv->email}}</td>
                                            <td>{{$_cv->birthday}}</td>
                                            <td>{{$_cv->city}}</td>
                                            <td>{{$countries[$_cv->residence]}}</td>
                                            <td>{{$countries[$_cv->nationality]}}</td>
                                            <td>
                                                @forelse($_cv->cv as $_file)
                                                    <p><a href="{{ $_file->getUrl() }}" class="primary-link" target="blank"><i class="fa-regular fa-file pe-1"></i>{{ $_file->name }} ({{ $_file->mime_type }})</a></p>
                                                @empty
                                                    <span>No Cv</span>
                                                @endforelse
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection