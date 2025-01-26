<?php
include("../config/config.php");
if (isset($_POST['id']) && !empty($_POST['id'])){

    include("../config/openssl_decrypt_pass_cs.php");

    function desencriptar_datos($datos, $clave_secreta) {
        list($encrypted_data, $iv) = explode('::', base64_decode($datos), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $clave_secreta, 0, hex2bin($iv));
    }

    $id_e = $_POST['id'];
    $id = desencriptar_datos($id_e, $clave_secreta);

    $correo = $_POST['correo'];
    $nombres = $_POST['nombres'];
    $priv = $_POST['priv'];
    $pass = $_POST['pass'];
      
    function encryptPassword($pass) {
        return sha1($pass);
    }
    $password = encryptPassword($_POST['pass'] ?? '');

    $data = "SET";
    $data .= " id='$id'";

    if (!empty($correo)) {
        $data .= ", correo='$correo'";
    }
    
    if (!empty($nombres)) {
        $data .= ", nombres='$nombres'";
    }

    if (!empty($priv)) {
        $data .= ", priv='$priv'";
    }

    if (!empty($pass)) {
        $data .= ", pass='$password'";
    }


$sql = "UPDATE usuario $data WHERE id=$id ";
if ($conex->query($sql) === TRUE) { ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Guardando",
            showConfirmButton: false,
            timer: 2000,
        });
    </script>
    <?php
} else { ?>
  
    <script>
    Swal.fire({
        position: "center",
        icon: "error",
        title: "Error",
        showConfirmButton: false,
        timer: 2000,
    });
</script>
  
  
 <?php
}


}else{


    $id = $_SESSION['id'];
    $correo = $_POST['correo'];
    $nombres = $_POST['nombres'];
    $priv = $_POST['priv'];
    $pass = $_POST['pass'];
      
    function encryptPassword($pass) {
        return sha1($pass);
    }
    $password = encryptPassword($_POST['pass'] ?? '');

    $data = "SET";
    $data .= " id='$id'";

    if (!empty($correo)) {
        $data .= ", correo='$correo'";
    }
    
    if (!empty($nombres)) {
        $data .= ", nombres='$nombres'";
    }

    if (!empty($priv)) {
        $data .= ", priv='$priv'";
    }

    if (!empty($pass)) {
        $data .= ", pass='$password'";
    }

$sql = "UPDATE usuario $data WHERE id=$id ";
if ($conex->query($sql) === TRUE) { ?>
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "Guardando",
            showConfirmButton: false,
            timer: 2000,
        });
    </script>
    <?php
} else { ?>
  
    <script>
    Swal.fire({
        position: "center",
        icon: "error",
        title: "Error",
        showConfirmButton: false,
        timer: 2000,
    });
</script>
  
  
 <?php
}




}
?>
