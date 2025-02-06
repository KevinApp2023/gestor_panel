
document.addEventListener("DOMContentLoaded", function () {
    consultar_perfiil();
});

function consultar_perfiil() {
    $.ajax({
        url: '/mi/src/perfil',
        method: 'POST',
        dataType: 'json',
        success: function(data) {
            $('#perfil').attr('src', data.perfil);
            $('#perfil_nombres_datta').html(data.nombres);
            $('#perfil_nombre_completo').html(data.nombres + " " + data.apellidos);
            $('#perfil_identificacion').html(data.identificacion);
            $('#perfil_correo_electronico').html(data.correo_electronico);
            $('#perfil_telefono').html(data.telefono);
            $('#perfil_direccion').html(data.direccion);
            $('#perfil_fecha_registro').html(data.fecha_registro);
            $('#perfil_saldo').html(data.saldo);

            if (data.estado == 1) {
                $('#perfil_estado').html('<a id="estado_data" class="btn btn-success w-100" ><i class="bi bi-check-circle me-2"></i>Activo</a>');
            }else{
                $('#perfil_estado').html('<a id="estado_data" class="btn btn-danger w-100"><i class="bi bi-x-circle me-2"></i>Suspendido</a>');
            }


            $('#editar_identificacion').val(data.identificacion);
            $('#editar_nombres').val(data.nombres);
            $('#editar_apellidos').val(data.apellidos);
            $('#editar_correo_electronico').val(data.correo_electronico);
            $('#editar_telefono').val(data.telefono);
            $('#editar_direccion').val(data.direccion);
        },
        error: function() {
            console.log('Error en la solicitud AJAX');
        }
    });
}



$(document).ready(function() {
    $(document).on('click', '#editar_perfil', function(event) {
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
                    form_data.append('perfil', 'data');
                    form_data.append('identificacion', $('#editar_identificacion').val());
                    form_data.append('nombres', $('#editar_nombres').val());
                    form_data.append('apellidos', $('#editar_apellidos').val());
                    form_data.append('correo_electronico', $('#editar_correo_electronico').val());
                    form_data.append('telefono', $('#editar_telefono').val());
                    form_data.append('direccion', $('#editar_direccion').val());
                 
                $.ajax({
                    type: "POST",
                    url: "/mi/src/guardar_cambios_perfil",
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
                                title: "Datos guardados con exito"
                            });
                        }else  if (response == '2'){
                            Toast.fire({
                                icon: "error",
                                title: "Error al guardados los datos"
                            });
                        }
                    }
                }).then(() => {
                   location.reload();
                });
            

            } else if (result.isDenied) {
                Swal.fire("Los cambios no se guardan", "", "info");
            }
        });

    });
});




$(document).ready(function() {
    $(document).on('click', '#cambiar_pass', function(event) {
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
                    form_data.append('pass', 'data');
                    form_data.append('pass_actual', $('#pass_actual').val());
                    form_data.append('n_pass', $('#n_pass').val());
                    form_data.append('r_n_pass', $('#r_n_pass').val());
                 
                $.ajax({
                    type: "POST",
                    url: "/mi/src/guardar_cambios_perfil",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        if (response == 'Error 121'){
                            appendAlert('Contraseña actual incorrecta, Intente nuevamente con una nueva contraseña!')
                        }else if (response == 'Error 122'){
                            appendAlert('Las contraseñas no coinciden, Por favor, verifica que ambas contraseñas sean iguales!')
                        }else if (response == 'Error 123'){
                            appendAlert('La nueva contraseña no puede ser igual a la anterior. Intenta con otra.')
                     }else if (response == 'Active'){
                           
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                                Toast.fire({
                                    icon: "success",
                                    title: "Datos guardados con exito"
                                }).then(() => {
                                    location.reload();
                                 });


                          }else if (response == 'Error 201'){
                            appendAlert('Error, Intente nuevamente algo ha salido mal!')
                        }

                        
                        
                    }
                });
            

            } else if (result.isDenied) {
                Swal.fire("Los cambios no se guardan", "", "info");
            }
        });

    });
});


const alertPlaceholder = document.getElementById('alert_r_pass')
const appendAlert = (message) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-primary alert-dismissible col-md-12" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}
