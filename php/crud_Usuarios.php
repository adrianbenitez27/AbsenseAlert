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

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO usuarios (id, boleta, usuario, email, es_admin) VALUES ('$id', '$boleta', '$usuario', '$email', '$es_admin')";			
        $recordsUsuarios = $conn->prepare($consulta);
        $recordsUsuarios->execute(); 

        $consulta = "SELECT id, boleta, usuario, email, es_admin FROM usuarios ORDER BY id DESC LIMIT 1";
        $recordsUsuarios = $conn->prepare($consulta);
        $recordsUsuarios->execute();
        $usuarios=$recordsUsuarios->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE usuarios SET boleta='$boleta', usuario ='$usuario', email ='$email', es_admin = '$es_admin' WHERE id = '$id' ";		
        $recordsUsuarios = $conn->prepare($consulta);
        $recordsUsuarios->execute();        
        
        $consulta = "SELECT id, boleta, usuario, email, es_admin FROM usuarios WHERE id='$id' ";       
        $recordsUsuarios = $conn->prepare($consulta);
        $recordsUsuarios->execute();
        $usuarios=$recordsUsuarios->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM usuarios WHERE id='$id' ";		
        $resultado = $conn->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($usuarios, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conn = NULL;