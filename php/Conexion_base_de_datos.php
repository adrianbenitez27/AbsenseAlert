<?php
    $servidor ='localhost';
    $usuario = 'root';
    $contrasena = '';
    $bd = 'absensealertcom';

    try{
        $conn = new PDO("mysql:host=$servidor;dbname=$bd", $usuario, $contrasena);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e){
        die('Conexion Fallida: ' . $e->getMessage());
    }
?>