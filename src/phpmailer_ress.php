<?php 

include('../config/config.php');
       
$correo = $_POST['correo'];
$pin = $_POST['pin'];
$asunto = "Tu codigo PIN de verificacion";
$mensaje_corto = "Confirma tu identidad con este código PIN";
$mensaje = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de PIN</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #009CFF;
            color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .content {
            padding: 20px;
            text-align: center;
            color: #333333;
        }
        .pin-code {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0;
            color: #009CFF;
        }
        .footer {
            background-color: #eeeeee;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #666666;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Verificación de PIN</h1>
        </div>
        <div class="content">
            <p>Hola,</p>
            <p>Utiliza el siguiente PIN para completar tu verificación:</p>
            <div class="pin-code">'. $pin . '</div>
            <p>Este código es válido por los próximos 10 minutos.</p>
            <p>Si no solicitaste este código, por favor ignora este mensaje.</p>
        </div>
        <div class="footer">
            <p>Goodmax Software</p>
            <p>Este es un mensaje generado automáticamente, no respondas a este correo.</p>
        </div>
    </div>
</body>
</html>
';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = 2; 
    $mail->isSMTP();
    $mail->Host       = $mail_Host;
    $mail->SMTPAuth   = true;
    $mail->Username   = $mail_Username; 
    $mail->Password   = $mail_Password; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
    $mail->Port       = $mail_Port; 

    $mail->setFrom($mail_Username, $mail_setFrom);
    $mail->addAddress($correo);

    $mail->isHTML(true);
    $mail->Subject = $asunto;
    $mail->Body    = $mensaje;
    $mail->AltBody = $mensaje_corto;

    $mail->send();
    echo 'Correo enviado correctamente';
} catch (Exception $e) {
    echo "El correo no pudo ser enviado. Error: {$mail->ErrorInfo}";
}
?>
