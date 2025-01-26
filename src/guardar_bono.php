<?php
include("../config/config.php");

$base = $_POST['desde'];
$tipo = $_POST['tipo'];
$cantidad = $_POST['cantidad'];

$sql = "INSERT INTO bonos (fecha, hora, base, tipo, cantidad) VALUES ('$fecha', '$hora', '$base', '$tipo', '$cantidad')";
$resultado = $conex->query($sql);
if ($resultado) {
   echo '1';
} else {
    echo '2';
}

$conex->close();
?>
