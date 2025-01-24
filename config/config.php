<?php
$conex = mysqli_connect("localhost","root","","gestor_padel"); 
$conexion = mysqli_connect("localhost","root","","gestor_padel"); 
$pdo = mysqli_connect("localhost","root","","gestor_padel"); 

session_start();
date_default_timezone_set('America/Bogota');

if (!isset($_SESSION['acceso'])) {
    $_SESSION['acceso'] = 0; 
}


$requestUri = $_SERVER['REQUEST_URI'];

if (preg_match('#^/admin/#', $requestUri)) {

    if (!isset($_SESSION['priv']) || $_SESSION['priv'] != 1) {
        header("Location: /");
        exit();
    }

} else if (preg_match('#^/panel/#', $requestUri)) {

   if (!isset($_SESSION['priv']) || $_SESSION['priv'] != 2) {
    header("Location: /");
        exit();
    }

} else if (preg_match('#^/clientes/#', $requestUri)) {
    
    if (!isset($_SESSION['priv']) || $_SESSION['priv'] != 3) {
        header("Location: /");
        exit();
        }

}



$consult = "SELECT * FROM config WHERE name IN ('title', 'keywords', 'description', 'icon', 'lang', 'NIT', 'mail_Host', 'mail_Username', 'mail_Password', 'mail_Port', 'mail_setFrom')";
$resultado = $conex->query($consult);

if ($resultado->num_rows > 0) {
    while ($data = $resultado->fetch_assoc()) {
        switch ($data['name']) {
            case 'title':
                $title = $data['data'];
                break;
            case 'keywords':
                $keywords = $data['data'];
                break;
            case 'description':
                $description = $data['data'];
                break;
            case 'icon':
                $icon = $data['data'];
                break;
            case 'lang':
                $lang = $data['data'];
                break;
           
            case 'NIT':
                $NIT = $data['data'];
                break;
  
            case 'mail_Host':
                $mail_Host = $data['data'];
                break;
            
            case 'mail_Username':
                $mail_Username = $data['data'];
                break;

            case 'mail_Password':
                $mail_Password = $data['data'];
                break;
            
            case 'mail_Port':
                $mail_Port = $data['data'];
                break;

            case 'mail_setFrom':
                $mail_setFrom = $data['data'];
                break;
            
        }
    }
}


?>