<?php
require 'Conexion_base_de_datos.php';
session_start();

// $id= (isset($_POST['id'])) ? $_POST['id'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$statuss = (isset($_POST['statuss'])) ? $_POST['statuss'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch ($opcion) {
    case 1: //modificación
        $consulta = "UPDATE datos_justificante SET id='$id' statuss='$statuss' WHERE id = '$id' ";
        $recordsSolicitudes = $conn->prepare($consulta2);
        $recordsSolicitudes->execute();

        $consulta = "SELECT SELECT id, boleta, nombre, apellido_pat, apellido_mat,fecha_ini,fecha_fin,fecha_jus,razon_ausen,statusss FROM datos_justificante WHERE id='$id' ";
        $recordsSolicitudes = $conn->prepare($consulta);
        $recordsSolicitudes->execute();
        $solicitudes = $recordsSolicitudes->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //alta
        $consulta2 = "INSERT INTO datos_justificante (id, statuss) VALUES ('$id', '$statuss')";
        $recordsSolicitudes = $conn->prepare($consulta2);
        $recordsSolicitudes->execute();

        $consulta2 = "SELECT id, statuss FROM datos_justificante ORDER BY id DESC LIMIT 1";
        $recordsSolicitudes = $conn->prepare($consulta2);
        $recordsSolicitudes->execute();
        $solicitudes = $recordsSolicitudes->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($solicitudes, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conn = NULL;
