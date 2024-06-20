<div class="modal fade mt-5" id="downloadAttachment" tabindex="-1" aria-labelledby="downloadAttachmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadAttachmentLabel">{{ __('Tell Us About Yourself Before Download') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="lead_generation_property_attachments" action="{{ route('collect-lead') }}" method="post" class="form-boder">
                @csrf
                <input type="hidden" name="campaign" value="Website - Download">
                <input type="hidden" name="download-link" id="download-link" value="">
                <div class="modal-body">
                    <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="lead_name" inputId="lead_name" inputLabel="{{ __('Your Name') }}"  inputRequired="required" inputValue="{{ old('lead_name', Auth::user()->name ?? '') }}" class="mb-3"/>
                    <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="lead_desgination" inputId="lead_desgination" inputLabel="{{ __('Current Designation') }}"  inputRequired="required" inputValue="{{ old('lead_desgination', '') }}" class="mb-3"/>
                    <x-inputs.text inputLabelClass="font-fifteen font-500" inputName="lead_email" inputId="lead_email" inputLabel="{{ __('Your Email') }}"  inputRequired="required" inputValue="{{ old('lead_email', Auth::user()->email ?? '') }}" class="mb-3"/>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="download-btn" class="btn btn-secondary">{{ __('Download') }}</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            const downloadAttachment = document.getElementById('downloadAttachment')
            if (downloadAttachment) {
                downloadAttachment.addEventListener('show.bs.modal', event => {
                    // Button that triggered the modal
                    const button = event.relatedTarget
                    // Extract info from data-bs-* attributes
                    const link = button.getAttribute('data-bs-value')
                    // If necessary, you could initiate an Ajax request here
                    // and then do the updating in a callback.

                    // Update the modal's content.
                    // const modalDownload = downloadAttachment.querySelector('#download-btn')
                    const modalBodyInput = downloadAttachment.querySelector('#download-link')

                    // modalDownload.href = link
                    modalBodyInput.value = link

                })
            }
        });
    </script>
@endpush