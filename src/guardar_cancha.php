<?php
include("../config/config.php");

$nombre = $_POST['nombre'];

$sql = "INSERT INTO canchas (nombre, estado) VALUES ('$nombre', '2')";
$resultado = $conex->query($sql);
if ($resultado) {
   echo '1';
} else {
    echo '2';
}

$conex->close();
?>
