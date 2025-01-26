
document.addEventListener("DOMContentLoaded", function () {
    filtrar();
});

function filtrar() {
$.ajax({
    url: '/mi/src/usuarios',
    method: 'POST',
    data: { 
        priv: document.getElementById('priv').value,
        correo: document.getElementById('correo').value,
        nombres: document.getElementById('nombres').value
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
        $('#guardar').attr('value', '');
        $('#eliminar').attr('value', '');
        $('#exampleModalFullscreenLabel').html('');
        $('#b_correo').val('');
        $('#b_nombres').val('');
        $('#sb_priv').val('');
        $('#sb_priv').html('');
        
        var id = event.target.getAttribute("value");
        $('#guardar').attr('value', id);
        $('#eliminar').attr('value', id);
        $.ajax({
            url: '/mi/src/consultar_usuario',
            method: 'POST',
            data: { id: id },
            dataType: 'json',
            success: function(data) {
                $('#exampleModalFullscreenLabel').html(data.nombres);
                $('#b_correo').val(data.correo);
                $('#b_nombres').val(data.nombres);
                $('#sb_priv').html(data.val_priv);
                $('#sb_priv').attr('value', data.priv);

            },
            error: function() {
                console.log('Error en la solicitud AJAX');
            }
        });
    });
});


$(document).ready(function() {
    $(document).on('click', '#cancelar', function(event) {
        $('#guardar').attr('value', '');
        $('#eliminar').attr('value', '');
        $('#exampleModalFullscreenLabel').html('');
        $('#b_correo').val('');
        $('#b_nombres').val('');
        $('#sb_privilegios').val('');
        $('#sb_privilegios').html('');
    });
});