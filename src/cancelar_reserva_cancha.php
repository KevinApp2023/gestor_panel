<?php
include("../config/config.php");
if (isset($_POST['id']) && !empty($_POST['id'])) {
    include("../config/openssl_decrypt_pass_cs.php");
    function desencriptar_datos($datos, $clave_secreta) {
        list($encrypted_data, $iv) = explode('::', base64_decode($datos), 2);
        return openssl_decrypt($encrypted_data, 'aes-256-cbc', $clave_secreta, 0, hex2bin($iv));
    }
    $id_e = $_POST['id'];
    $id = desencriptar_datos($id_e, $clave_secreta);

    
    $sql_consulta = "SELECT * FROM reservas  WHERE id = '$id'";
        $resultado_consulta = $conex->query($sql_consulta);
        if ($resultado_consulta->num_rows > 0) {
            while ($fila = $resultado_consulta->fetch_assoc()) {
            
            
            $total = $fila['total'];
            $cliente = $fila['id_cliente'];
            $sql = "UPDATE reservas SET estado='4' WHERE id = '$id' AND estado = '1'";
            $resultado = $conex->query($sql);
            if ($resultado) {
                
                
                $unique_sql_update_saldo = "UPDATE clientes SET saldo = saldo + '$total' WHERE id = '$cliente'";
                $unique_resultado_update_saldo = $conex->query($unique_sql_update_saldo);
                if ($unique_resultado_update_saldo) {
                    echo '1';
                } else {
                    echo '2';
                }
           
           
            } else {
                echo '2';
            }



        }
    }



} else {
    echo '2';
}
$conex->close();
?>
