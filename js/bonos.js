
document.addEventListener("DOMContentLoaded", function () {
    filtrar();
});

function filtrar() {
$.ajax({
    url: '/mi/src/bonos',
    method: 'POST',
    data: { 
        desde: document.getElementById('desde').value,
        fecha_inicio: document.getElementById('fecha_inicio').value,
        fecha_final: document.getElementById('fecha_final').value,
        tipo: document.getElementById('tipo').value
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
    $(document).on('click', '#guardar', function(event) {
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
                    form_data.append('desde', $('#n_desde').val());
                    form_data.append('tipo', $('#n_tipo').val());
                    form_data.append('cantidad', $('#n_cantidad').val());
                  
                $.ajax({
                    type: "POST",
                    url: "/mi/src/guardar_bono",
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
    $(document).on('click', '#eliminar', function (event) {
        var id = event.target.getAttribute("value");
        Swal.fire({
            title: "¿Estás seguro de que deseas eliminar este bono?",
            text: "Esta acción no se puede deshacer.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, anular",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                    var form_data = new FormData();
                    form_data.append('id', id);
                  
                $.ajax({
                    type: "POST",
                    url: "/mi/src/eliminar_bono",
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
                                title: "Bono eliminado con exito"
                            });
                        }else  if (response == '2'){
                            Toast.fire({
                                icon: "error",
                                title: "Error al eliminado el bono"
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
    $(document).on('click', '#fecha_inicio', async function() {
        const { value: selectedDate } = await Swal.fire({
            title: 'Seleccione la fecha del inicio',
            input: 'date'
        });

        if (selectedDate) {
            const formattedDate = formatDate(selectedDate);
            $('#fecha_inicio').val(formattedDate);
        }
    });

    $(document).on('click', '#fecha_final', async function() {
        const { value: selectedDate } = await Swal.fire({
            title: 'Seleccione la fecha del final',
            input: 'date'
        });

        if (selectedDate) {
            const formattedDate = formatDate(selectedDate);
            $('#fecha_final').val(formattedDate);
        }
    });
});



$(document).ready(function() {
    $(document).on('click', '#n_fecha_inicio', async function() {
        const { value: selectedDate } = await Swal.fire({
            title: 'Seleccione la fecha del inicio',
            input: 'date'
        });

        if (selectedDate) {
            const formattedDate = formatDate(selectedDate);
            $('#n_fecha_inicio').val(formattedDate);
        }
    });

    $(document).on('click', '#n_fecha_final', async function() {
        const { value: selectedDate } = await Swal.fire({
            title: 'Seleccione la fecha del final',
            input: 'date'
        });

        if (selectedDate) {
            const formattedDate = formatDate(selectedDate);
            $('#n_fecha_final').val(formattedDate);
        }
    });
});

function formatDate(date) {
    const [year, month, day] = date.split('-');
    return `${year}-${month}-${day}`;
}
