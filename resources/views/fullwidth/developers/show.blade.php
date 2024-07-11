@extends('fullwidth.layouts.app')
@section('content')
    <div class="text-end mb-30 g-30">
        @if($developer->allowEdit)
            @can('developer_edit')
                <a class="btn btn-primary mr-10 mt-10" href="{{ route('dashboard.developers.edit', $developer->id) }}">
                    <i class="fa fa-edit"></i> {{ __('Edit') }}
                </a>
            @endcan
            @can('developer_delete')
                <form action="{{ route('dashboard.developers.destroy', $developer->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure you want to delete this item?') }}');" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-danger mr-10 mt-10"><i class="fa fa-trash"></i> {{ __('Delete') }}</button>
                </form>
            @endcan
            @can('audit_log_access')
                <a class="btn btn-light mr-10 mt-10 viewDetails" href="#" data-title="{{ __('Activities')}}" data-value="{{ route('dashboard.developers.index-auditlogs', ['id' => $developer->id,'class' => get_class($developer)]) }}">
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
                    <div class="row table-responsive">
                        <div class="col mb-30">
                            <table class="w-100 items-list bg-transparent">
                                <tbody>
                                    @if($developer->logo)
                                        <tr>
                                            <td colspan="2">
                                                <img src="{{ $developer->logo ?? '' }}" alt="{{ $developer->name }} logo" class="w-100">
                                            </td>
                                        </tr>
                                    @endif
                                    <tr class="bg-white">
                                        <th class="w-25">
                                            {{ __('Id') }}
                                        </th>
                                        <td>
                                            {{ $developer->id }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            {{ __('Description') }}</h5>
                                        </th>
                                        <td>
                                            {{ $developer->description }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            @include('fullwidth.partials.dates-show', ['model' => $developer])
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
              <button class="accordion-button bg-light text-secondary d-block text-truncate px-4 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#projects" aria-expanded="false" aria-controls="projects">
                <h5>{{ __('Projects') }}</h5>
              </button>
            </h2>
            <div id="projects" class="accordion-collapse collapse" data-bs-parent="#accordionShowDetails">
                <div class="accordion-body">
                    <table class="w-100 table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">
                                    #
                                </th>
                                <th scope="col">
                                    {{__('id')}}
                                </th>
                                <th scope="col">
                                    {{__('Name')}}
                                </th>
                                <th scope="col">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($developer->projects as $_project)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                        <td>{{$_project->id}}</td>
                                    <td>{{$_project->name}}</td>
                                    <td>
                                        <a class="text-primary  me-4 mb-1" href="{{ route('dashboard.projects.show', $_project->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Records!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection