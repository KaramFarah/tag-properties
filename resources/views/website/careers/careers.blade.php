@extends('website.layout.app-blog')
@section('pageTitle', $local_title . ' | ' . config('panel.site_title'))
@section('content')
    <!--============== Page title Start ==============-->
    @include('website.layout.title-banner')

    <div class="full-row bg-light py-5">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-md-8">
                    <span class="text-secondary font-italic h5">Think you're good enough? Do you like our projects and want to be the part of our team? If you can handle this, just apply for right position!</span>
                    @if (!$careers->count())
                        <p>No Careers avaibale</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if ($careers->count())
        @foreach ($careers as $career)
            <div class="border p-4 m-5">
                <div class="full-row bg-light pt-0">
                    <div class="container">
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <div class="border-end">
                                    <h5 class="text-primary mb-1">{{ $career->job_title }}</h5>
                                </div>
                            </div>
                            <div class="col-md-8 offset-md-1">
                                <h5 class="text-secondary mb-2">{{__('Description')}}:</h5>
                                <p>{{$career->job_description}}</p>
                                <h5 class="text-secondary mb-2">{{__('Qualification')}}:</h5>
                                <p>{{$career->qualifications}}</p>
                                <h5 class="text-secondary mb-2">{{__('Reuirements')}}:</h5>
                                <p>{{$career->requirements}}</p>
                                <div class="row row-cols-md-2 row-cols-1">
                                    <div class="col">
                                        <h5 class="text-secondary mb-2">{{__('Job Type')}}:</h5>
                                        <p>{{$career->employment_type}}</p>
                                    </div>
                                    <div class="col">
                                        <h5 class="text-secondary mb-2">{{__('Expiry Date')}}:</h5>
                                        <p>{{$career->expiry_date}}</p>
                                    </div>
                                </div>
                                {{-- <button type="button" class="btn btn-secondary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal{{$loop->index}}">Download Details</button> --}}
                                <a href="{{route('apply-careers' , ['career' => $career->id])}}" class="btn btn-secondary mt-3">{{ __('Apply') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

{{-- 

            <div class="modal fade" id="exampleModal{{$loop->index}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">




                        <div class="col-md-7 order-md-1">
                            <h4 class="down-line mb-4">Send Message</h4>
                            <div class="form-simple">
                                
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
            </div> --}}




{{-- 
            <div class="modal-dialog modal-dialog-scrollable" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
        
                        <div class="col-md-7 order-md-1">
                            <h4 class="down-line mb-4">Send Message</h4>
                            <div class="form-simple">
                                <form id="contact-form" action="#" method="post" novalidate="novalidate">
                                    <div class="row">
                                        <div class="col-md-6 mb-20">
                                            <label class="mb-2">Full Name:</label>
                                            <input type="text" class="form-control bg-white" name="name" required="">
                                        </div>
                                        <div class="col-md-6 mb-20">
                                            <label class="mb-2">Your Email:</label>
                                            <input type="email" class="form-control bg-white" name="email" required="">
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <label class="mb-2">Subject:</label>
                                            <input type="text" class="form-control bg-white" name="subject" required="">
                                        </div>
                                        <div class="col-md-12 mb-20">
                                            <label class="mb-2">Message:</label>
                                            <textarea class="form-control bg-white" name="message" rows="8" required=""></textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-primary" name="submit" type="submit">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
        
        
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                  </div>
                </div>
            </div> --}}
        @endforeach
    @endif


@endsection

