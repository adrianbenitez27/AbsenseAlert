<?php
require 'Conexion_base_de_datos.php';
session_start();

// $id= (isset($_POST['id'])) ? $_POST['id'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$boleta = (isset($_POST['boleta'])) ? $_POST['boleta'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$apellido_pat = (isset($_POST['apellido_pat'])) ? $_POST['apellido_pat'] : '';
$apellido_mat = (isset($_POST['apellido_mat'])) ? $_POST['apellido_mat'] : '';
$fecha_ini = (isset($_POST['fecha_ini'])) ? $_POST['fecha_ini'] : '';
$fecha_fin = (isset($_POST['fecha_fin'])) ? $_POST['fecha_fin'] : '';
$fecha_jus = (isset($_POST['fecha_jus'])) ? $_POST['fecha_jus'] : '';
$razon_ausen = (isset($_POST['razon_ausen'])) ? $_POST['razon_ausen'] : '';
$statuss = (isset($_POST['statuss'])) ? $_POST['statuss'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch ($opcion) {
    case 1: //Alta
        $consulta2 = "INSERT INTO datos_justificante (id, statuss) VALUES ('$id', '$statuss')";
        $recordsSolicitudes = $conn->prepare($consulta2);
        $recordsSolicitudes->execute();

        $consulta2 = "SELECT id, statuss FROM datos_justificante ORDER BY id DESC LIMIT 1";
        $recordsSolicitudes = $conn->prepare($consulta2);
        $recordsSolicitudes->execute();
        $solicitudes = $recordsSolicitudes->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //Modificación
        $consulta2 = "UPDATE datos_justificante SET boleta ='$boleta', nombre ='$nombre', apellido_pat ='$apellido_pat', apellito_mat ='$apellido_mat', fecha_ini ='$fecha_ini', fecha_fin ='$fecha_fin', fecha_just ='$fecha_jus', razon_ausen ='$razon_ausen', statuss ='$statuss' WHERE id = '$id' ";
        $recordsSolicitudes = $conn->prepare($consulta2);
        $recordsSolicitudes->execute();

        $consulta2 = "SELECT id, boleta, nombre, apellido_pat, apellito_mat, fecha_ini, fecha_fin, fecha_just, razon_ausen, statuss FROM datos_justificante WHERE id='$id' ";
        $recordsSolicitudes = $conn->prepare($consulta2);
        $recordsSolicitudes->execute();
        $solicitudes = $recordsSolicitudes->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($solicitudes, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conn = NULL;
