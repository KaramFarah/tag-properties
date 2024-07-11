$(document).ready(function () {
    window._token = $('meta[name="csrf-token"]').attr('content')
    $('.viewDetails').click(function(){
        //$('#form-modal').modal('hide');
        var detailsModal = new bootstrap.Modal(document.getElementById('details-modal'))
        $('#details-modalLabel').html($(this).attr('data-title'))
        $('#details-modalBody').load($(this).attr('data-value'))
        detailsModal.show()
    });
    
    $('.viewForm').click(function(){
        //$('#details-modal').modal('hide');
        var formModal = new bootstrap.Modal(document.getElementById('form-modal'))
        $('#form-modalLabel').html($(this).attr('data-title'))
        $('#form-modalBody').load($(this).attr('data-value'))
        formModal.show()
    });
  })