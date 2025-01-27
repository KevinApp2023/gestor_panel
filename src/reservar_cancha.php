<?php
include("../config/config.php");
include("../config/openssl_decrypt_pass_cs.php");

function desencriptar_datos($datos, $clave_secreta) {
    list($encrypted_data, $iv) = explode('::', base64_decode($datos), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $clave_secreta, 0, hex2bin($iv));
}

$id_e = $_POST['id'];
$id_cancha = desencriptar_datos($id_e, $clave_secreta);
$id_cliente = $_SESSION['propietario'];
$r_fecha = $_POST['r_fecha'];
$r_hora_inicio = $_POST['r_hora_inicio']; 
$r_hora_final = $_POST['r_hora_final'];  




$consult = "SELECT * FROM canchas WHERE id = '$id_cancha'";
$consult = mysqli_query($conex, $consult);
if ($tablag = mysqli_fetch_array($consult)) { 
    $valor_hora = $tablag['valor_hora'];

    $inicio = strtotime("$r_fecha $r_hora_inicio"); 
    $final = strtotime("$r_fecha $r_hora_final");   

    if ($final < $inicio) {
        $final += 24 * 60 * 60; 
    }

    $diferencia_segundos = $final - $inicio;
    $cantidad_horas = round($diferencia_segundos / 3600, 2); 

    // Calcular el total
    $total = round($cantidad_horas * $valor_hora, 2);

    $consult_saldo_cliente = "SELECT * FROM clientes WHERE id = '$id_cliente'";
    $consult_saldo_cliente = mysqli_query($conex, $consult_saldo_cliente);
    if ($tablag_saldo_cliente = mysqli_fetch_array($consult_saldo_cliente)) { 
        $saldo_cliente = $tablag_saldo_cliente['saldo'];
    }

    if ($saldo_cliente >= $total ){


     $consult_estado_canchas = "
    SELECT * 
    FROM reservas 
    WHERE id_cancha = '$id_cancha' AND r_fecha = '$r_fecha' 
      AND (
          (r_hora_inicio <= '$r_hora_inicio' AND r_hora_final > '$r_hora_inicio') OR 
          (r_hora_inicio < '$r_hora_final' AND r_hora_final >= '$r_hora_final') OR 
          (r_hora_inicio >= '$r_hora_inicio' AND r_hora_final <= '$r_hora_final')
      )
";

$consult_estado_canchas = mysqli_query($conex, $consult_estado_canchas);

if (mysqli_num_rows($consult_estado_canchas) > 0) {
echo '4';
} else {
  

   
    
    $sql = "INSERT INTO reservas (
        referencia, 
        id_cancha, 
        id_cliente, 
        fecha, 
        hora, 
        r_fecha, 
        r_hora_inicio, 
        r_hora_final, 
        valor_hora, 
        cantidad_horas, 
        total, 
        estado
    ) VALUES (
        '', 
        '$id_cancha', 
        '$id_cliente', 
        '$fecha', 
        '$hora',
        '$r_fecha',
        '$r_hora_inicio',
        '$r_hora_final',
        '$valor_hora',
        '$cantidad_horas',
        '$total',
        '1'
    )";

    $resultado = $conex->query($sql);
    if ($resultado) {
        $id_nueva_reserva = $conex->insert_id;
        $referencia = 'RV' . $id_nueva_reserva . 'C' . $id_cliente;

        $unique_sql_update_referencia = "UPDATE reservas SET referencia='$referencia' WHERE id = '$id_nueva_reserva'";
        $unique_resultado_update_referencia = $conex->query($unique_sql_update_referencia);
        if ($unique_resultado_update_referencia) {

            $unique_sql_update_saldo = "UPDATE clientes SET saldo = saldo - '$total' WHERE id = '$id_cliente'";
            $unique_resultado_update_saldo = $conex->query($unique_sql_update_saldo);
    
            if ($unique_resultado_update_saldo) {
                echo '1';
            } else {
                echo '2';
            }

        }

    } else {
        echo '2'; 
    }




}
     




    }else{
        echo '3'; 

    }




} else {
    echo '2';
}

$conex->close();
?>
