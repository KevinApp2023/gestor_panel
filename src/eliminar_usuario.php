<?php
include("../config/config.php");
if (isset($_GET['id']) && !empty($_GET['id'])) {
    include("../config/openssl_decrypt_pass_cs.php");

    function desencriptar_datos($datos, $clave_secreta) {
        list($encrypted_data, $iv) = explode('::', base64_decode($datos), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $clave_secreta, 0, hex2bin($iv));
    }

    $id_e = $_GET['id'];
    $id = desencriptar_datos($id_e, $clave_secreta);

    $sql = "DELETE FROM usuario WHERE id = '$id'";
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