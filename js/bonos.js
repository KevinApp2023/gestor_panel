
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
