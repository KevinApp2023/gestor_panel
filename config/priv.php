<?php
include("../config/config.php");
if (isset($_SESSION['priv'])){
    if ($_SESSION['priv'] == 1) {
        header('Location: /admin/panel');
    }else if ($_SESSION['priv'] == 2) {
        header('Location: /cabina/panel');
    }else if ($_SESSION['priv'] == 3) {
        header('Location: /clientes/panel');
    }else{
        header('Location: /');
    }
}else{
    header('Location: /');
}
?>