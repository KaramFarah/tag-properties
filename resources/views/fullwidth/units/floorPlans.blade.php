
    <div class="Container row mb-3">
        <div class="col-11">
            <h2 class="accordion-header" id="heading{{$loop_index}}">
                <button style="box-shadow:none" class="accordion-button bg-light text-secondary  text-truncate px-3 py-1" type="button" data-bs-toggle="collapse" data-bs-target="#panel{{$loop_index}}" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                  Floor [{{$floor->title ?? ''}}]
                </button>
            </h2>
            <div id="panel{{$loop_index}}" class="accordion-collapse collapse" aria-labelledby="heading{{$loop_index}}">
                <div class="accordion-body">
                        <div class="px-sm-4 py-3">
                            <div class="form-boder">
                                <div class="row g-3">
                                    <input type="hidden" name="inputs[{{$loop_index}}][id]" value="{{$floor->id}}">
                                    <div class="col">
                                        <label class="mb-20 font-fifteen font-500 w-100">Title</label>
                                        <input {{isset($readonly) ? 'readonly' : ''}} value="{{ old('inputs[$loop_index][title]', $floor->title ?? '') }}" type="text" name="inputs[{{$loop_index}}][title]" class="form-control">
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">   
                                        <label class="mb-20 font-fifteen font-500 w-100">{{__('Masted Bed')}}</label>
                                        <input {{isset($readonly) ? 'readonly' : ''}} type="text" name="inputs[{{$loop_index}}][master_bed]" class="form-control" value="{{ old('inputs[$loop_index][master_bed]', $floor->master_bed ?? '') }}" >
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label class="mb-20 font-fifteen font-500 w-100  ">Kitchen</label>
                                        <input {{isset($readonly) ? 'readonly' : ''}} type="text" name="inputs[{{$loop_index}}][kitchen]" class="form-control" value="{{ old('inputs[$loop_index][kitchen]', $floor->kitchen ?? '') }}" >
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label class="mb-20 font-fifteen font-500 w-100  ">Dining</label>
                                        <input {{isset($readonly) ? 'readonly' : ''}} type="text" name="inputs[{{$loop_index}}][dining]" class="form-control " value="{{ old('inputs[$loop_index][dining]', $floor->dining ?? '') }}" >
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <label class="mb-20 font-fifteen font-500 w-100  ">Baths</label>
                                        <input {{isset($readonly) ? 'readonly' : ''}} type="text" name="inputs[{{$loop_index}}][baths]" class="form-control" value="{{ old('inputs[$loop_index][baths]', $floor->baths ?? '') }}" >
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <label class="mb-20 font-fifteen font-500 w-100  ">Storage</label>
                                        <input {{isset($readonly) ? 'readonly' : ''}} type="text" name="inputs[{{$loop_index}}][storage]" class="form-control" value="{{ old('inputs[$loop_index][storage]', $floor->storage ?? '') }}"  >
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <label class="mb-20 font-fifteen font-500 w-100  ">Space</label>
                                        <input {{isset($readonly) ? 'readonly' : ''}} value="{{ old('inputs[$loop_index][space]', $floor->space ?? '') }}" type="text" name="inputs[{{$loop_index}}][space]" class="form-control "   >
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-12">
                                        <label class="{{isset($readonly) ? 'd-none' : ''}} mb-20 font-fifteen font-500 w-100">Attachment</label>
                                        <label class="{{isset($readonly) ? 'd-none' : ''}} btn btn-secondary float-start w-100">
                                            {{--  --}}
                                            <input name="inputs[{{$loop_index}}][floor_photos][]" type="file" class="d-none" multiple>Select Attachment</label>
                                    </div>
                                    <div class="col-xl-8 col-lg-6 col-md-12">
                                        @if (isset($floor->thumbImage))
                                            <ul class="row row-cols-xl-6 row-cols-md-3 row-cols-2 media-upload">                 
                                                @foreach($floor->thumbImage as $_media)
                                                    <li class="col" id="{{ $_media->id }}">
                                                        <img src="{{ $_media->getUrl('thumb')}}" class="rounded pb-30" alt="{{ $_media->name }}">
                                                   
                                                        <a  parent-id="{{ $_media->id }}" data-value="{{isset($readonly) ? '' : route('dashboard.units.deleteMedia' , $_media)}}" class=" {{isset($readonly) ? 'd-none' : 'delete-image'}}"><i class="fas fa-trash"></i></a>
                                                    </li>
                                                @endforeach 
                                            </ul>   
                                        @endif
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 mt-4">
                                        <x-inputs.textarea inputName="inputs[{{$loop_index}}][description]" inputId="{{$loop_index}}" inputLabel="{{ __('Description') }}" inputRequired="" inputValue="{{ old('inputs[$loop_index][description]', $floor->description ?? '') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        @if (!isset($readonly))
            <div class="col-1 d-flex align-items-center">
                <div>
                    <button {{(!is_Null($floor->id)) ? ('parent-id=' . $loop_index . 'floor data-value=' . route('api.floors.destroy' , $floor)) : ''}}  type="button" class="btn btn-outline-danger {{(!is_Null($floor->id)) ? 'delete-floor' : 'remove-floor'}}"><i class="fas fa-trash"></i></button>
                </div>
            </div>         
        @endif
    </div>

