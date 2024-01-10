<?php
    require 'Conexion_base_de_datos.php';
    session_start();

    if (!empty($_POST['correo_electronico']) && !empty($_POST['contrasena'])){
        $records = $conn->prepare('SELECT id, boleta, usuario, email, contrasena, es_admin FROM usuarios WHERE email=:correo_electronico');
        $records->bindParam(':correo_electronico',$_POST['correo_electronico']);
        $records->execute();
        $resultado = $records->fetch(PDO::FETCH_ASSOC);
        $mensaje='';
        $contrasena=hash('sha256', $_POST['contrasena']);
        if(!empty($resultado['usuario']) && ($contrasena == $resultado['contrasena'])){
            $_SESSION['usuario_id'] = $resultado['id'];
            $_SESSION['usuario'] = $resultado['usuario'];
            $_SESSION['es_admin'] = $resultado['es_admin'];
        }else{
            echo "<script>alert('No existe algún usuario con este correo electrónico'); 
                window.location='../index.html'</script>";
        }
    }
    if(isset($_SESSION['usuario_id'])){
        $records=$conn->prepare('SELECT id,boleta,usuario,email,contrasena FROM usuarios WHERE id=:id');
        $records->bindParam(':id', $_SESSION['usuario_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $user = null;
        if(count($results) > 0){
            $user=$results;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/Index.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <title>Inicio AbsenseAlert</title>
    </head>
    <body>
        <main class="main">
            <section class="contenedor-1">
                <header class="cabecera">
                    <div class="logo">
                        <img src="../img/LogoBurrito1.jpg" alt="logoBurrito">
                    </div>
                    <nav class="navegacion">
                        <a href="index.php" class="link">Inicio</a>

                        <?php if(!empty($user)): ?>
                            <a class="link"><?= $user['usuario'] ?></a>
                            <a href="Cerrar_sesion.php" class="link">Cerrar sesion</a>
                            <?php if ($_SESSION['es_admin'] == 0): ?>
                                <a href="Formulario.php" class="link">Solicitar justificante</a> 
                            <?php endif; ?>
                            <a href="Status_justificantes.php" class="link">Revisar status de justificantes</a>
                            <?php if ($_SESSION['es_admin'] == 1): ?>
                                <a href="Admin.php" class="link">Control administrador</a>
                            <?php endif; ?>
                        <?php else: ?>
                               
                            <a href="Inicio_de_sesion.php" class="link">Accede a tu cuenta</a>
                            <a href="Registro_de_usuario.php" class="link">Crear una cuenta</a>
                        <?php endif;?>
                    </nav>
                </header>
                <div class="banner">
                    <div class="banner_textos">
                    <h1>SUSANO BURRITO</h1>
                    <p>Este proyecto educativo tiene como finalidad optimizar la gestión de justificantes por enfermedad y fortalecer las medidas preventivas durante el actual ciclo escolar. Se empleará una metodología de cascada que se alinea con las fases de análisis, diseño, programación, pruebas y mantenimiento.</p>

                    <a href="php/Inicio_de_sesion.php">Iniciar tramite</a>
                    </div>
                </div>
            </section>
            <section class="contenedor-2">
                <div class="text">
                <h2>Nuestro proposito</h2>
                    <p>Bienvenido a Susano Burrito, la innovadora aplicación que simplifica y agiliza la creación de justificantes por enfermedad. Nos dedicamos a proporcionar una herramienta fácil de usar que facilita la generación de documentos necesarios para ausencias escolares.</p>
                    
                </div>
                <div class="fotos">
                    <div class="fotos_img">
                        <img src="../img/foto1.jpg" alt="">
                        <h3>Generación rápida de justificantes personalizados.</h3>
                    </div>
                    <div class="fotos_img">
                        <img src="../img/foto2.jpg" alt="">
                        <h3>Interfaz intuitiva y fácil de usar para usuarios de todas las edades.</h3>

                    </div>
                    <div class="fotos_img">
                        <img src="../img/foto3.jpg" alt="">
                        <h3>Servicio seguro y confiable para garantizar la autenticidad de los justificantes.</h3>
                    </div>
                </div>
            </section>
            <section class="contenedor-3">
                <div class="contenedor-3_mapa">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3760.8600891187684!2d-99.14889792578725!3d19.504654338377843!2m3!1f0!2f0!3f0!3m
                    2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f94c06d75fd7%3A0x3fe1567da2190ac9!2sESCOM%20-%20Escuela%20Superior%20de%20C%C3%B3mputo%20-%20IPN!5e0!3m2!1ses!
                    2smx!4v1687080798320!5m2!1ses!2smx" width="450" height="250" style="border-radius:10px; border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="contenedor-3_text">
                <h2>INSTITUTO POLITÉCNICO NACIONAL                    </h2>
                    <p>D.R. Instituto Politécnico Nacional (IPN). Av. Luis Enrique Erro S/N, Unidad Profesional Adolfo López Mateos, Zacatenco, Delegación Gustavo A. Madero, C.P. 07738, Ciudad de México 2009-2013.

                        Esta página es una obra intelectual protegida por la Ley Federal del Derecho de Autor, puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica; su uso para otros fines, requiere autorización previa y por escrito de la Dirección General del Instituto.)</p>
                        <a href="https://www.escom.ipn.mx/">Para más información</a>
                </div>
            </section>
           
            <section class="contenedor-5">
                <div class="footer-text">
                    <div class="box1">
                        <h3>Buscanos en </h3>
                        <p>A continuacion te dejamos nuestras redes para que nos puedas
                            seguir e interactuar. Siempre contestaremos tus mensajes.</p>
                        <div class="rs">
                            <img src="../img/Instagram.png" alt="Instagram_logo">
                            <img src="../img/Facebook.png" alt="Facebook:logo">
                            <img src="../img/Twitter.png" alt="Twitter_logo">
                            <img src="../img/WhatsApp.png" alt="WhatsApp_logo">
                        </div>
                    </div>
                    <div class="box2">
                        <h3>Acerca de </h3>
                        <a href="#">Historia</a>
                        <a href="#">Nuestros equipos</a>
                        <a href="#">Terminos y condiciones</a>
                        <a href="#">Politicas de privacidad</a>
                    </div>
                    <div class="box3">
                        <h3>Servicios </h3>
                        <a href="#">Ordenes</a>
                        <a href="#">Nuestros productos</a>
                        <a href="#">Donaciones</a>
                    </div>
                    <div class="box4"> 
                        <h3>Otros </h3>
                        <a href="#">Contactanos</a>
                        <a href="#">Ayuda</a>
                        <a href="#">Blog</a>
                    </div>
                </div>
                <footer class="pie">
                    <p>Copyright &copy; 2023. <a href="#">ESCOM</a> | Todos los 
                        derechos rervados</p>
                </footer>
            </section>
        </main>
    </body>
</html>