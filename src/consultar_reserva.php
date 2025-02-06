<?php
include("../config/config.php");
include("../config/utils.php"); 
include("../config/openssl_decrypt_pass_cs.php");

$id = $_POST['id'];
$id_cliente = $_SESSION['propietario'];

if($_SESSION['priv'] == '1'){
    $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id  WHERE r.id = '$id'";
  } else if($_SESSION['priv'] == '2'){
    $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id  WHERE r.id = '$id'";
  } else if($_SESSION['priv'] == '3'){
    $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id  WHERE r.id = '$id'";
  }

$resultado = $conex->query($sql);
if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();

    include("../config/openssl_decrypt_pass_cs.php");
    $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $id_s = $fila['id'];
    $fila['id'] = encriptar_datos($id_s, $clave_secreta, $iv);

    

    if($fila['estado'] == '1'){
        $fila['estado'] = 'RESERVA';
    } else if($fila['estado'] == '2'){
      $fila['estado'] = 'OCUPADO';
    } else if($fila['estado'] == '3'){
      $fila['estado'] = 'COMPLETADO';
    } else if($fila['estado'] == '4'){
      $fila['estado'] = 'CANCELADA';
    }

    echo json_encode($fila);

   
} else {
    echo json_encode(array());
}
$conex->close();
?>
