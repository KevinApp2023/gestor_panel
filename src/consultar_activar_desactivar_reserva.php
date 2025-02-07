<?php
include("../config/config.php");

$sql_reservas_activas = "SELECT id, id_cancha FROM reservas WHERE r_fecha = '$fecha' AND '$hora' BETWEEN r_hora_inicio AND r_hora_final";
$resultado_reservas_activas = $conex->query($sql_reservas_activas);

if ($resultado_reservas_activas->num_rows > 0) {
    while ($reserva = $resultado_reservas_activas->fetch_assoc()) {
        $id_reserva = $reserva['id'];
        $id_cancha = $reserva['id_cancha'];
        
        $update_estado_cancha = "UPDATE canchas SET estado = 1 WHERE id = $id_cancha";
        $conex->query($update_estado_cancha);

        $update_estado_reserva = "UPDATE reservas SET estado = 2 WHERE id = $id_reserva";
        $conex->query($update_estado_reserva);
    }
}

$sql_reservas_finalizadas = "SELECT id, id_cancha FROM reservas WHERE r_fecha < '$fecha' OR (r_fecha = '$fecha' AND r_hora_final <= '$hora')";
$resultado_reservas_finalizadas = $conex->query($sql_reservas_finalizadas);

if ($resultado_reservas_finalizadas->num_rows > 0) {
    while ($reserva = $resultado_reservas_finalizadas->fetch_assoc()) {
        $id_reserva = $reserva['id'];
        $id_cancha = $reserva['id_cancha'];
        
        $update_estado_cancha = "UPDATE canchas SET estado = 2 WHERE id = $id_cancha";
        $conex->query($update_estado_cancha);

        $update_estado_reserva = "UPDATE reservas SET estado = 3 WHERE id = $id_reserva";
        $conex->query($update_estado_reserva);
    }
}
?>