/*Evento al cambiar status de autorizaci�n de cotizaci�n*/
$(".change-quotation-status").click(function(){
    quotation_id = $(this).data('id');
    var authorization = $(this).data('authorization');
    $('#quotation_status_select').val(authorization);
    $('#modal_errors_container').html('');
});

$('#authorization_form').on('submit', function(e) {
    'use strict';
    e.preventDefault();
    var form_data = new FormData(document.getElementById('authorization_form'));
    sendAuthorizationForm(form_data);
});

/*Envio de formulario de cambio de authorization status*/
function sendAuthorizationForm(form_data) {
    'use strict';
    var token = $("input[name='_token']").val();
    var customer_id = $("input[name='customer_id']").val();
    form_data.append('quotation_id', quotation_id);
    $.ajax({
        url: '/change-authorization-status',
        method: 'POST',
        data: form_data,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        headers: {'X-CSRF-TOKEN': token},
        success: function(response) {
            if(response.errors == true) {
                $('#modal_errors_container').html(response.errors_fragment);
            } else {
                window.location = '/customerIncidents/'+customer_id;
            }
        }
    });
}