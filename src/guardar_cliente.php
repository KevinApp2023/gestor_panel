<?php
include("../config/config.php");

$identificacion = $_POST['identificacion'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo_electronico = $_POST['correo_electronico'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$fecha_registro = new DateTime($_POST['fecha_registro']);
$fecha_registro = $fecha_registro->format('Y-m-d');
$saldo = $_POST['saldo'];
$estado = $_POST['estado'];

$sql = "INSERT INTO clientes (identificacion, nombres, apellidos, correo_electronico, telefono, direccion, fecha_registro, saldo, estado) 
        VALUES ('$identificacion', '$nombres', '$apellidos', '$correo_electronico', '$telefono', '$direccion', '$fecha_registro', '$saldo', '$estado')";

$resultado = $conex->query($sql);

if ($resultado) {
    echo '1';
} else {
    echo '2';
}

$conex->close();
?>
