<?php
include("../config/config.php");
include("../config/utils.php"); 

$desde = mysqli_real_escape_string($conex, $_POST['desde']);
$fecha_inicio = mysqli_real_escape_string($conex, $_POST['fecha_inicio']);
$fecha_final = mysqli_real_escape_string($conex, $_POST['fecha_final']);
$tipo = mysqli_real_escape_string($conex, $_POST['tipo']);

$where = "WHERE 1=1";

if (!empty($desde)) { 
    $where .= " AND base = '$desde'"; 
}

if (!empty($fecha_inicio) && !empty($fecha_final)) {
    $fecha_inicio = date('Y-m-d', strtotime($fecha_inicio));
    $fecha_final = date('Y-m-d', strtotime($fecha_final));
    $where .= " AND fecha BETWEEN '$fecha_inicio' AND '$fecha_final'";
}

if (!empty($tipo)) { 
    $where .= " AND tipo = '$tipo'"; 
}
$sql = "SELECT * FROM bonos $where";
$resultado = $conex->query($sql);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {

        include("../config/openssl_decrypt_pass_cs.php");
        $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $id_s = $fila['id'];
        $id = encriptar_datos($id_s, $clave_secreta, $iv);

        
        if ($fila['tipo'] == 1) {
            $fila['tipo'] = 'Sumatoria';
        } else {
            $fila['tipo'] = 'Porcentaje';
        }
        ?>
        <tr>
        <td><a class="btn btn-primary p-2" id="eliminar" value="<?= $id; ?>"  data-bs-toggle="modal" data-bs-target="#editar_cliente"><i value="<?= $id; ?>" class="bi bi-trash-fill"></i></a></td>
        <td><?= $fila['fecha'] ?></td>
        <td><?= $fila['hora'] ?></td>
        <td><?= $fila['base'] ?></td>
        <td><?= $fila['tipo'] ?></td>
        <td><?= $fila['cantidad'] ?></td>
        </tr>
        <?php
    }
}
$conex->close();
?>
