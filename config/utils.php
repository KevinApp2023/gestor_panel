<?php
// utils.php
function encriptar_datos($datos, $clave_secreta, $iv) {
    return base64_encode(openssl_encrypt($datos, 'aes-256-cbc', $clave_secreta, 0, $iv) . '::' . bin2hex($iv));
}
?>
