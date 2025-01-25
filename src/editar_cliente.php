<?php
include("../config/config.php");

$identificacion = $_POST['identificacion'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo_electronico = $_POST['correo_electronico'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$fecha_registro = $_POST['fecha_registro'];
$saldo = $_POST['saldo'];
$estado = $_POST['estado'];

if (isset($_POST['id']) && !empty($_POST['id'])) {
    include("../config/openssl_decrypt_pass_cs.php");

    function desencriptar_datos($datos, $clave_secreta) {
        list($encrypted_data, $iv) = explode('::', base64_decode($datos), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $clave_secreta, 0, hex2bin($iv));
    }

    $id_e = $_POST['id'];
    $id = desencriptar_datos($id_e, $clave_secreta);

    $sql = "UPDATE clientes SET identificacion='$identificacion', nombres='$nombres', apellidos='$apellidos', correo_electronico='$correo_electronico', telefono='$telefono', direccion='$direccion', fecha_registro='$fecha_registro', saldo='$saldo', estado='$estado' WHERE id = '$id'";

    $resultado = $conex->query($sql);

    if ($resultado) {
        echo '1';
    } else {
        echo '2';
    }
} else {
    echo '2';
}

$conex->close();
?>
