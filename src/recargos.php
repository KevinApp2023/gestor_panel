<?php
include("../config/config.php");
include("../config/utils.php"); 


$referencia = $_POST['referencia'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];
$identificacion = $_POST['identificacion'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];

$where = "WHERE 1=1";

if (!empty($referencia)) { $where .= " AND r.referencia LIKE '%$referencia%'"; }

if (!empty($fecha_inicio) && !empty($fecha_final)) {
    $fecha_inicio = date('Y-m-d', strtotime($fecha_inicio));
    $fecha_final = date('Y-m-d', strtotime($fecha_final));
    $where .= " AND r.fecha BETWEEN ? AND ?";
}

if (!empty($identificacion)) { $where .= " AND c.identificacion LIKE '%$identificacion%'"; }
if (!empty($nombres)) { $where .= " AND c.nombres LIKE '%$nombres%'"; }
if (!empty($apellidos)) { $where .= " AND c.apellidos LIKE '%$apellidos%'"; }


$sql = "SELECT r.*, c.identificacion, c.nombres, c.apellidos FROM recargos r LEFT JOIN clientes c ON r.cliente = c.id $where";
$resultado = $conex->query($sql);
if ($resultado->num_rows > 0) {
  while ($fila = $resultado->fetch_assoc()) {
         
  include("../config/openssl_decrypt_pass_cs.php");
  $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
  $id_s = $fila['id'];
  $id = encriptar_datos($id_s, $clave_secreta, $iv);

    ?>
    <tr>
    <td><a class="btn btn-primary p-2" href="/admin/recargos/<?= $fila['referencia'] ?>" ><i class="ri ri-arrow-right-circle-line"></i></a></td>
    <td><?= $fila['referencia'] ?></td>
    <td><?= $fila['fecha'] ?></td>
    <td><?= $fila['hora'] ?></td>
    <td><?= $fila['identificacion'] ?></td>
    <td><?= $fila['nombres'] ?></td>
    <td><?= $fila['apellidos'] ?></td>
    <td>$<?= $fila['total'] ?></td>
    </tr>
    <?php
  }
}
$conex->close();
?>

