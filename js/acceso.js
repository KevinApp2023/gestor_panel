
const checkbox = document.getElementById('ver_pass');
const passwordInput = document.getElementById('pass');

checkbox.addEventListener('change', function() {
    if (checkbox.checked) {
        passwordInput.type = 'mail'; 
    } else {
        passwordInput.type = 'password'; 
    }
});


$(document).ready(function() {
    $('#correo').on('keypress', function(e) {
      if (e.which == 13) { 
        e.preventDefault();
        $('#pass').focus();  
      }
    });
  
    $('#pass').on('keypress', function(e) {
      if (e.which == 13) { 
        e.preventDefault();
        $('#acceso').click(); 
      }
    });
  
    $('#acceso').click(function(e) {
      e.preventDefault(); 
  
      var correo = $('#correo').val();
      var pass = $('#pass').val();
  
      var datos_acceso = {
          correo: correo,
          pass: pass
      };
  
      $.ajax({
        url: '/mi/acceso',  
        method: 'POST',    
        data: datos_acceso,     
        success: function(response) {
          if (response == 'Error 101'){
              appendAlert('El usuario no existe, Intente nuevamente con un usuario diferente!')
          }else if (response == 'Error 102'){
              appendAlert('Contraseña incorrecta, Intente nuevamente con una nueva contraseña!')
          }else if (response == 'Active'){
              location.reload();
            }else if (response == 'Acceso Denegado'){
              appendAlert('Acceso denegado, Intente nuevamente dentro de 24 horas!')
          }
        },
        error: function(xhr, status, error) {
          alert("Error: " + error);
        }
      });
    });
  });


  

const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
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





function generarPin() {
    return Math.floor(100000 + Math.random() * 900000);
    }


$(document).ready(function() {
    $('#res_pass').click(function(e) {
        e.preventDefault(); 
        $.ajax({
            type: "POST",
            url: '/mi/res_pass?s=1',  
            contentType: false,
            processData: false,
            success: function(response) {
              $('#container_acceso').html(response);
        
            }
        });
    });
});



function continuar_pass_pin() {
    var pin = generarPin(); 
    var correo = $('#correo').val();
    var form_data = new FormData();
    form_data.append('correo', correo);
    form_data.append('pin', pin);

    $.ajax({
        type: "POST",
        url: '/mi/res_pass?s=2',
        data: form_data,
        contentType: false,
        processData: false,
        success: function(response) {
            $('#container_acceso').html(response);

            $.ajax({
                type: "POST",
                url: "/mi/phpmailer_ress",
                data: form_data,
                contentType: false,
                processData: false,
                success: function(responseMailer) {
                    console.log("Correo enviado:", responseMailer);
                },
                error: function() {
                    console.error("Error al enviar el correo.");
                }
            });
        },
        error: function() {
            console.error("Error en la primera solicitud AJAX.");
        }
    });
}


