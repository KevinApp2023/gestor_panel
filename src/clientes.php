<?php
include("../config/config.php");
include("../config/utils.php"); 

$identificacion = $_POST['identificacion'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo_electronico = $_POST['correo_electronico'];
$telefono = $_POST['telefono'];
$estado = $_POST['estado'];

$where = "WHERE 1=1";



if (!empty($identificacion)) { $where .= " AND identificacion LIKE '%$identificacion%'"; }
if (!empty($nombres)) { $where .= " AND nombres LIKE '%$nombres%'"; }
if (!empty($apellidos)) { $where .= " AND apellidos LIKE '%$apellidos%'"; }
if (!empty($correo_electronico)) { $where .= " AND correo_electronico LIKE '%$correo_electronico%'"; }
if (!empty($telefono)) { $where .= " AND telefono LIKE '%$telefono%'"; }
if (!empty($estado)) { $where .= " AND estado = '$estado'"; }


$sql = "SELECT * FROM clientes $where";
$resultado = $conex->query($sql);
if ($resultado->num_rows > 0) {
  while ($fila = $resultado->fetch_assoc()) {
         
  include("../config/openssl_decrypt_pass_cs.php");
  $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
  $id_s = $fila['id'];
  $id = encriptar_datos($id_s, $clave_secreta, $iv);



    if($fila['estado'] == '1'){
        $fila['estado'] = '<a class="btn btn-success">Activo</a>';
    }else{
        $fila['estado'] = '<a class="btn btn-danger">Suspendido</a>';
    }
    ?>
    <tr>
    <td><a class="btn btn-primary p-2" id="editar" value="<?= $id; ?>"  data-bs-toggle="modal" data-bs-target="#editar_cliente"><i value="<?= $id; ?>" class="ri ri-folder-user-fill"></i></a></td>
    <td><?= $fila['identificacion'] ?></td>
    <td><?= $fila['nombres'] ?></td>
    <td><?= $fila['apellidos'] ?></td>
    <td><?= $fila['correo_electronico'] ?></td>
    <td><?= $fila['telefono'] ?></td>
    <td>$<?= $fila['saldo'] ?></td>
    <td><?= $fila['estado'] ?></td>
    </tr>
    <?php
  }
}
$conex->close();
?>

