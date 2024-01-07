<?php
require 'Conexion_base_de_datos.php';
session_start();

// $id= (isset($_POST['id'])) ? $_POST['id'] : '';
$boleta = (isset($_POST['boleta'])) ? $_POST['boleta'] : '';
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$es_admin = (isset($_POST['es_admin'])) ? $_POST['es_admin'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$statuss = (isset($_POST['statuss'])) ? $_POST['statuss'] : '';

switch($opcion){
    case 1: //modificación
        $consulta = "UPDATE datos_justificante SET statuss='$statuss' WHERE id = '$id' ";		
        $recordsUsuarios = $conn->prepare($consulta);
        $recordsUsuarios->execute();        
        
        $consulta = "SELECT id, boleta, usuario, email, es_admin, statuss FROM datos_justificante WHERE id='$id' ";       
        $recordsUsuarios = $conn->prepare($consulta);
        $recordsUsuarios->execute();
        $usuarios=$recordsUsuarios->fetchAll(PDO::FETCH_ASSOC);
        break;        
}

print json_encode($usuarios, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conn = NULL;