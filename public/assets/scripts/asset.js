
$('#get_equipment_parts').click(function(){
    getEquipmentParts();
});

var equipment_parts_length = null;

function getEquipmentParts() {
    var equipment_id = $('#asset_equipment_id').val();

    if(equipment_id != '') {
        var url = '/get-equipment-parts';
        var token = $("input[name='_token']").val();
        var asset_id = $('#asset_id').val();

        $.ajax({
            url: url,
            dataType: 'JSON',
            type: 'GET',
            data: {'equipment_id': equipment_id, 'asset_id': asset_id},
            headers: {'X-CSRF-TOKEN': token},
            success: function (response) {
                $('#equipment_parts_length').val(response.equipment_parts.length);
                $('#equipment_parts_container').html(response.equipment_parts_table_view);
                $('#datatable_parts').DataTable({
                    "scrollY": "350px",
                    "scrollCollapse": true,
                    "paging": false,
                    "bInfo": false,
                    "language": {
                        // "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json" //cdn.datatables.net/plug-ins/1.10.16/i18n/English.json
                    }
                });
                $('.currency-format').number(true, 2);
            }
        });
    }
}

/*Actualiza el valor del checkbox al actualizarse el input de su mismo row*/
$('#equipment_parts_container').on('blur', '.equipment-part-input', function(e) {
    var checkbox_id = e.currentTarget.id.replace('part_input', 'part_check_box');
    $('#' + checkbox_id).val(this.value);
});


/*Funcionalidad de los checkboxes*/
$('#equipment_parts_container').on('click', 'input:checkbox', function(e){
    'use strict';
    var equipment_parts_length = $('#equipment_parts_length').val();

    if(e.currentTarget.className != 'equipment-parts-checkall') {
        if(!e.currentTarget.checked && $('.equipment-parts-checkall:checkbox:checked')) {
            $('.equipment-parts-checkall').prop('checked', false);
        }
        if ($('#asset_form :checkbox:checked').length == equipment_parts_length) {
            $('.equipment-parts-checkall').prop('checked', true);
        }
    } else if (e.currentTarget.className == 'equipment-parts-checkall') {
        $('#asset_form :checkbox').prop('checked', this.checked);
    }
});


$('.date-picker').datepicker({
    language: "es",
    autoclose: true,
    orientation: 'bottom auto'
});

$('.update-firmware').click(function(){
    $('#modal_errors_container').html('');
});

/*Validaciónes y guardado de firmware*/
$('#firmware_form').on('submit', function(e) {
    'use strict';
    e.preventDefault();
    var token = $("input[name='_token']").val();
    var serialized_form = $(this).serialize();

    $.ajax({
        url: '/firmwares',
        type: 'POST',
        data: serialized_form,
        headers: {'X-CSRF-TOKEN': token},
        success: function(response){
            if(response.errors == true) {
                $('#errors_container').html(response.errors_fragment);
            } else {
                window.location = '/actives';
            }
        }
    });
});


/*Submit del form*/
$('#asset_form_subcontainer').on('submit', '#asset_form', function(e) {
    'use strict';
    e.preventDefault();
    var serialized_form = $('#asset_form').serialize();
    var method = $('#asset_form').data('method');
    var url = '/actives';
    if(method == 'PUT') {url += '/' + $('#asset_id').val();}
    sendForm(serialized_form, method, url);
});

/*Envio de formulario*/
function sendForm(serialized_form, method, url) {
    'use strict';
    var token = $("input[name='_token']").val();
    $.ajax({
        url: url,
        type: method,
        data: serialized_form,
        dataType: 'JSON',
        headers: {'X-CSRF-TOKEN': token},
        success: function(response){
            if(response.errors == true) {
                $('#errors_container').html(response.errors_fragment);
                window.scrollTo(0, 0);
            } else {
                window.location = '/actives';
            }
        }
    });
}
