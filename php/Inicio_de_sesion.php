<?php
    session_start();
    require 'Conexion_base_de_datos.php';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Inicio de sesion</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <?php if(!empty($mensaje)):?>
            <p><?= $mensaje ?></p>
        <?php endif;?>
        <div class="wrapper">
            <h1>Iniciar sesion</h1>
            <p>¡Bienvenido!<br>Ingresa tus datos</p>
            <form action="index.php" method="post">
                <input type="text" name="correo_electronico"  placeholder="Correo Electronico" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <p class="recover"> <a href="Recuperar_cuenta.php">Olvide mi contraseña</a></p>
                <button>Iniciar sesion</button>
                <closeform></closeform>
            </form>
            
            <div class="not-member">
                ¿No estas registrado?<a href="Registro_de_usuario.php"> Registrate ahora</a>
            </div>
            <div class="not-member">
                <a href="../index.html">Pagina principal</a>
            </div>
        </div>
    </body>
</html>