
document.addEventListener("DOMContentLoaded", function () {
    filtrar();
});

function filtrar() {
$.ajax({
    url: '/mi/src/clientes',
    method: 'POST',
    data: { 
        identificacion: document.getElementById('identificacion').value,
        nombres: document.getElementById('nombres').value,
        apellidos: document.getElementById('apellidos').value,
        correo_electronico: document.getElementById('correo_electronico').value,
        telefono: document.getElementById('telefono').value,
        estado: document.getElementById('estado').value
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
        var id = event.target.getAttribute("value");
        $('#guardar').attr('value', '');
        $('#estado_data').attr('value', '');
        $('#eliminar').attr('value', '');
        $('#exampleModalFullscreenLabel').html('');
        $('#b_identificacion').val('');
        $('#b_nombres').val('');
        $('#b_apellidos').val('');
        $('#b_direccion').val('');
        $('#b_fecha_registro').val('');
        $('#b_saldo').val('');
        $('#b_telefono').val('');
        $('#b_correo_electronico').val('');

        
        
        $.ajax({
            url: '/mi/src/consultar_cliente',
            method: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                
                $('#guardar').attr('value', id);
                $('#eliminar').attr('value', id);
                $('#exampleModalFullscreenLabel').html(data.nombres + " " + data.apellidos);
                $('#b_identificacion').val(data.identificacion);
                $('#b_nombres').val(data.nombres);
                $('#b_apellidos').val(data.apellidos);
                $('#b_direccion').val(data.direccion);
                $('#b_fecha_registro').val(data.fecha_registro);
                $('#b_saldo').val(data.saldo);
                $('#b_telefono').val(data.telefono);
                $('#b_correo_electronico').val(data.correo_electronico);

                if (data.estado == 1) {
                    $('#b_estado').html('<a id="estado_data" value="1" class="btn btn-success w-100" ><i class="bi bi-check-circle me-2"></i>Activo</a>');
                }else{
                    $('#b_estado').html('<a id="estado_data" value="2" class="btn btn-danger w-100"><i class="bi bi-x-circle me-2"></i>Suspendido</a>');
                }
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
        var estado = $('#estado_data').attr('value');
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
                    form_data.append('codigo', $('#b_codigo').val());
                    form_data.append('identificacion', $('#b_identificacion').val());
                    form_data.append('nombres', $('#b_nombres').val());
                    form_data.append('apellidos', $('#b_apellidos').val());
                    form_data.append('entidad', $('#b_entidad').val());
                    form_data.append('sede', $('#b_sede').val());
                    form_data.append('jornada', $('#b_jornada').val());
                    form_data.append('grupo', $('#b_grupo').val());
                    form_data.append('telefono', $('#b_telefono').val());
                    form_data.append('correo', $('#b_correo').val());
                    form_data.append('estado', estado);
                  
                $.ajax({
                    type: "POST",
                    url: "/mi/src/editar_datos",
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
    $(document).on('click', '#cancelar', function(event) {
        $('#guardar').attr('value', '');
        $('#estado_data').attr('value', '');
        $('#eliminar').attr('value', '');
        $('#exampleModalFullscreenLabel').html('');
        $('#b_codigo').val('');
        $('#b_identificacion').val('');
        $('#b_nombres').val('');
        $('#b_apellidos').val('');
        $('#b_entidad').val('');
        $('#b_sede').val('');
        $('#b_jornada').val('');
        $('#b_grupo').val('');
        $('#b_telefono').val('');
        $('#b_correo').val('');
        $('#b_foto').attr('src', '');
    });
});


$(document).ready(function() {
    $(document).on('click', '#estado_data', function() {
        const estado_data = document.getElementById("estado_data");
        if (estado_data) {
            if (estado_data.classList.contains("btn-danger")) {
                estado_data.classList.remove("btn-danger");
                estado_data.classList.add("btn-success");
                estado_data.setAttribute("value", "Activo");
                estado_data.innerHTML = '<i class="bi bi-check-circle me-2"></i>Activo';
            } else {
                estado_data.classList.add("btn-danger");
                estado_data.classList.remove("btn-Success");
                estado_data.setAttribute("value", "Suspendido");
                estado_data.innerHTML = '<i class="bi bi-x-circle me-2"></i>Suspendido';
            }
        }
    });
});