var token = null;
var quotation_id = null;

$(document).ready(function(){
    token = $("input[name='_token']").val();
    $('.currency-format').number(true, 2);
});

/*Actualiza el valor del checkbox al actualizarse el input de su mismo row*/
$('#incident_parts_container').on('blur', '.incident-part-input', function(e) {
    var checkbox_id = e.currentTarget.id.replace('part_input', 'part_check_box');
    $('#' + checkbox_id).val(this.value);
});

/*Funcionalidad de los checkboxes*/
$('#incident_parts_container').on('click', 'input:checkbox', function(e){
    'use strict';
    var incident_parts_length = $('#incident_parts_length').val();

    if(e.currentTarget.className != 'incident-parts-checkall') {
        if(!e.currentTarget.checked && $('.incident-parts-checkall:checkbox:checked')) {
            $('.incident-parts-checkall').prop('checked', false);
        }
        if ($('#quotation_form :checkbox:checked').length == incident_parts_length) {
            $('.incident-parts-checkall').prop('checked', true);
        }
    } else if (e.currentTarget.className == 'incident-parts-checkall') {
        $('#quotation_form :checkbox').prop('checked', this.checked);
    }
});

$("#incident_select").on('select2:select', function(){
    getIncidentParts();
});

function getIncidentParts() {
    var incident_id = $('#incident_select').val();
    var quotation_id = $('#quotation').data('id');
    var url = '/get-incident-parts';
    var token = $("input[name='_token']").val();

    $.ajax({
        url: url,
        dataType: 'JSON',
        type: 'GET',
        data: {'incident_id': incident_id, 'quotation_id': quotation_id},
        headers: {'X-CSRF-TOKEN': token},
        success: function (response) {
            $('#incident_asset_name').text(response.asset_name);
            $('#incident_parts_container').html(response.incident_parts_table_view);
            $('#datatable_parts').DataTable({
                "scrollY": "350px",
                "scrollCollapse": true,
                "paging": false,
                "bInfo": false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
            $('.currency-format').number(true, 2);
        }
    });
}

/*Submit del form*/
$('#quotation_form_subcontainer').on('submit', '#quotation_form', function(e) {
    'use strict';
    e.preventDefault();
    var form_data = new FormData(document.getElementById('quotation_form'));
    var method = $(this).data('method');
    var url = '/quotations';
    if(method == 'PUT') {url += '/' + $('#quotation').data('id');}
    sendForm(form_data, method, url);
});

/*Envio de formulario de registro/update de cotización*/
function sendForm(form_data, method, url) {
    'use strict';
    var token = $("input[name='_token']").val();
    if(method === 'PUT') {form_data.append('_method', 'PUT');}

    $.ajax({
        url: url,
        method: 'POST',
        data: form_data,
        dataType: 'JSON',
        processData: false,
        contentType: false,
        headers: {'X-CSRF-TOKEN': token},
        success: function(response) {
            if(response.errors == true) {
                $('#errors_container').html(response.errors_fragment);
                window.scrollTo(0, 0);
            } else {
                window.location = '/quotations';
            }
        }
    });
}


/*Evento cancelar cotización*/
$(".cancel_quotation").click(function(){
    quotation_id = $(this).data('id');
    var name = $(this).data("name");
    var nodeName=document.createElement("p");
    var nameNode=document.createTextNode("Are you sure you want to cancel the quote " + name + "?");
    nodeName.appendChild(nameNode);
    $("#bodyDelete").empty();
    document.getElementById("bodyDelete").appendChild(nodeName);
});

/*Cancelar cotización*/
function cancelQuotation() {
    var token = $('#token').val();
    $.ajax({
        url: 'quotations/' + quotation_id,
        method: 'DELETE',
        dataType: 'JSON',
        headers: {'X-CSRF-TOKEN': token},
        success: function(response) {
            console.log(response);
            if(response.errors == true) {
                $('#errors_container').html(response.errors_fragment);
            } else {
                window.location = '/quotations';
            }
        }
    });
}


/*Evento al cambiar status de autorización de cotización*/
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
                window.location = '/quotations';
            }
        }
    });
}
