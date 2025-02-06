
$(document).ready(function() {
    $(document).on('click', '#guardar_cambios_general', function(event) {
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
                    form_data.append('general', 'data');
                    form_data.append('icon', $('#input_file_icon')[0].files[0]);
                    form_data.append('title', $('#title').val());
                    form_data.append('RIF', $('#RIF').val());
                    form_data.append('description', $('#description').val());
                    form_data.append('keywords', $('#keywords').val());
                    form_data.append('direccion', $('#direccion').val());
                    form_data.append('telefono', $('#telefono').val());
                    form_data.append('l_consecutivo', $('#l_consecutivo').val());
                    form_data.append('n_consecutivo', $('#n_consecutivo').val());
                  
                $.ajax({
                    type: "POST",
                    url: "/mi/src/guardar_cambios_config_general",
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
    $(document).on('click', '#guardar_cambios_smtp', function(event) {
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
                    form_data.append('smtp', 'data');
                    form_data.append('mail_Host', $('#mail_Host').val());
                    form_data.append('mail_Username', $('#mail_Username').val());
                    form_data.append('mail_Password', $('#mail_Password').val());
                    form_data.append('mail_Port', $('#mail_Port').val());
                    form_data.append('mail_setFrom', $('#mail_setFrom').val());
                 
                $.ajax({
                    type: "POST",
                    url: "/mi/src/guardar_cambios_config_general",
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
    $(document).on('click', '#abrir_input_file_icon', function(event) {
        var input_file_icon = document.getElementById("input_file_icon").click();

    });
});

function mostrarImagenSeleccionada(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('icon').src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  
  document.getElementById('input_file_icon').addEventListener('change', function() {
    mostrarImagenSeleccionada(this);
  });
  