<?php
    require 'Conexion_base_de_datos.php';
    session_start();

    $code = $_POST['codigo'];
    $codigo = $_SESSION["codigo"];

    if($code == $codigo){
        $sql = "SELECT COUNT(*) as totalUsuarios FROM usuarios";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalUsuarios = $resultado['totalUsuarios'];

        $sql = "INSERT INTO usuarios (id, boleta, usuario, email, contrasena) VALUES ($totalUsuarios, :boleta, :nombre_usuario, :correo_electronico, :contrasena)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre_usuario', $_SESSION['nombre_usuario']);
        $stmt->bindParam(':boleta', $_SESSION['boleta']);
        $stmt->bindParam(':correo_electronico', $_SESSION['correo_electronico']);
        $contrasena=hash('sha256', $_SESSION['contrasena']);
        $stmt->bindParam(':contrasena',$contrasena);
        if ($stmt->execute()){
            $mensaje = 'Usuario creado correctamente';
        }else{
            $mensaje='Ha ocurrido un error';
        }
    }
    else{
        echo "<script>alert('Código incorrecto'); window.location='Confirma_cuenta_registro.php'</script>";
    }
    $mensaje="";
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