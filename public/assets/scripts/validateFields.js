$("#email").keyup(function(e){
    var token = $('#token').val();
    value = $("#email").val();

    if(value !== ''){
        if(!value.match(/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i)){
            $('#alertEmail').html('Correo electrónico inválido.');
            $('#send').attr('disabled',true);
        }else{
            $('#alertEmail').html('');
            $.ajax({
                url: '/searchEmail',
                headers : {'X-CSRF-TOKEN': token},
                type: "POST",
                data: {email:value},
                success: function(data){
                    console.log(data['success']);
                    if(data['success'] == false){
                        // validateInvitedUser
                        $('.alertEmail').html('');
                        $('#send').attr('disabled',false);
                    }else{
                        $('#alertEmail').html('El correo electrónico ya existe.');
                        $('#send').attr('disabled',true);
                    }
                }
            });
        }
    }else{
        $('#alertEmail').html('');
        $('#send').attr('disabled',false);
    }
});

function validateInput(event, id) {
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    var regex;
    switch (id) {
        case 1:
            // Valida que el input solo acepte letras
            regex = new RegExp("[a-zA-Z ñ Ñ À-ÿ]");
            break;
        case 2:
            // Valida que el input solo numeros
            regex = new RegExp("[0-9]+");
            break;
        case 3:
            // Valida que el input para numeros de telefono solo acepte numeros con espacio o guion
            regex = new RegExp("[0-9-+ ]+");
            break;
        case 4:
            regex = new RegExp('[a-zA-Z0-9 ñ Ñ]');
            //Solo numeros y punto decimal
        case 5:
            regex = RegExp('[0-9\.]+');
    }

    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
}

