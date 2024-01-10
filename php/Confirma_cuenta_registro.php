<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Código para recuperar contraseña</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <div class="wrapper">
            <h1>Código de verificación</h1>
            <p>Ingresa el código de verificación que llego a tu correo</p>
            <form action="Registro_exitoso.php" method="post">
                <input type="text" name="codigo" placeholder="Código de verificación">
                <button>Verificar código</button>
                <closeform></closeform>
            </form>
            
            <div class="not-member">
                ¿No estas registrado?<a href="/php/Registro_de_usuario.php"> Registrate ahora</a>
            </div>
            <div class="not-member">
                <a href="index.html">Pagina principal</a>
            </div>
        </div>
    </body>
</html>