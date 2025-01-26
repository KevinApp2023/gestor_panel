<?php
include("../config/config.php");
include("../config/utils.php"); 

$correo = $_POST['correo'];
$nombres = $_POST['nombres'];
$priv = $_POST['priv'];

$where = "WHERE 1=1";


if (!empty($correo)) { $where .= " AND correo LIKE '%$correo%'"; }
if (!empty($nombres)) { $where .= " AND nombres LIKE '%$nombres%'"; }
if (!empty($priv)) { $where .= " AND priv = '$priv'"; }


$sql = "SELECT * FROM usuario $where";
$resultado = $conex->query($sql);
if ($resultado->num_rows > 0) {
  while ($fila = $resultado->fetch_assoc()) {
         
  include("../config/openssl_decrypt_pass_cs.php");
  $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
  $id_s = $fila['id'];
  $id = encriptar_datos($id_s, $clave_secreta, $iv);

    if($fila['priv'] == '1'){
        $fila['priv'] = 'Administrador';
    }else if($fila['priv'] == '2'){
        $fila['priv'] = 'Cabina';
     }else if($fila['priv'] == '3'){
        $fila['priv'] = 'Cliente';

    }
    ?>
    <tr>
    <td><a class="btn btn-primary p-2" id="editar" value="<?= $id; ?>"  data-bs-toggle="modal" data-bs-target="#editar_usuario"><i value="<?= $id; ?>" class="bx bxs-user-account"></i></a></td>
    <td><?= $fila['correo'] ?></td>
    <td><?= $fila['nombres'] ?></td>
    <td><?= $fila['priv'] ?></td>
    </tr>
    <?php
  }
}
$conex->close();
?>

