<?php
include("../../config/config.php");
$referencia = $_GET['referencia'];
$sql = "SELECT r.*, c.identificacion, c.nombres, c.apellidos, c.direccion, c.saldo FROM recargos r LEFT JOIN clientes c ON r.cliente = c.id WHERE r.referencia = '$referencia'";
$resultado = $conex->query($sql);
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $data_referencia = $fila['referencia'];
        $data_fecha = $fila['fecha'];
        $data_hora = $fila['hora'];
        $data_cliente = $fila['cliente'];
        $data_identificacion = $fila['identificacion'];
        $data_nombres = $fila['nombres'];
        $data_apellidos = $fila['apellidos'];
        $data_direccion = $fila['direccion'];
        $data_sub_total = $fila['sub_total'];
        $bono = $fila['bono'];
        $data_iva = $fila['iva'];
        $data_total = $fila['total'];
        $saldo_cliente = $fila['saldo'];
        if($fila['tipo'] == '1'){
            $tipo = 'FACTURA';
        }else{
            $tipo = 'COMPROBANTE';
        }

        if($fila['estado'] == '1'){
            $estado = 'Aprobado';
            $estado_color = [76, 175, 80]; // Verde claro
        }else{
            $estado = 'Anulado';
            $estado_color = [255, 0, 0]; // Rojo
        }
    }
}

require "../../vendor/pdf/code128.php";

$pdf = new PDF_Code128('P', 'mm', [80, 330]);
$pdf->SetMargins(5, 5, 5);
$pdf->AddPage();

// Encabezado del ticket
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetTextColor(32, 100, 210);
$pdf->Cell(0, 8, iconv("UTF-8", "ISO-8859-1", strtoupper($tipo)), 0, 1, 'C');

// Estado
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(32, 100, 210);
$pdf->SetTextColor($estado_color[0], $estado_color[1], $estado_color[2]);
$pdf->Cell(0, 2, iconv("UTF-8", "ISO-8859-1", strtoupper($estado)), 0, 1, 'C');



$imgWidth = 50;
$maxHeight = 45; 
$imgX = (80 - $imgWidth) / 2;
list($originalWidth, $originalHeight) = getimagesize("../..$icon");
$imgHeight = ($imgWidth / $originalWidth) * $originalHeight;
if ($imgHeight > $maxHeight) {
    $imgHeight = $maxHeight;
}
$pdf->Image("../..$icon", $imgX, 30, $imgWidth, $imgHeight);
$pdf->Ln($imgHeight + 5); 


// Encabezado del ticket
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(32, 100, 210);
$pdf->Cell(0, 8, iconv("UTF-8", "ISO-8859-1", strtoupper($title)), 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(39, 39, 51);
$pdf->Cell(0, 5, "RIF: $RIF", 0, 1, 'C');
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "$direccion"), 0, 1, 'C');
$pdf->Cell(0, 5, "Tel: $telefono", 0, 1, 'C');

// Línea divisoria
$pdf->Ln(2);
$pdf->SetDrawColor(200, 200, 200);
$pdf->Line(5, $pdf->GetY(), 75, $pdf->GetY());
$pdf->Ln(2);

// Información de la factura
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, "Fecha: $data_fecha $data_hora", 0, 1);
$pdf->Cell(0, 5, "Referencia: $data_referencia", 0, 1);
$pdf->Ln(2);

// Información del cliente
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", strtoupper("CLIENTE")), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, "CED R.I.F: $data_identificacion", 0, 1);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "Nombres: $data_nombres"), 0, 1);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "Apellidos: $data_apellidos"), 0, 1);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "Dirección: $data_direccion"), 0, 1);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "Saldo: $saldo_cliente"), 0, 1);
$pdf->Ln(3);



$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "QR CLIENTE"), 0, 1, 'C');




// Obtener la posición actual antes de agregar el QR
$posAntesQR = $pdf->GetY();

// Definir la altura esperada del QR
$imgWidth = 50;
$maxHeight = 55;
$imgX = (80 - $imgWidth) / 2; 

// Cargar la imagen para obtener su tamaño real
list($originalWidth, $originalHeight) = getimagesize("../../qr_cliente/$data_cliente.png");
$imgHeight = ($imgWidth / $originalWidth) * $originalHeight;
if ($imgHeight > $maxHeight) {
    $imgHeight = $maxHeight;
}

// Determinar la posición después del QR (simulación de contenido siguiente)
$posDespuesQR = $pdf->GetY() + 55; // Aproximadamente la altura del QR más margen

// Calcular el centro entre los dos puntos
$centroQR = ($posAntesQR + $posDespuesQR - $imgHeight) / 2;

// Posicionar la imagen en el centro dinámicamente
$pdf->Image("../../qr_cliente/$data_cliente.png", $imgX, $centroQR, $imgWidth);

// Ajustar la posición después de la imagen para evitar superposiciones
$pdf->SetY($posDespuesQR);
$pdf->Ln(5);



// Detalle de la transacción
$pdf->SetDrawColor(200, 200, 200);
$pdf->Line(5, $pdf->GetY(), 75, $pdf->GetY());
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5, strtoupper("Detalle de la transaccion"), 0, 1);
$pdf->Ln(2);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "Credito abonado: $$data_sub_total"), 0, 1);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "Credito bono: $$bono"), 0, 1);
$pdf->Ln(2);

// Totales
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 6, "Subtotal:", 0, 0);
$pdf->Cell(30, 6, "$$data_sub_total", 0, 1, 'R');
$pdf->Cell(40, 6, "IVA ($iva%):", 0, 0);
$pdf->Cell(30, 6, "$$data_iva", 0, 1, 'R');
$pdf->Cell(40, 6, "Total a pagar:", 0, 0);
$pdf->Cell(30, 6, "$$data_total", 0, 1, 'R');

// Línea divisoria
$pdf->Ln(2);
$pdf->SetDrawColor(200, 200, 200);
$pdf->Line(5, $pdf->GetY(), 75, $pdf->GetY());
$pdf->Ln(2);

// Términos y condiciones
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "TÉRMINOS Y CONDICIONES"), 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Este documento es un comprobante de la transacción realizada. Por favor, conserve este ticket como constancia de su pago. Para cualquier consulta o reclamo, comuníquese a nuestros canales de atención."), 0, 'C');
$pdf->Ln(2);

// Mensaje final
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "*** Gracias por su preferencia ***"), 0, 'C');
$pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Recuerde consultar en su cuenta si el pago fue realizado."), 0, 'C');

// Generar el PDF
$pdf->Output("I", "$data_fecha _$data_hora _REF_$data_referencia.pdf", true);
?>