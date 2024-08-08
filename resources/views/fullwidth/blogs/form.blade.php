<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            @section('styles')
                <script src="{{ asset('assets/fullwidth/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
                <script>
                    tinymce.init({
                        selector: '#content'
                    });
                </script>
            @endsection
            <x-inputs.text inputName="title" inputId="title" inputLabel="{{ __('Title') }}" inputRequired="required" inputValue="{{ old('title', $blog->title ?? '') }}" inputHint="" inputClass="mb-30" class=""/>
            {{-- <x-inputs.text inputName="description" inputId="description" inputLabel="{{ __('Description') }}" inputRequired="required" inputValue="{{ old('description', $blog->description ?? '') }}" inputHint="" inputClass="" class="mb-30"/> --}}
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.text inputName="description" inputId="description" inputLabel="{{ __('Description') }}" inputRequired="required" inputValue="{{ old('description', $blog->description ?? '') }}" inputHint="" inputClass="" class="mb-30"/>
                    {{-- <x-inputs.text inputName="link" inputId="link" inputLabel="{{ __('Link') }}" inputRequired="" inputValue="{{ old('link', $blog->link ?? '') }}" inputHint="" inputClass="" class="mb-30" type="text"/> --}}
                </div>
                <div class="col-md-6 mb-3">
                    <div class="input-group ">
                        <x-inputs.select inputName="tags[]" inputId="tags" inputLabel="{{ __('Categories') }}" inputRequired="required" :inputValue="old('tags', $blog->tags ?? '')" :inputData="$tags" class="mb-3 w-75" inputType="multiple" showButtons="false" inputClass="select2" />
                        
                        @can('tag_create')
                            <button style="height: max-content;" class="btn btn-light ms-1 mt-4" id="openModelAddNewCenters" type="button" data-bs-toggle="modal" data-bs-target="#addTagModal"><i class="fa fa-plus"></i></button>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col mb-30">
                    <x-inputs.textarea inputName="content" inputId="content" inputLabel="{{ __('Content') }}" error="{{ $errors->has('content') ? $errors->first('content') : '' }}"  showButtons="false" inputValue="{!! old('content', $blog->content ?? '') !!}" inputClass=""  />
                </div>
                <div class="mb-30">
                    <ul class="row row-cols-xl-6 row-cols-md-3 row-cols-2 media-upload">
                        @if (isset($blog->thumbImages))              
                            @foreach($blog->thumbImages as $_media)
                                <li class="col" id="{{ $_media->id }}">
                                    <img src="{{ $_media->getUrl('thumb')}}" class="rounded pb-30" alt="{{ $_media->name }}">
                                    <a href="#" ><i class="fas fa-trash"></i></a>
                                    <a parent-id="{{ $_media->id }}" data-value="{{route('dashboard.units.deleteMedia' , $_media)}}" class="delete-image"><i class="fas fa-trash"></i></a>
                                </li>
                            @endforeach    
                        @endif
                    </ul>
                </div>
                <div class="col-md-12 mb-30">
                    <label for="photos">{{__('PHOTO')}}</label>
                    <input type="file" id="photos" name="photos[]" class="form-control" multiple>
                </div> 
            </div>
            <div class="row">
                <div class="col-md-6">
                    <x-inputs.select inputName="user_id" inputId="user_id" inputLabel="{{ __('Author') }}" placeholder="" inputRequired="required" :inputValue="$blog->user_id" :inputData="$users" inputHint="" inputClass="form-select required" class="mb-3" showButtons="false" />
                </div>
                <div class="col-md-6">
                    <x-inputs.text inputName="publish_date" inputId="publish_date" inputLabel="{{ __('Publish Date') }}" inputRequired="required" inputValue="{{old('publish_date') ?? $blog->publish_date}}" inputHint="" inputClass="form-select" class="mb-30" type="date"/>
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-primary" type="submit">
    <i class="bi bi-save"></i> {{ __('Save') }}
</button>
<a class="btn btn-secondary" href="{{ route('dashboard.blogs.index') }}">{{ __('Close') }}</a>
@can('tag_create')
    <div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addTagModalLabel">{{ __('Add New Tag')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <x-inputs.text inputName="tag_name" inputId="tag_name" inputLabel="{{ __('Name') }}" inputRequired="" inputValue="{{ old('tag_name', '') }}" inputHint="" inputClass="mb-30" type="text"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="saveTag" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Add') }}</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>  
            $(document).ready(function() {
                var tag_name = $('#tag_name');
                $('#saveTag').on('click', function(event) {
                    $.ajax({
                        url: '{{ route('api.tags.store') }}',
                        type: "POST",
                        data: { 
                            name:tag_name.val(),
                            type:'blog',
                            
                        },
                        success: function(response) {
                            console.log(response.data)
                            var newOption = new Option(response.data.name, response.data.id, false, false)
                            $('#tags').append(newOption).trigger('change')
                            alert('Added')
                            tag_name.val(' ')
                        },
                        error: function (request, status, error) {
                            alert('Error!')
                            console.log("request: "+request.toJSON())
                            console.log("status: "+status)
                            console.log("error: "+error)
                        }
                    });
                    event.preventDefault();
                    return false;
                });
            });
        </script>
    @endpush
@endcan