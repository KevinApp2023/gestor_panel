<?php
include("../config/config.php");
include("../config/utils.php"); 

$sql = "SELECT * FROM canchas";
$resultado = $conex->query($sql);
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        include("../config/openssl_decrypt_pass_cs.php");
        $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $id_s = $fila['id'];
        $id = encriptar_datos($id_s, $clave_secreta, $iv);
  
        
        if ($fila['estado'] == 1) {
            $fila['estado'] = '/img/cancha_activa.png';
        } else if ($fila['estado'] == 2) {
            $fila['estado'] = '/img/cancha_inactiva.png';
        }
        ?>

    <div class="col-md-4 col-6">
        <div class="card">
            <img src="<?= $fila['estado'] ?>" class="card-img-top w-100" alt="...">
            <div class="card-body">
              <a href="canchas/<?= $id ?>">
                <h5 class="card-title"><?= $fila['nombre'] ?></h5>
              </a>
            </div>
        </div>
    </div>




        <?php
    }
}
$conex->close();
?>
