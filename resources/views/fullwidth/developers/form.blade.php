<x-inputs.text inputName="name" inputId="name" inputLabel="{{ __('Name') }}" inputRequired="required" inputValue="{{ old('name', $developer->name ?? '') }}" class="mb-30"/>
<x-inputs.textarea inputName="description" inputId="description" inputLabel="{{ __('Description') }}" inputRequired="" inputValue="{{ old('description', $developer->description ?? '') }}" class="mb-30"/>
<div class="row">
    <div class="col mb-30">
        <div class="border rounded bg-white p-30">
            <h4 class="mb-4">{{ __('Logo') }}</h4>
            <p>{{ __('Developer Logo') }}</p>
            <div class="form-row">        
                @if($developer->logo)
                    <div class="col mt-20">
                        <ul class="row row-cols-xl-6 row-cols-md-3 row-cols-2 media-upload">
                            <li class="col" id="{{ $developer->logoMedia->id }}">
                                <img src="{{ $developer->logo }}" class="rounded pb-30" alt="Developer Logo">
                                <a href="#" parent-id="{{ $developer->logoMedia->id }}" data-value="{{route('dashboard.units.deleteMedia' , $developer->logoMedia)}}" class="delete-image"><i class="fas fa-trash"></i></a>
                            </li>
                        </ul>
                    </div>
                @endif
                <div class="col mb-20">
                    <input type="file" id="logo" name="logo" class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}">
                    {{-- <label class="fileupload_label border rounded font-large" for="logo">Drop your photos here or Click</label> --}}
                    @if($errors->has('logo'))
                        <span class="text-danger">{{ $errors->first('logo') }}</span>
                    @endif
                </div>
            </div>
            <small>Best image format is 820x550 jpg</small>
        </div>
    </div>
</div>
<button class="btn btn-primary" type="submit"><i class="bi bi-save"></i> {{ __('Save') }}</button>
<a class="btn btn-secondary" href="{{ route('dashboard.developers.index') }}">{{ __('Close') }}</a>

@push('scripts')
    <script>
        $(document).ready(function(){
            $("#cities").select2({
                // tags:true,
            })
        });
    </script>


    <script>
        $(document).ready(function() {
            $('.delete-image').on('click', function(event) {
                swal.fire({
                        title: "Are you sure?",
                        text: "You'r About To Delete This Record",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#808080",
                        confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        let delete_url = $(this).attr('data-value')
                        let liId = $(this).attr('parent-id')
                        $.ajax({
                            type: "DELETE",
                            url: delete_url,
                            success: function(response) {
                                console.log(response.data)
                                $('#' + liId).remove();
                            },
                            error: function (request, status, error) {
                                alert('Error!')
                                console.log("request: "+request.toJSON())
                                console.log("status: "+status)
                                console.log("error: "+error)
                            }
                        });
                        event.preventDefault();
                            swal.fire({
                                title: "Deleted!",
                                text: "Your Record has been deleted.",
                                icon: "success"
                            });
                        }
                    });
                return false;
            });
        });
    </script>
@endpush

{{-- @push('scripts')
    <script>
        // Dropzone.options.createDevelloper = { // camelized version of the `id`
        // paramName: "logo", // The name that will be used to transfer the file
        // maxFilesize: 2, // MB
        // // accept: function(file, done) {
        // //     if (file.name == "justinbieber.jpg") {
        // //     done("Naha, you don't.");
        // //     }
        // //     else { done(); }
        // // }
        // };
    </script>
@endpush --}}