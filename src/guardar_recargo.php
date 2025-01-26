<?php 
include("../config/config.php");
include("../config/utils.php");

$unique_sub_total = $_POST['sub_total'];
$unique_total = $unique_sub_total;
$unique_cliente_encrypted = $_POST['cliente'];
include("../config/openssl_decrypt_pass_cs.php");

function unique_desencriptar_datos($unique_datos, $unique_clave_secreta) {
    list($unique_encrypted_data, $unique_iv) = explode('::', base64_decode($unique_datos), 2);
    return openssl_decrypt($unique_encrypted_data, 'aes-256-cbc', $unique_clave_secreta, 0, hex2bin($unique_iv));
}

$unique_cliente = unique_desencriptar_datos($unique_cliente_encrypted, $clave_secreta);

$unique_sql_insert = "INSERT INTO recargos (referencia, fecha, hora, cliente, sub_total, iva, total, estado) VALUES ('', '$fecha', '$hora', '$unique_cliente', '$unique_sub_total', '0', '$unique_total', '1')";
$unique_resultado_insert = $conex->query($unique_sql_insert);

if ($unique_resultado_insert) {
    $unique_recuperar_id = $conex->insert_id;
    $unique_referencia = 'R' . $unique_recuperar_id . 'C' . $unique_cliente;
    $unique_sql_update_referencia = "UPDATE recargos SET referencia='$unique_referencia' WHERE id = '$unique_recuperar_id'";
    $unique_resultado_update_referencia = $conex->query($unique_sql_update_referencia);

    if ($unique_resultado_update_referencia) {
        $unique_sql_update_saldo = "UPDATE clientes SET saldo = saldo + '$unique_sub_total' WHERE id = '$unique_cliente'";
        $unique_resultado_update_saldo = $conex->query($unique_sql_update_saldo);

        if ($unique_resultado_update_saldo) {



            $unique_sql_bonos = "SELECT * FROM bonos WHERE base <= '$unique_sub_total' ORDER BY base DESC LIMIT 1";
            $unique_resultado_bonos = $conex->query($unique_sql_bonos);

            if ($unique_resultado_bonos->num_rows >= 1) {
                while ($unique_fila_bonos = $unique_resultado_bonos->fetch_assoc()) {
                    if ($unique_fila_bonos['tipo'] == 1) {
                        $unique_sub_total = $unique_fila_bonos['cantidad']; // Aumento por valor
                    } else if ($unique_fila_bonos['tipo'] == 2) {
                        $unique_sub_total = ($unique_sub_total * $unique_fila_bonos['cantidad']); // Aumento por porcentaje directo
                    }

                    $unique_total = $unique_sub_total;

                    $unique_sql_insert_bono = "INSERT INTO recargos (referencia, fecha, hora, cliente, sub_total, iva, total, estado) VALUES ('', '$fecha', '$hora', '$unique_cliente', '$unique_sub_total', '0', '$unique_total', '1')";
                    $unique_resultado_insert_bono = $conex->query($unique_sql_insert_bono);

                    if ($unique_resultado_insert_bono) {
                        $unique_recuperar_id_bono = $conex->insert_id;
                        $unique_referencia_bono = 'R' . $unique_recuperar_id_bono . 'C' . $unique_cliente;
                        $unique_sql_update_referencia_bono = "UPDATE recargos SET referencia='$unique_referencia_bono' WHERE id = '$unique_recuperar_id_bono'";
                        $unique_resultado_update_referencia_bono = $conex->query($unique_sql_update_referencia_bono);

                        if ($unique_resultado_update_referencia_bono) {
                            $unique_sql_update_saldo_bono = "UPDATE clientes SET saldo = saldo + '$unique_sub_total' WHERE id = '$unique_cliente'";
                            $unique_resultado_update_saldo_bono = $conex->query($unique_sql_update_saldo_bono);

                            if ($unique_resultado_update_saldo_bono) {
                                echo "$unique_referencia";
                            } else {
                                echo '2';
                            }
                        } else {
                            echo '2';
                        }
                    } else {
                        echo '2';
                    }
                }
            } else {
                echo "$unique_referencia";
            }
        } else {
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
