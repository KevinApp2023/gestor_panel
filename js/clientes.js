
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
        var estado = $('#estado_data').attr('value')
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
                    form_data.append('identificacion', $('#b_identificacion').val());
                    form_data.append('nombres', $('#b_nombres').val());
                    form_data.append('apellidos', $('#b_apellidos').val());
                    form_data.append('direccion', $('#b_direccion').val());
                    form_data.append('fecha_registro', $('#b_fecha_registro').val());
                    form_data.append('saldo', $('#b_saldo').val());
                    form_data.append('correo_electronico', $('#b_correo_electronico').val());
                    form_data.append('telefono', $('#b_telefono').val());
                    form_data.append('estado', estado);
                  
                $.ajax({
                    type: "POST",
                    url: "/mi/src/editar_cliente",
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
                   filtrar();
                });
            

            } else if (result.isDenied) {
                Swal.fire("Los cambios no se guardan", "", "info");
            }
        });

    });
});



$(document).ready(function() {
    $(document).on('click', '#n_guardar', function(event) {
        var estado = $('#n_estado_data').attr('value')
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
                    form_data.append('identificacion', $('#n_identificacion').val());
                    form_data.append('nombres', $('#n_nombres').val());
                    form_data.append('apellidos', $('#n_apellidos').val());
                    form_data.append('direccion', $('#n_direccion').val());
                    form_data.append('fecha_registro', $('#n_fecha_registro').val());
                    form_data.append('saldo', $('#n_saldo').val());
                    form_data.append('correo_electronico', $('#n_correo_electronico').val());
                    form_data.append('telefono', $('#n_telefono').val());
                    form_data.append('estado', estado);
                  
                $.ajax({
                    type: "POST",
                    url: "/mi/src/guardar_cliente",
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
                        if (response !== '2'){
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
        Swal.fire({
            title: "¿Estás seguro de que deseas eliminar este registro?",
            text: "Esta acción no se puede deshacer.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                var form_data = new FormData();
                form_data.append('id', id);

                $.ajax({
                    type: "POST",
                    url: "/mi/src/eliminar_cliente",
                    data: form_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
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
                        if (response == '1') {
                            Toast.fire({
                                icon: "success",
                                title: "Registro eliminado con éxito"
                            });
                        } else if (response == '2') {
                            Toast.fire({
                                icon: "error",
                                title: "Error al eliminar el registro"
                            });
                        }
                    }
                }).then(() => {
                    filtrar();
                });
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
                estado_data.setAttribute("value", "1");
                estado_data.innerHTML = '<i class="bi bi-check-circle me-2"></i>Activo';
            } else {
                estado_data.classList.add("btn-danger");
                estado_data.classList.remove("btn-Success");
                estado_data.setAttribute("value", "2");
                estado_data.innerHTML = '<i class="bi bi-x-circle me-2"></i>Suspendido';
            }
        }
    });
});

$(document).ready(function() {
    $(document).on('click', '#n_estado_data', function() {
        const estado_data = document.getElementById("n_estado_data");
        if (estado_data) {
            if (estado_data.classList.contains("btn-danger")) {
                estado_data.classList.remove("btn-danger");
                estado_data.classList.add("btn-success");
                estado_data.setAttribute("value", "1");
                estado_data.innerHTML = '<i class="bi bi-check-circle me-2"></i>Activo';
            } else {
                estado_data.classList.add("btn-danger");
                estado_data.classList.remove("btn-Success");
                estado_data.setAttribute("value", "2");
                estado_data.innerHTML = '<i class="bi bi-x-circle me-2"></i>Suspendido';
            }
        }
    });
});




$(document).ready(function() {
    $(document).on('click', '#b_fecha_registro', async function() {
        const { value: selectedDate } = await Swal.fire({
            title: 'Seleccione la fecha de registro',
            input: 'date'
        });

        if (selectedDate) {
            const formattedDate = formatDate(selectedDate);
            $('#b_fecha_registro').val(formattedDate);
        }
    });

    $(document).on('click', '#n_fecha_registro', async function() {
        const { value: selectedDate } = await Swal.fire({
            title: 'Seleccione la fecha de registro',
            input: 'date'
        });

        if (selectedDate) {
            const formattedDate = formatDate(selectedDate);
            $('#n_fecha_registro').val(formattedDate);
        }
    });
});

function formatDate(date) {
    const [year, month, day] = date.split('-');
    return `${year}-${month}-${day}`;
}
