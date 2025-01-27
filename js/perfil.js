
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

