<?php
include("../config/config.php");
include("../config/utils.php"); 

$identificacion = $_POST['identificacion'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$correo_electronico = $_POST['correo_electronico'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$fecha_registro = $_POST['fecha_registro'];
$saldo = $_POST['saldo'];
$estado = $_POST['estado'];

$sql = "INSERT INTO clientes (identificacion, nombres, apellidos, correo_electronico, telefono, direccion, perfil, fecha_registro, saldo, estado) 
        VALUES ('$identificacion', '$nombres', '$apellidos', '$correo_electronico', '$telefono', '$direccion', '', '$fecha_registro', '$saldo', '$estado')";

$resultado = $conex->query($sql);

if ($resultado) {
    $recuperar_id = $conex->insert_id;
    $nombres_usuario = $nombres . " " . $apellidos;

    function encryptPassword($identificacion) {
        return sha1($identificacion);
    }
    $password = encryptPassword($identificacion ?? '');
    
    $sql_crear_usuario = "INSERT INTO usuario (correo, nombres, pass, propietario, priv) 
    VALUES ('$correo_electronico', '$nombres_usuario', '$password', '$recuperar_id', '3')";
    $resultado_crear_usuario = $conex->query($sql_crear_usuario);
    if ($resultado_crear_usuario) {}


    include("../config/openssl_decrypt_pass_cs.php");
    $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $data = encriptar_datos($recuperar_id, $clave_secreta, $iv);
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/js/qr_cliente.js"></script>
    <div id="qrcode"></div>
    <script type="text/javascript">
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width: 100,
            height: 100
        });

        function makeCode() {
            qrcode.makeCode('<?= $data ?>');
        }
        makeCode();

        $(document).ready(function () {
            const canvas = document.querySelector("#qrcode canvas");
            const imageData = canvas.toDataURL("image/png"); 
            $.ajax({
                url: "/mi/src/guardar_qr",
                method: "POST",
                data: {
                    image: imageData,
                    data: '<?= $recuperar_id ?>'
                },
                success: function (response) {
                },
                error: function () {
                }
            });
        });
    </script>

    <?php
} else {
    echo '2';
}

$conex->close();
?>
