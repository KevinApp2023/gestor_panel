[

<?php
include("../config/config.php");
include("../config/openssl_decrypt_pass_cs.php");

function desencriptar_datos($datos, $clave_secreta) {
    list($encrypted_data, $iv) = explode('::', base64_decode($datos), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $clave_secreta, 0, hex2bin($iv));
}

$id_e = $_GET['cancha'];
$id_cancha = desencriptar_datos($id_e, $clave_secreta);
$id_cliente = $_SESSION['propietario'];

$sql = "SELECT r.*, c.nombre FROM reservas r LEFT JOIN canchas c ON r.id_cancha = c.id WHERE r.id_cancha = '$id_cancha'";

$resultado = $conex->query($sql);
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) { ?>
  
  {
    "title": "RESERVA",
    "start": "<?= $fila['r_fecha'] ?>T<?= $fila['r_hora_inicio'] ?>",
    "end": "<?= $fila['r_fecha'] ?>T<?= $fila['r_hora_final'] ?>",
    "cancha": "<?= $fila['nombre'] ?>"
  }


<?php    }
}
$conex->close();
?>

]
