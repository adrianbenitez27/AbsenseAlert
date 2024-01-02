<?php
    require 'Conexion_base_de_datos.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Registro usuario</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="wrapper">
            <h1>Registrate</h1>
            <p>Bienvenido<br>Ingresa tus datos</p>
            <form orm action="Registro_exitoso.php" method="POST">
                <input type="text" name="nombre_usuario" placeholder="Usuario" required>
                <input type="number" name="boleta" placeholder="Boleta" required>
                <input type="email" name="correo_electronico" placeholder="Correo electronico" required>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
                <input type="password" name="confirmar_contraseña" placeholder="Confirma tu contraseña" required>
                <button type="submit" name="enviar" >Registrarme</button>
                <closeform></closeform>
            </form>
            
            <div class="not-member">
                ¿Ya estas registrado?<a href="Inicio_de_sesion.php"> Inicia sesion ahora</a>
            </div>
            <div class="not-member">
                <a href="../index.html">Pagina Principal</a>
            </div>
        </div>
    </body>
</html>