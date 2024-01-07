<?php
require 'Conexion_base_de_datos.php';
session_start();

// $id= (isset($_POST['id'])) ? $_POST['id'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$boleta = (isset($_POST['boleta'])) ? $_POST['boleta'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellidoPat = (isset($_POST['apellido_pat'])) ? $_POST['apellido_pat'] : '';
$apellidoMat = (isset($_POST['apellido_mat'])) ? $_POST['apellido_mat'] : '';
$fechaIn = (isset($_POST['fecha_ini'])) ? $_POST['fecha_ini'] : '';
$fechaTerm = (isset($_POST['fecha_fin'])) ? $_POST['fecha_fin'] : '';
$fechaSolic = (isset($_POST['fecha_jus'])) ? $_POST['fecha_jus'] : '';
$razon_ausen = (isset($_POST['razon_ausen'])) ? $_POST['razon_ausen'] : '';
$statuss = (isset($_POST['statuss'])) ? $_POST['statuss'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


switch ($opcion) {
    case 1: //modificación
        $consulta2 = "UPDATE datos_justificante SET id='$id' statuss='$statuss' WHERE id = '$id' ";
        $recordsSolicitudes = $conn->prepare($consulta2);
        $recordsSolicitudes->execute();

        $consulta2 = "SELECT id, boleta, nombre, apellido_pat, apellido_mat, fecha_ini, fecha_fin, fecha_jus,razon_ausen , statuss FROM datos_justificante WHERE id='$id' ";
        $recordsSolicitudes = $conn->prepare($consulta2);
        $recordsSolicitudes->execute();
        $solicitudes = $recordsSolicitudes->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //alta
        $consulta2 = "INSERT INTO usuarios (id, boleta, usuario, email, es_admin) VALUES ('$id', '$boleta', '$usuario', '$email', '$es_admin')";
        $recordsSolicitudes = $conn->prepare($consulta);
        $recordsSolicitudes->execute();

        $consulta2 = "SELECT id, boleta, usuario, email, es_admin FROM usuarios ORDER BY id DESC LIMIT 1";
        $recordsSolicitudes = $conn->prepare($consulta);
        $recordsSolicitudes->execute();
        $solicitudes = $recordsSolicitudes->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($solicitudes, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conn = NULL;
