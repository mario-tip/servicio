var TableDatatablesEditable = function () {

    var handleTable = function () {

        var table = $('#sample_editable_1');

        table.dataTable({

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],

            // Or you can use remote translation file
            "language": {
                url: '//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json'
            },

            // set the initial value
            "pageLength": 5,

            /*            "language": {
                            "lengthMenu": " _MENU_ records"
                        },*/
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesEditable.init();
});