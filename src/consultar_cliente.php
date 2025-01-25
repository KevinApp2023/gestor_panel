<?php
include("../config/config.php");
if ($conex->connect_error) {
    die("Conexión fallida: " . $conex->connect_error);
}

if (isset($_POST['id']) && !empty($_POST['id'])) {
    include("../config/openssl_decrypt_pass_cs.php");
    function desencriptar_datos($datos, $clave_secreta) {
        list($encrypted_data, $iv) = explode('::', base64_decode($datos), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $clave_secreta, 0, hex2bin($iv));
    }
    $id_e = $_POST['id'];
    $id = desencriptar_datos($id_e, $clave_secreta);

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

 
