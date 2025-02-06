<?php
include("../config/config.php");
if (isset($_POST['perfil']) && !empty($_POST['perfil'])) {
    if (isset($_SESSION['propietario']) && !empty($_SESSION['propietario'])) {
        $id = $_SESSION['propietario'];
        $identificacion = $_POST['identificacion'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $correo_electronico = $_POST['correo_electronico'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $sql = "UPDATE clientes SET identificacion='$identificacion', nombres='$nombres', apellidos='$apellidos', correo_electronico='$correo_electronico', telefono='$telefono', direccion='$direccion' WHERE id = '$id'";
        $resultado = $conex->query($sql);
        if ($resultado) {
            echo '1';
        } else {
            echo '2';
        }
    } else {
        echo '2';
    }
} else if (isset($_POST['pass']) && !empty($_POST['pass'])) {
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $sql = "SELECT id, correo, nombres, pass, propietario, priv FROM usuario WHERE id='$id'";
    $resultado = $conex->query($sql);
    $num = $resultado->num_rows;
    if ($num > 0) {
      $row = $resultado->fetch_assoc();
      $pass_bd = $row['pass'];
      $pass_actual = sha1($_POST['pass_actual']);
  
     
      if($pass_bd == $pass_actual){
        if($_POST['n_pass'] == $_POST['r_n_pass']){
            if($_POST['pass_actual'] != $_POST['n_pass']){
                $n_pass = sha1($_POST['n_pass']);
                $sql = "UPDATE usuario SET pass='$n_pass' WHERE id = '$id'";
                $resultado = $conex->query($sql);
                if ($resultado) {
                    echo 'Active';
                } else {
                    echo 'Error 201';
                }
            }else{
                echo "Error 123";
            }
        }else{
            echo "Error 122";
        }
    }else{
        echo "Error 121";
    }


   



    }else{
      echo "Error 201";
    }


       
        
       


    }
}
$conex->close();
?>