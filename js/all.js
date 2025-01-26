

document.querySelectorAll("input[type='text']").forEach(input => {
    input.addEventListener("input", function() {
        this.value = this.value.toUpperCase();
    });
});

  
$(document).ready(function() {
    $(document).on('click', '#data_perfil', function() {
        $('#perfil_exampleModalFullscreenLabel').html('');
        $('#perfil_correo').val('');
        $('#perfil_nombres').val('');
        $('#sperfil_priv').html('');
        $('#sperfil_priv').attr('value', '');

        $.ajax({
            url: '/mi/src/consultar_usuario',
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                $('#perfil_exampleModalFullscreenLabel').html(data.nombres);
                $('#perfil_correo').val(data.correo);
                $('#perfil_nombres').val(data.nombres);
                $('#sperfil_priv').html(data.val_priv);
                $('#sperfil_priv').attr('value', data.priv);

            },
            error: function() {
                console.log('Error en la solicitud AJAX');
            }
        });
    });
});


$(document).ready(function() {
    $(document).on('click', '#perfil_guardar', function(event) {
        var id = event.target.getAttribute("value");
        Swal.fire({
            title: "¿Quieres guardar los cambios?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Guardar",
            denyButtonText: `No guardar`,
            icon: "question",
        }).then((result) => {
            if (result.isConfirmed) {
              
                    var form_data = new FormData();
                    form_data.append('correo', $('#perfil_correo').val());
                    form_data.append('nombres', $('#perfil_nombres').val());
                    form_data.append('priv', $('#perfil_priv').val());
                    form_data.append('pass', $('#perfil_pass').val());
                  
                $.ajax({
                    type: "POST",
                    url: "/mi/src/editar_usuario",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('body').append(response);
                    }
                }).then(() => {
                   filtrar();
                });
            

            } else if (result.isDenied) {
                Swal.fire("Los cambios no se guardan", "", "info");
            }
        });

    });
});