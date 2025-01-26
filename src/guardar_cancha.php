<?php
include("../config/config.php");

$nombre = $_POST['nombre'];
$valor_hora = $_POST['valor_hora'];

$sql = "INSERT INTO canchas (nombre, valor_hora, estado) VALUES ('$nombre', '$valor_hora', '2')";
$resultado = $conex->query($sql);
if ($resultado) {
   echo '1';
} else {
    echo '2';
}

$conex->close();
?>
