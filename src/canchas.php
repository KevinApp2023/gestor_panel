<?php
include("../config/config.php");
include("../config/utils.php"); 

$sql = "SELECT * FROM canchas";
$resultado = $conex->query($sql);
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        include("../config/openssl_decrypt_pass_cs.php");
        $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $id_s = $fila['id'];
        $id = encriptar_datos($id_s, $clave_secreta, $iv);
  
        
        $id_cancha = $fila['id'];
        $sql_reservas_activas = "SELECT id, id_cancha, r_hora_inicio, r_hora_final FROM reservas WHERE id_cancha = '$id_cancha' AND r_fecha = '$fecha' AND '$hora' BETWEEN r_hora_inicio AND r_hora_final";
$resultado_reservas_activas = $conex->query($sql_reservas_activas);

if ($resultado_reservas_activas->num_rows > 0) {
    while ($reserva = $resultado_reservas_activas->fetch_assoc()) {
        $fila['estado'] = '/img/cancha_activa.png';
        $r_hora_inicio = $reserva['r_hora_inicio'];
        $r_hora_final = $reserva['r_hora_final'];
        $disponibilidad = "<a class='btn btn-danger w-100'><i class='bi bi-alarm-fill me-2'></i> $r_hora_inicio > $r_hora_final</a>";
    }
}else{
    $fila['estado'] = '/img/cancha_inactiva.png';
    $disponibilidad = '<a class="btn btn-primary w-100">Disponible</a>';
}
        ?>

    <div class="col-md-4 col-6">
        <div class="card">
            <img src="<?= $fila['estado'] ?>" class="card-img-top w-100" alt="...">
            <?= $disponibilidad ?>
            <div class="card-body">
              <a href="canchas/<?= $id ?>">
                <h5 class="card-title"><?= $fila['nombre'] ?></h5>
              </a>
            </div>
        </div>
    </div>
        <?php
    }
}
$conex->close();
?>