
document.addEventListener("DOMContentLoaded", function () {
    filtrar();
});

function filtrar() {
$.ajax({
    url: '/mi/src/reservas',
    method: 'POST',
    data: { 
        cancha: document.getElementById('cancha').value,
        referencia: document.getElementById('referencia').value,
        fecha_inicio: document.getElementById('fecha_inicio').value,
        fecha_final: document.getElementById('fecha_final').value,
        nombres: document.getElementById('nombres').value,
        apellidos: document.getElementById('apellidos').value,
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

function formatDate(date) {
    const [year, month, day] = date.split('-');
    return `${year}-${month}-${day}`;
}



function mostrar_reserva(id){
    
    var modalReserva = new bootstrap.Modal(document.getElementById('reserva'), {
        backdrop: 'static', 
        keyboard: false
    });
    modalReserva.show();

    $.ajax({
        url: '/mi/src/consultar_reserva',
        method: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(data) {
            
            $('#de_data_modal_reserva_title').html(data.estado);
            $('#de_referencia').html(data.referencia);
            $('#de_r_cancha').html(data.nombre);
            $('#de_fecha').html(data.r_fecha);
            $('#de_hora_inicio').html(data.r_hora_inicio);
            $('#de_hora_final').html(data.r_hora_final);
            $('#de_cliente').html(data.nombres + " " + data.apellidos);
            $('#de_cantidad_horas').html(data.cantidad_horas);
            $('#de_total').html('$' + data.total);
            $('#cancha_eliminar').attr('value', data.id);


        },
        error: function() {
            console.log('Error en la solicitud AJAX');
        }
    });

}





$(document).ready(function() {
    $(document).on('click', '#cancha_eliminar', function(event) {
        var id = event.target.getAttribute("value");
        Swal.fire({
            title: "¿Estás seguro de que deseas eliminar esta reserva?",
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
                    url: "/mi/src/cancelar_reserva_cancha",
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
                                title: "Reserva cancelada con éxito"
                            });
                        } else if (response == '2') {
                            Toast.fire({
                                icon: "error",
                                title: "Error al eliminar la reserva"
                            });
                        }
                    }
                }).then(() => {
                    calendar();
                });
            }
        });
    });
});
