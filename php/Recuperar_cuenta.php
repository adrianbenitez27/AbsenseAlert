<?php
    session_start();
    require 'Conexion_base_de_datos.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Recuperar cuenta</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <?php if(!empty($mensaje)):?>
            <p><?= $mensaje ?></p>
        <?php endif;?>
        <div class="wrapper">
            <h1>Recuperar cuenta</h1>
            <p>Ingresa los siguientes datos</p>
            <form action="Envio_correo_contrasena.php" method="post">
                <input type="text" name="correo_electronico" placeholder="Correo Electronico">
                <button>Recuperar cuenta</button>
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