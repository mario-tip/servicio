var token = null;
$(document).ready(function(){
    token = $("input[name='_token']").val();
    $("#part_select" ).select2({
        ajax: {
            url: '/get-select2-parts',
            dataType: 'json',
            headers: {'X-CSRF-TOKEN': token},
            data: function (params) {
                return {
                    q: params.term, // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data.results,
                };
            },
            cache: true
        },
        language: "es",
        placeholder: "Introduce un nombre",
        minimumInputLength: 3,
    });
    $('.currency-format').number(true, 2);
});

 var datatable_parts = $('#datatable_parts').DataTable({
    "scrollY": "300px",
    "scrollCollapse": true,
    "paging": false,
    "bInfo": false,
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json",
    }
});

$('#add_part').click(function(){
    addPart();
});

/*Agrega parte buscada a la tabla*/
function addPart() {
    var selected_part_id = $('#part_select').val();
    $.ajax({
        url: '/get-part',
        method: 'POST',
        dataType: 'JSON',
        data: {'part_id': selected_part_id},
        headers: {'X-CSRF-TOKEN': token},
        success: function(response) {
            if(response.errors == true) {
                $('#errors_container').html(response.errors_fragment);
                return;
            }
            datatable_parts.row.add([
                response.part.name,
                response.part.number,
                '<span class="currency-format">' + response.part.price + '</span>',
                response.part.description,
                '<a class="btn btn-circle btn-icon-only red icon-delete">' +
                '<i class="fa fa-trash-o"></i>' +
                '</a>' +
                '<input name="parts[]" type="hidden" value="' + response.part.id + '"/>'
            ]).draw(false);
            $('.currency-format').number(true, 2);
        }
    });
}

/*Remueve parte seleccionada de la tabla*/
$('#datatable_parts tbody').on( 'click', 'a.icon-delete', function () {
    datatable_parts
        .row($(this).parents('tr'))
        .remove()
        .draw();
});

/*Submit del form*/
$('#equipment_form').submit(function(e) {
    'use strict';
    e.preventDefault();
    //console.log('here');
    var serialized_form = $(this).serialize();
    var method = $(this).data('method');
    var url = '/equipments';
    if(method == 'PUT') {url += '/' + $('#equipment_id').val(); }
    sendForm(serialized_form, method, url);
});

/*Envio de formulario*/
function sendForm(serialized_form, method, url) {
    'use strict';
    $.ajax({
        url: url,
        method: method,
        dataType: 'JSON',
        data: serialized_form,
        headers: {'X-CSRF-TOKEN': token},
        success: function(response) {
            if(response.errors == true) {
                $('#errors_container').html(response.errors_fragment);
            } else {
                window.location = '/equipments';
            }
        }
    });
}
