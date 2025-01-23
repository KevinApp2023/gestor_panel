<?php
include("../config/config.php");
$ip = file_get_contents('https://api64.ipify.org');
$fecha = date('Y-m-d');
$hora = date('H:i:s');



$consult_ip = "SELECT * FROM ip_reportadas WHERE ip = '$ip' AND fecha = '$fecha' ";
$result_ip = $conex->query($consult_ip);
if ($result_ip->num_rows >= 1) {
  echo 'Acceso Denegado';

}else{



if ( $_SESSION['acceso'] >= '5'){

  $correo = $_POST['correo'];
  $sql = "INSERT INTO ip_reportadas (fecha, hora, correo, ip) VALUES (?, ?, ?, ?)";
  $stmt = $conex->prepare($sql);
  $stmt->bind_param("ssss", $fecha, $hora, $correo, $ip);

  if ($stmt->execute()) {
    $_SESSION['acceso'] = 0; 
    echo 'Acceso Denegado';
  }

$stmt->close();
 


}else{

if(!empty($_POST['correo']) & !empty($_POST['pass']) ){
             
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];

    $sql = "SELECT id, correo, pass, propietario, priv FROM usuario WHERE correo='$correo'";
    $resultado = $conex->query($sql);
    $num = $resultado->num_rows;
    if ($num > 0) {
      
      $row = $resultado->fetch_assoc();
      $pass_bd = $row['pass'];
      $pass_c = sha1($pass);
  
      if ($pass_bd == $pass_c) {
        $_SESSION['id'] = $row['id'];
        $_SESSION['correo'] = $row['correo'];
        $_SESSION['pass'] = $_POST['pass'];
        $_SESSION['propietario'] = $row['propietario'];
        $_SESSION['priv'] = $row['priv'];
        $_SESSION['acceso'] = 0; 

        echo "Active";
      }else{
        echo "Error 102";
        $_SESSION['acceso'] += 1;
      }
   
    }else{
      echo "Error 101";
    }
  
  }
}
}
?>