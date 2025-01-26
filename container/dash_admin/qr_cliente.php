<?php
include("../../config/config.php");
include("../../config/utils.php"); 
    $recuperar_id = '1';
    include("../../config/openssl_decrypt_pass_cs.php");
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
                    data: '<?= $data ?>'
                },
                success: function (response) {
                },
                error: function () {
                }
            });
        });
    </script>



    <?php

$conex->close();
?>
