var token = $('input[name="_token"]').val();

$('#customer_service_orders_filters_form').submit(function(e){
    e.preventDefault();

    console.log($(this));
    var serialized_form = $(this).serialize();


    $.ajax({
        url: '/reports/generate-customer-service-orders',
        method: 'POST',
        dataType: 'JSON',
        data: serialized_form,
        headers: {'X-CSRF-TOKEN': token},
        success: function(response) {
            $('#sample_editable_1').DataTable().clear().destroy();
            if(response.errors == false) {
                var data = response.results;
                console.log(data);
                $('#sample_editable_1').DataTable(
                    {"data":data,
                        "columns":[
                            {data:"folio"},
                            {data:"customer"},
                            {data:"person"},
                            {data:"asset"},
                            {
                                data:"resolution_date",
                                render: function(d){
                                    return (moment(d).isValid()) ? moment(d).format("DD-MM-YYYY HH:mm") : '';
                                }
                            },
                            {data:"technician"},
                            {data:"location"},
                            {data:"status"},
                        ],
                        "order":[
                            [1,'asc']
                        ],
                        "bFilter": false,
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/English.json"
                        }
                    }
                );
                $('#download_report').prop('disabled', false);
            } else {
                $('#errors_container').html(response.errors_fragment);
                $("#errors_container").fadeIn("slow", function(){
                    $(this).delay(3000).fadeOut('slow');
                });
                $('#download_report').prop('disabled', true);
                TableDatatablesEditable.init();
            }
        }
    });
});

/*Descarga del reporte con los rows en la tabla*/

$('#download_report').click(function(){
    var rows = JSON.stringify($('#sample_editable_1').DataTable().rows().data().toArray());
    $('#data').val(rows);
});
