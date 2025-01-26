<?php 
include("../config/config.php");

$cliente = $_POST['cliente'];
$total = $_POST['total'];
$ref = $_POST['ref'];


    $unique_sql_update_referencia = "UPDATE recargos SET estado='2' WHERE referencia = '$ref'";
    $unique_resultado_update_referencia = $conex->query($unique_sql_update_referencia);

    if ($unique_resultado_update_referencia) {
        $unique_sql_update_saldo = "UPDATE clientes SET saldo = saldo - '$total' WHERE id = '$cliente'";
        $unique_resultado_update_saldo = $conex->query($unique_sql_update_saldo);

        if ($unique_resultado_update_saldo) {
            echo '1';
        } else {
            echo '2';
        }
    } else {
        echo '2';
    }

$conex->close();
?>
