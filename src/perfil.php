<?php
include("../config/config.php");
if ($conex->connect_error) {
    die("Conexión fallida: " . $conex->connect_error);
}

if (isset($_SESSION['propietario']) && !empty($_SESSION['propietario'])) {
    $id = $_SESSION['propietario'];
    $sql = "SELECT * FROM clientes WHERE id = '$id'";
    $resultado = $conex->query($sql);
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        echo json_encode($fila);
    } else {
        echo json_encode(array());
    }
} else {
    echo json_encode(array());
}
$conex->close();
?>

 
