
<?php
include("../config/config.php");
include("../config/openssl_decrypt_pass_cs.php");
if (isset($_GET['cancha']) && !empty($_GET['cancha'])){ 

  echo '[
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
';

function desencriptar_datos($datos, $clave_secreta) {
    list($encrypted_data, $iv) = explode('::', base64_decode($datos), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $clave_secreta, 0, hex2bin($iv));
}

$id_e = $_GET['cancha'];
$id_cancha = desencriptar_datos($id_e, $clave_secreta);
$id_cliente = $_SESSION['propietario'];

if($_SESSION['priv'] == '1'){
  $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id  WHERE r.id_cancha = '$id_cancha' AND r.estado != '4' AND r.estado != '3'";
} else if($_SESSION['priv'] == '2'){
  $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id  WHERE r.id_cancha = '$id_cancha' AND r.estado != '4' AND r.estado != '3'";
} else if($_SESSION['priv'] == '3'){
  $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id  WHERE r.id_cancha = '$id_cancha' AND r.estado != '4'  AND r.estado != '3' AND r.id_cliente = '$id_cliente'";
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
echo ']';
}else{

  include("../config/utils.php"); 


  $cancha = $_POST['cancha'];
  $referencia = $_POST['referencia'];
  $fecha_inicio = $_POST['fecha_inicio'];
  $fecha_final = $_POST['fecha_final'];
  $nombres = $_POST['nombres'];
  $apellidos = $_POST['apellidos'];
  $estado = $_POST['estado'];
  




  
  






if($_SESSION['priv'] == '1'){
  $where = "WHERE 1=1";
  if (!empty($cancha)) { $where .= " AND c.nombre = '$cancha'"; }
  if (!empty($referencia)) { $where .= " AND r.referencia LIKE '%$referencia%'"; }
  if (!empty($fecha_inicio) && !empty($fecha_final)) {
      $fecha_inicio = date('Y-m-d', strtotime($fecha_inicio));
      $fecha_final = date('Y-m-d', strtotime($fecha_final));
      $where .= " AND r.r_fecha BETWEEN '$fecha_inicio' AND '$fecha_final'"; }
  if (!empty($nombres)) { $where .= " AND cl.nombres LIKE '%$nombres%'"; }
  if (!empty($apellidos)) { $where .= " AND cl.apellidos LIKE '%$apellidos%'"; }
  if (!empty($estado)) { $where .= " AND r.estado = '$estado'"; }

  $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id  $where ";
} else if($_SESSION['priv'] == '2'){
  $where = "WHERE 1=1";
  if (!empty($cancha)) { $where .= " AND c.nombre = '$cancha'"; }
  if (!empty($referencia)) { $where .= " AND r.referencia LIKE '%$referencia%'"; }
  if (!empty($fecha_inicio) && !empty($fecha_final)) {
      $fecha_inicio = date('Y-m-d', strtotime($fecha_inicio));
      $fecha_final = date('Y-m-d', strtotime($fecha_final));
      $where .= " AND r.r_fecha BETWEEN '$fecha_inicio' AND '$fecha_final'"; }
  if (!empty($nombres)) { $where .= " AND cl.nombres LIKE '%$nombres%'"; }
  if (!empty($apellidos)) { $where .= " AND cl.apellidos LIKE '%$apellidos%'"; }
  if (!empty($estado)) { $where .= " AND r.estado = '$estado'"; }

  $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id $where ";
} else if($_SESSION['priv'] == '3'){
  $where = "WHERE 1=1";
  $id_cliente = $_SESSION['propietario'];
  $where .= " AND r.id_cliente = '$id_cliente'";
  if (!empty($cancha)) { $where .= " AND c.nombre = '$cancha'"; }
  if (!empty($referencia)) { $where .= " AND r.referencia LIKE '%$referencia%'"; }
  if (!empty($fecha_inicio) && !empty($fecha_final)) {
      $fecha_inicio = date('Y-m-d', strtotime($fecha_inicio));
      $fecha_final = date('Y-m-d', strtotime($fecha_final));
      $where .= " AND r.r_fecha BETWEEN '$fecha_inicio' AND '$fecha_final'"; }
  if (!empty($nombres)) { $where .= " AND cl.nombres LIKE '%$nombres%'"; }
  if (!empty($apellidos)) { $where .= " AND cl.apellidos LIKE '%$apellidos%'"; }
  if (!empty($estado)) { $where .= " AND r.estado = '$estado'"; }

  $sql = "SELECT r.*, c.nombre, cl.nombres, cl.apellidos FROM reservas r  JOIN canchas c  JOIN clientes cl ON r.id_cancha = c.id AND  r.id_cliente = cl.id $where";
}

$resultado = $conex->query($sql);
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {

      $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
      $id_s = $fila['id'];
      $id = encriptar_datos($id_s, $clave_secreta, $iv);

      
      if($fila['estado'] == '1'){
        $fila['estado']  = '<a class="btn btn-secondary">Reservado</a>';
      } else if($fila['estado'] == '2'){
        $fila['estado']  = '<a class="btn btn-primary">Ocupado</a>';
      } else if($fila['estado'] == '3'){
        $fila['estado']  = '<a class="btn btn-success">Ocupado</a>';
      } else if($fila['estado'] == '4'){
        $fila['estado']  = '<a class="btn btn-danger">Cancelado</a>';
      }
      ?>
    <tr>
    <td><a class="btn btn-primary p-2" onclick="mostrar_reserva('<?= $fila['id'] ?>')" ><i class="ri ri-arrow-right-circle-line"></i></a></td>
    <td><?= $fila['referencia'] ?></td>
    <td><?= $fila['nombre'] ?></td>
    <td><?= $fila['nombres'] . " " . $fila['apellidos']?></td>
    <td><?= $fila['r_fecha'] ?></td>
    <td><?= $fila['r_hora_inicio'] ?></td>
    <td><?= $fila['r_hora_final'] ?></td>
    <td>$<?= $fila['valor_hora'] ?></td>
    <td><?= $fila['cantidad_horas'] ?></td>
    <td>$<?= $fila['total'] ?></td>
    <td><?= $fila['estado'] ?></td>
    </tr>

<?php    
}
}

}
$conex->close();
?>


