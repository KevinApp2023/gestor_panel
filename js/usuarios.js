
document.addEventListener("DOMContentLoaded", function () {
    filtrar();
});

function filtrar() {
$.ajax({
    url: '/mi/src/usuarios',
    method: 'POST',
    data: { 
        priv: document.getElementById('priv').value,
        correo: document.getElementById('correo').value,
        nombres: document.getElementById('nombres').value
    },
    success: function(response) {
        $('#resultadoBusqueda').html(response);
    }
});
}

$(document).ready(function() {
    $(document).on('click', '#aplicar_filtro', function() {
        filtrar();
    });
});


$(document).ready(function() {
    $(document).on('click', '#editar', function(event) {
        $('#guardar').attr('value', '');
        $('#eliminar').attr('value', '');
        $('#exampleModalFullscreenLabel').html('');
        $('#b_correo').val('');
        $('#b_nombres').val('');
        $('#sb_priv').val('');
        $('#sb_priv').html('');
        
        var id = event.target.getAttribute("value");
        $('#guardar').attr('value', id);
        $('#eliminar').attr('value', id);
        $.ajax({
            url: '/mi/src/consultar_usuario',
            method: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                $('#exampleModalFullscreenLabel').html(data.nombres);
                $('#b_correo').val(data.correo);
                $('#b_nombres').val(data.nombres);
                $('#sb_priv').html(data.val_priv);
                $('#sb_priv').attr('value', data.priv);

            },
            error: function() {
                console.log('Error en la solicitud AJAX');
            }
        });
    });
});


$(document).ready(function() {
    $(document).on('click', '#guardar', function(event) {
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
                    form_data.append('id', id);
                    form_data.append('correo', $('#b_correo').val());
                    form_data.append('nombres', $('#b_nombres').val());
                    form_data.append('priv', $('#b_priv').val());
                    form_data.append('pass', $('#b_pass').val());
                  
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


$(document).ready(function() {
    $(document).on('click', '#eliminar', function(event) {
        var id = event.target.getAttribute("value");
        $.ajax({
            url: '/mi/src/eliminar_usuario?id=' + id, 
            method: 'GET',
            success: function(response) {
                filtrar();
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                if (response == '1'){
                    Toast.fire({
                        icon: "success",
                        title: "Usuario eliminados con exito"
                    });
                }else if (response == '2'){
                    Toast.fire({
                        icon: "error",
                        title: "Error al eliminar el usuario"
                    });

                }
            },
            error: function() {
                alert('Hubo un error al eliminar la informacion.');
            }
        });
    });
});


$(document).ready(function() {
    $(document).on('click', '#cancelar', function(event) {
        $('#guardar').attr('value', '');
        $('#eliminar').attr('value', '');
        $('#exampleModalFullscreenLabel').html('');
        $('#b_correo').val('');
        $('#b_nombres').val('');
        $('#sb_priv').val('');
        $('#sb_priv').html('');
    });
});