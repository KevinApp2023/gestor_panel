
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


document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var cancha = $('#cancha').val()
    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prevYear,prev,next,nextYear',
        center: 'title',
        right: 'dayGridMonth,dayGridWeek,dayGridDay,listWeek',
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
        Swal.fire({
          title: eventObj.title,
          html: `
            <table style="width: 100%; border-collapse: collapse;">
              <tr>
                <th style="text-align: left; border: 1px solid #ddd; padding: 8px;">Cancha</th>
                <td style="border: 1px solid #ddd; padding: 8px;">${info.event.extendedProps.cancha || 'No disponible'}</td>
              </tr>
              <tr>
                <th style="text-align: left; border: 1px solid #ddd; padding: 8px;">Fecha y hora de inicio</th>
                <td style="border: 1px solid #ddd; padding: 8px;">${info.event.start ? info.event.start.toLocaleString() : 'No disponible'}</td>
              </tr>
              <tr>
                <th style="text-align: left; border: 1px solid #ddd; padding: 8px;">Fecha y hora final</th>
                <td style="border: 1px solid #ddd; padding: 8px;">${info.event.end ? info.event.end.toLocaleString() : 'No disponible'}</td>
              </tr>
            </table>
          `,
        });
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
  });
  



