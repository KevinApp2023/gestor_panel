const currentPath = window.location.pathname + window.location.hash;

document.addEventListener("DOMContentLoaded", function () {
    filtrar();
        if (currentPath.includes('canchas/')){
            calendar();
        }
   
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

if (currentPath.includes('/admin/canchas')){
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
                    form_data.append('valor_hora', $('#valor_hora').val());
                  
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

}

function calendar(){
    var calendarEl = document.getElementById('calendar');
    var cancha = $('#cancha').val()
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prevYear,prev,next,nextYear',
        center: 'dayGridMonth,dayGridWeek,dayGridDay,listWeek',
        right: 'title',
      },
  
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'Día',
        list: 'Lista'
      },
  
      eventClick: function(info) {
        var eventObj = info.event;
        var id = eventObj.id; 
            mostrar_reserva(id);
    },
    
  
      initialDate: new Date().toISOString().split('T')[0],
      navLinks: true,
      dayMaxEvents: true,
      dayMaxEventRows: true,
      locale: 'es',
      eventDisplay: true,

      events: {
        url: '/mi/src/reservas?cancha=' + cancha,
        method: 'GET',
        failure: function() {
          console.error('Error al cargar los eventos');
        }
      }
    });
  
    calendar.render();

  function toggleToolbarClass() {
    var toolbar = document.querySelector('.fc-header-toolbar');
    if (window.innerWidth <= 768) {
      toolbar.classList.add('row');
    } else {
      toolbar.classList.remove('row');
    }
  }

  toggleToolbarClass();

  window.addEventListener('resize', toggleToolbarClass);


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
            
            $('#data_modal_reserva_title').html(data.estado);
            $('#referencia').html(data.referencia);
            $('#r_cancha').html(data.nombre);
            $('#fecha').html(data.r_fecha);
            $('#hora_inicio').html(data.r_hora_inicio);
            $('#hora_final').html(data.r_hora_final);
            $('#cliente').html(data.nombres + " " + data.apellidos);
            $('#cantidad_horas').html(data.cantidad_horas);
            $('#total').html('$' + data.total);
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






if (currentPath.includes('clientes/canchas/')){

    document.getElementById('r_hora_inicio').addEventListener('change', function () {
        const horaInicio = this.value; 
        console.log(`${horaInicio}:00`); 
    });

    document.getElementById('r_hora_final').addEventListener('change', function () {
        const horaFinal = this.value; 
        console.log(`${horaFinal}:00`); 
    });

    document.getElementById('calcular').addEventListener('click', function () {
        var html_btn_guardar = ' <a type="button" id="reserva_guardar"  data-bs-dismiss="modal" class="btn btn-primary" ><i class="bi bi-floppy me-2"></i>Guardar</a>';
        $('#btn_data_reservar').html(html_btn_guardar);
          const horaInicio = document.getElementById('r_hora_inicio').value;
          const horaFinal = document.getElementById('r_hora_final').value;
          const valorHora = parseFloat(document.getElementById('r_valor_hora').value);
  
          if (!horaInicio || !horaFinal || isNaN(valorHora)) {
              alert('Por favor, completa todos los campos correctamente.');
              return;
          }
  
          const [inicioHoras, inicioMinutos] = horaInicio.split(':').map(Number);
          const [finalHoras, finalMinutos] = horaFinal.split(':').map(Number);
  
          const minutosInicio = inicioHoras * 60 + inicioMinutos;
          const minutosFinal = finalHoras * 60 + finalMinutos;
  
          let diferenciaMinutos = minutosFinal - minutosInicio;
          if (diferenciaMinutos < 0) {
              diferenciaMinutos += 24 * 60; 
          }
          const cantidadHoras = (diferenciaMinutos / 60); 
  
          const total = (cantidadHoras * valorHora);
  
          document.getElementById('r_cantidad_horas').value = cantidadHoras;
          document.getElementById('r_total').value = total;
          
      });


      $(document).ready(function() {
        $(document).on('click', '#reserva_guardar', function(event) {
            
       
            Swal.fire({
                title: "¿Quieres registrar la cancha?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Sí, Registrar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {

                    var form_data = new FormData();
                    form_data.append('id', $('#data_cancha_get').attr('value'));
                    form_data.append('r_fecha', $('#r_fecha').val());
                    form_data.append('r_hora_inicio', $('#r_hora_inicio').val());
                    form_data.append('r_hora_final', $('#r_hora_final').val());
    
                    $.ajax({
                        type: "POST",
                        url: "/mi/src/reservar_cancha",
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
                                    title: "Reserva guardada con éxito"
                                });
                            } else if (response == '2') {
                                Toast.fire({
                                    icon: "error",
                                    title: "Error al guardada la reserva"
                                });
                            } else if (response == '3') {
                                Toast.fire({
                                    icon: "warning",
                                    title: "Alerta, Saldo insuficiente"
                                });
                            } else if (response == '4') {
                                Toast.fire({
                                    icon: "info",
                                    title: "Error, Ya se encuentra reservado"
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
    

}

