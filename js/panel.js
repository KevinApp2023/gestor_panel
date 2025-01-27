const currentPath = window.location.pathname + window.location.hash;
if (currentPath.includes('/clientes/panel')){

    document.addEventListener("DOMContentLoaded", function () {
        $.ajax({
            url: '/mi/src/recargos',
            method: 'POST',
            data: { 
                referencia: '',
                fecha_inicio: '',
                fecha_final: '',
                identificacion: '',
                nombres: '',
                apellidos: '',
                estado: ''
        
            },
            success: function(response) {
                $('#resultadoBusqueda').html(response);
            }
        });

    });






}
