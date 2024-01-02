<?php
    require 'Conexion_base_de_datos.php';
    $mensaje="";

    if (!empty($_POST['nombre_usuario']) && !empty($_POST['correo_electronico']) && !empty($_POST['contrasena'])){
        $sql = "SELECT COUNT(*) as totalUsuarios FROM usuarios";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalUsuarios = $resultado['totalUsuarios'];

        $sql = "INSERT INTO usuarios (id, boleta, usuario, email, contrasena) VALUES ($totalUsuarios, :boleta, :nombre_usuario, :correo_electronico, :contrasena)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $_POST['nombre_usuario']);
        $stmt->bindParam(':boleta', $_POST['boleta']);
        $stmt->bindParam(':correo_electronico', $_POST['correo_electronico']);
        $contrasena=hash('sha256', $_POST['contrasena']);
        $stmt->bindParam(':contrasena',$contrasena);
        if ($stmt->execute()){
            $mensaje = 'Usuario creado correctamente';
        }else{
            $mensaje='Ha ocurrido un error';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Musescom</title>
        <link rel="stylesheet" href="../css/Registro_exitoso.css">
        </head>
    <body>
        <div class="wrapper">
            <h1>¡Usuario registrado correctamente!</h1>
            <p>Revisa tu correo para ver tus credenciales.<br>¡Ya puedes iniciar sesion!</p>
            <div class="not-member">
                <a href="Inicio_de_sesion.php">Iniciar sesion</a>
            </div>
            <div class="not-member">
                <a href="../index.html">Pagina Principal</a>
            </div>
        </div>
    </body>
</html>