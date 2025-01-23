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
?>