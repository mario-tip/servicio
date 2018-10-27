$(".delete-equipment").click(function(){
    equipment_id = $(this).data('id');
    var name = $(this).data("name");
    var nodeName=document.createElement("p");
    var nameNode=document.createTextNode("¿Seguro que desea eliminar el equipo " + name + "?");
    nodeName.appendChild(nameNode);
    $("#bodyDelete").empty();
    document.getElementById("bodyDelete").appendChild(nodeName);
});

/*Eliminado de equipment*/
function deleteEquipment() {
    var token = $('#token').val();
    $.ajax({
        url: 'equipments/' + equipment_id,
        method: 'DELETE',
        dataType: 'JSON',
        headers: {'X-CSRF-TOKEN': token},
        success: function(response) {
            if(response.errors === true) {
                if(response.type_error === 'unable') {
                    $('#basic').hide();
                    $('#unable_delete_equipment').modal('toggle');
                } else {
                    $('#notification_container').html(response.errors_fragment);
                }
            } else {
                window.location = "../equipments";
                $("#message").fadeIn();
            }
        }
    });
}
