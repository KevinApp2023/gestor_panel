<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imageData = $_POST['image'];

    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $decodedImage = base64_decode($imageData);

    $directory = '../qr_cliente/';
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
    $filePath = $directory . $_POST['data'] . '.png';

    if (file_put_contents($filePath, $decodedImage)) {
        echo "QR guardado exitosamente en: $filePath";
    } else {
        echo "Error al guardar el QR.";
    }
} else {
    echo "Método no permitido.";
}
?>
