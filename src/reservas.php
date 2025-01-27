[
  {
    "id": "",
    "title": "",
    "referencia": "",
    "start": "T",
    "end": "T",
    "cancha": "",
    "cliente": "",
    "cantidad_horas": "",
    "total": "",
    "backgroundColor": "",
    "borderColor": "",
    "textColor": ""
  }

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

if($_SESSION['priv'] == '1'){
  $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id  WHERE r.id_cancha = '$id_cancha' AND r.estado != '4'";
} else if($_SESSION['priv'] == '2'){
  $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id  WHERE r.id_cancha = '$id_cancha' AND r.estado != '4'";
} else if($_SESSION['priv'] == '3'){
  $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id  WHERE r.id_cancha = '$id_cancha' AND r.estado != '4' AND r.id_cliente = '$id_cliente'";
}

$resultado = $conex->query($sql);
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
      
      if($fila['estado'] == '1'){
        $title = 'RESERVA';
        $backgroundColor = '#969696';
        $borderColor = '#969696';
        $textColor = '#ffff';
      } else  if($fila['estado'] == '2'){
        $title = 'OCUPADO';
        $backgroundColor = '';
        $borderColor = '';
        $textColor = '';
      } else  if($fila['estado'] == '3'){
        $title = 'COMPLETADO';
        $backgroundColor = '#097301';
        $borderColor = '#097301';
        $textColor = '#ffff';
      }
      
      
      ?>
  
 , {
    "id": "<?= $fila['id']?>",
    "title": "<?= $title ?>",
    "referencia": "<?= $fila['referencia']?>",
    "start": "<?= $fila['r_fecha'] ?>T<?= $fila['r_hora_inicio'] ?>",
    "end": "<?= $fila['r_fecha'] ?>T<?= $fila['r_hora_final'] ?>",
    "cancha": "<?= $fila['nombre'] ?>",
    "cliente": "<?= $fila['nombres'] . ' ' . $fila['apellidos']?>",
    "cantidad_horas": "<?= $fila['cantidad_horas']?>",
    "total": "$<?= $fila['total']?>",
    "backgroundColor": "<?= $backgroundColor ?>",
    "borderColor": "<?= $borderColor  ?>",
    "textColor": "<?= $textColor ?>"
  }


<?php    }
}
$conex->close();
?>

]
