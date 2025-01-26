
document.addEventListener("DOMContentLoaded", function () {
    filtrar();
});

function filtrar() {
$.ajax({
    url: '/mi/src/canchas',
    method: 'POST',
    data: { 
    },
    success: function(response) {
        $('#data_canchas').html(response);
    }
});
}


$(document).ready(function() {
    $(document).on('click', '#cancha_guardar', function(event) {
        Swal.fire({
            title: "¿Quieres registrar la cancha?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Si, Registrar",
            denyButtonText: `No guardar`,
            icon: "question",
        }).then((result) => {
            if (result.isConfirmed) {
              
                    var form_data = new FormData();
                    form_data.append('nombre', $('#nombre').val());
                  
                $.ajax({
                    type: "POST",
                    url: "/mi/src/guardar_cancha",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('body').append(response);
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
                                title: "Cancha guardada con exito"
                            });
                        }else  if (response == '2'){
                            Toast.fire({
                                icon: "error",
                                title: "Error al guardar la cancha"
                            });
                        }
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
