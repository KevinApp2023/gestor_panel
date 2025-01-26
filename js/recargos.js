
document.addEventListener("DOMContentLoaded", function () {
    filtrar();
});

function filtrar() {
$.ajax({
    url: '/mi/src/recargos',
    method: 'POST',
    data: { 
        referencia: document.getElementById('referencia').value,
        fecha_inicio: document.getElementById('fecha_inicio').value,
        fecha_final: document.getElementById('fecha_final').value,
        identificacion: document.getElementById('identificacion').value,
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
    $('#r_cliente').keypress(function(event) {
        if (event.which === 13) {
            var id = $('#r_cliente').val();
            var data_nuevo_recargo = `
        <div class="mb-3">
                <h6 class="fw-bold border-bottom pb-2">Cliente</h6>
                <div class="mb-2">
                    <label class="fw-bold text-secondary">Identificación:</label>
                    <input readonly type="text"  id="r_identificacion" class="form-control" placeholder="Identificación">
                </div>
                <div class="mb-2">
                    <label class="fw-bold text-secondary">Nombres:</label>
                    <input readonly type="text"  id="r_nombres" class="form-control" placeholder="Nombres">
                </div>
                <div class="mb-2">
                    <label class="fw-bold text-secondary">Apellidos:</label>
                    <input readonly type="text"  id="r_apellidos" class="form-control" placeholder="Apellidos">
                </div>
                <div class="mb-2">
                    <label class="fw-bold text-secondary">Saldo:</label>
                    <input readonly type="text"  id="r_saldo" class="form-control" placeholder="Saldo">
                </div>
            </div>

            <div class="mb-3">
                <h6 class="fw-bold border-bottom pb-2">Factura de Venta</h6>
                <div class="mb-2">
                    <label class="fw-bold">SubTotal</label>
                
                    <div class="input-group">
                      <span class="input-group-text">$</span>
                      <input type="number" id="sub_total" class="form-control" aria-label="Amount (to the nearest dollar)">
                      <span class="input-group-text">.00</span>
                    </div>
                </div>
            </div>`;

            var data_footer_nuevo_recargo = `   <a type="button" id="cancelar" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Cancelar</a>
        <a type="button" id="guardar" class="btn btn-success" data-bs-dismiss="modal"><i class="bi bi-cash-coin me-2"></i>Registrar</a>`;
            
            $('#r_cliente').val(id);
            $('#data_nuevo_recargo').html(data_nuevo_recargo);
            $('#data_footer_nuevo_recargo').html(data_footer_nuevo_recargo);
            $.ajax({
                url: '/mi/src/consultar_cliente',
                method: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(data) {
                    
                    $('#r_identificacion').val(data.identificacion);
                    $('#r_nombres').val(data.nombres);
                    $('#r_apellidos').val(data.apellidos);
                    $('#r_saldo').val(data.saldo);
    
                },
                error: function() {
                    console.log('Error en la solicitud AJAX');
                }
            });
                

  
        }
    });
  });


$(document).ready(function () {
    $(document).on('click', '#factura', function (event) {
        var factura = event.target.getAttribute("data-ref");
        var url = "/facturas/recargos/" + factura;

        var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

        if (isMobile) {
            var link = document.createElement('a');
            link.href = url;
            link.download = 'Factura_Ticket.pdf';
            link.click();
        } else {
            window.open(url, '_blank');
        }
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
                    form_data.append('cliente', $('#r_cliente').val());
                    form_data.append('sub_total', $('#sub_total').val());
                  
                $.ajax({
                    type: "POST",
                    url: "/mi/src/guardar_recargo",
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
                        if (response != '2'){
                            Toast.fire({
                                icon: "success",
                                title: "Recargo generado con exito"
                            }).then(() => {
                               window.location = 'recargos/' + response;
                             });
                        }else  if (response == '2'){
                            Toast.fire({
                                icon: "error",
                                title: "Error al generar el recargo"
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
    $(document).on('click', '#anular_estado', function (event) {
        var cliente = event.target.getAttribute("data-cliente");
        var ref = event.target.getAttribute("data-ref");
        var total = event.target.getAttribute("data-total");
        Swal.fire({
            title: "¿Estás seguro de que deseas anular este recargo?",
            text: "Esta acción no se puede deshacer.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, anular",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                    var form_data = new FormData();
                    form_data.append('cliente', cliente);
                    form_data.append('ref', ref);
                    form_data.append('total', total);
                  
                $.ajax({
                    type: "POST",
                    url: "/mi/src/anular_recargo",
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
                                title: "Recargo anulado con exito"
                            }).then(() => {
                                location.reload();
                             });
                        }else  if (response == '2'){
                            Toast.fire({
                                icon: "error",
                                title: "Error al anular el recargo"
                            }).then(() => {
                                location.reload();
                             });
                        }
                    }
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



$(document).ready(function() {
    $(document).on('click', '#qr_movil', function(event) {
          const qrCamaraMovil = document.getElementById("qr_camara_movil");
    if (qrCamaraMovil) {
        if (qrCamaraMovil.classList.contains("d-none")) {
            qrCamaraMovil.classList.remove("d-none");
            qrCamaraMovil.classList.add("d-block", "d-lg-none");
            $('#qr_movil').html('Ocultar Escáner QR Movil');

        } else {
            qrCamaraMovil.classList.add("d-none");
            qrCamaraMovil.classList.remove("d-block", "d-lg-none");
            $('#qr_movil').html('Abrir Escáner QR Movil');

        }
    }
});
});