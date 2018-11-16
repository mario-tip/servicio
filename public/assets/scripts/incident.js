$('#asset_id').change(function (e) {
    var asset_id = $(this).val();

    $.ajax({
        type: 'GET',
        url: '/getDataAsset/'+asset_id,
        dataType: 'JSON',
        async:true,
        cache:false,
        success: function(asset) {
            $('#asset_custom_id').val(asset[0].asset_custom_id);
            $('#asset_name').val(asset[0].name);
            $('#brand').val(asset[0].brand);
            $('#location').val(asset[0].location);
            $('#serial').val(asset[0].serial);
            $('#flag').val(asset[0].flag);
        }
    });

    getIncidentParts();
});

var equipment_parts_length = null;

function getIncidentParts() {
    var asset_id = $('#asset_id').val();

    if(asset_id != '') {
        var url = '/getIncidentParts';
        var token = $("input[name='_token']").val();
        var incident_id = $('#incident_id').val();

        $.ajax({
            url: url,
            dataType: 'JSON',
            type: 'GET',
            data: {'asset_id': asset_id, 'incident_id': incident_id},
            headers: {'X-CSRF-TOKEN': token},
            success: function (response) {
                $('#equipment_parts_length').val(response.asset_parts.length);
                $('#equipment_parts_container').html(response.incident_parts_table_view);
                $('#datatable_parts').DataTable({
                    "scrollY": "350px",
                    "scrollCollapse": true,
                    "paging": false,
                    "bInfo": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                    }
                });
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