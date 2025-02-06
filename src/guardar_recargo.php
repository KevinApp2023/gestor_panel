<?php 
include("../config/config.php");
include("../config/utils.php");

$unique_sub_total = $_POST['sub_total'];
$unique_cliente_encrypted = $_POST['cliente'];
$referencia = $l_consecutivo . $n_consecutivo;
$d_iva = $_POST['iva'];
if ($d_iva == '1'){
$r_iva = ($unique_sub_total * $iva) / 100;
$tipo = '1'; //con iva
}else{
$r_iva = '0';
$tipo = '2'; //sin iva

}

include("../config/openssl_decrypt_pass_cs.php");

function unique_desencriptar_datos($unique_datos, $unique_clave_secreta) {
    list($unique_encrypted_data, $unique_iv) = explode('::', base64_decode($unique_datos), 2);
    return openssl_decrypt($unique_encrypted_data, 'aes-256-cbc', $unique_clave_secreta, 0, hex2bin($unique_iv));
}

$unique_cliente = unique_desencriptar_datos($unique_cliente_encrypted, $clave_secreta);

$unique_sql_bonos = "SELECT * FROM bonos WHERE base <= '$unique_sub_total' ORDER BY base DESC LIMIT 1";
$unique_resultado_bonos = $conex->query($unique_sql_bonos);

if ($unique_resultado_bonos->num_rows >= 1) {
    while ($unique_fila_bonos = $unique_resultado_bonos->fetch_assoc()) {
        if ($unique_fila_bonos['tipo'] == 1) {
            $bono = $unique_fila_bonos['cantidad'];
        } else if ($unique_fila_bonos['tipo'] == 2) {
            $bono = ($unique_sub_total * $unique_fila_bonos['cantidad']) / 100;
        }else{
            $bono = '0';
        }
    }
}else{
    $bono = '0';
}

$r_saldo = $unique_sub_total + $bono;
$unique_total = $unique_sub_total + $r_iva;


$unique_sql_insert = "INSERT INTO recargos (referencia, fecha, hora, cliente, sub_total, bono, iva, total, tipo, estado) VALUES ('$referencia', '$fecha', '$hora', '$unique_cliente', '$unique_sub_total', '$bono', '$r_iva', '$unique_total', '$tipo', '1')";
$unique_resultado_insert = $conex->query($unique_sql_insert);

if ($unique_resultado_insert) {
        $unique_sql_update_saldo = "UPDATE clientes SET saldo = saldo + '$r_saldo' WHERE id = '$unique_cliente'";
        $unique_resultado_update_saldo = $conex->query($unique_sql_update_saldo);
        if ($unique_resultado_update_saldo) {
            $nuevo_n_consecutivo_consecutivo = $n_consecutivo + 1;
            $sql_up_n_consecutivo = "UPDATE config SET data = '$nuevo_n_consecutivo_consecutivo' WHERE name = 'n_consecutivo'";
            $resul_sql_up_n_consecutivo = $conex->query($sql_up_n_consecutivo);
            if ($resul_sql_up_n_consecutivo) {
                echo $referencia;
            }else{
                echo '2';
            }

        } else {
            echo '2';
        }
} else {
    echo '2';
}
$conex->close();
?>
