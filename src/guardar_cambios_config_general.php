<?php 
include("../config/config.php");

if (isset($_POST['general']) && !empty($_POST['general'])) {
    
    $icon = isset($_FILES['icon']) ? $_FILES['icon'] : null;
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $RIF = isset($_POST['RIF']) ? $_POST['RIF'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $keywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $l_consecutivo = isset($_POST['l_consecutivo']) ? $_POST['l_consecutivo'] : '';
    $n_consecutivo = isset($_POST['n_consecutivo']) ? $_POST['n_consecutivo'] : '';

    $config_values = [
        'title' => $title,
        'RIF' => $RIF,
        'description' => $description,
        'keywords' => $keywords,
        'direccion' => $direccion,
        'telefono' => $telefono,
        'l_consecutivo' => $l_consecutivo,
        'n_consecutivo' => $n_consecutivo
    ];

    if ($icon && $icon['error'] === 0) {
        $icon_path = '/img/' . basename($icon['name']);
        $icon_path_s = '../img/' . basename($icon['name']);
        move_uploaded_file($icon['tmp_name'], $icon_path_s);
        $config_values['icon'] = $icon_path;
    }

    foreach ($config_values as $name => $data) {
        $stmt = $conex->prepare("UPDATE config SET data = ? WHERE name = ?");
        $stmt->bind_param("ss", $data, $name);
        $stmt->execute();
        $stmt->close();
    }
} else if (isset($_POST['smtp']) && !empty($_POST['smtp'])) {
   
    $mail_Host = isset($_POST['mail_Host']) ? $_POST['mail_Host'] : '';
    $mail_Username = isset($_POST['mail_Username']) ? $_POST['mail_Username'] : '';
    $mail_Password = isset($_POST['mail_Password']) ? $_POST['mail_Password'] : '';
    $mail_Port = isset($_POST['mail_Port']) ? $_POST['mail_Port'] : '';
    $mail_setFrom = isset($_POST['mail_setFrom']) ? $_POST['mail_setFrom'] : '';

    $config_values = [
        'mail_Host' => $mail_Host,
        'mail_Username' => $mail_Username,
        'mail_Password' => $mail_Password,
        'mail_Port' => $mail_Port,
        'mail_setFrom' => $mail_setFrom
    ];

    foreach ($config_values as $name => $data) {
        $stmt = $conex->prepare("UPDATE config SET data = ? WHERE name = ?");
        $stmt->bind_param("ss", $data, $name);
        $stmt->execute();
        $stmt->close();
    }

}
?>
