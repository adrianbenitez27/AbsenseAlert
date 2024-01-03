<?php
    require 'Conexion_base_de_datos.php';
    session_start();

    if(isset($_SESSION['usuario_id'])){
        //$records=$conn->prepare('SELECT id,boleta,usuario,email,contrasena FROM usuarios WHERE id=:id');
        $records=$conn->prepare('SELECT id,boleta,nombre,apellido_pat,apellido_mat,fecha_nac,genero,curp,
        direccion,colonia,estado_proce,codigo_postal,telefono,email,escuela_proce,fecha_ini,fecha_fin,razon_ausen,
        archivo_com_med,status,fecha_jus FROM datos_justificante WHERE id=:id');
        $records->bindParam(':id', $_SESSION['usuario_id']);
        $records->execute();
        //$resultado = $records->fetch(PDO::FETCH_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styleIndex.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
        <title>Status justificantes</title>
        <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
        .scrollable {
            max-height: 200px;
            overflow-y: auto;
        }
        </style>
    </head>
    <body>
        <main class="main">
            <section class="contenedor-1">
                <header class="cabecera">
                    <div class="logo">
                        <img src="../img/logoMusescom4.png" alt="logoMusescom">
                    </div>
                    <nav class="navegacion">
                        <a href="index.php" class="link">Inicio</a>
                        <a class="link"><?= $_SESSION['usuario'] ?></a>
                        <a href="Cerrar_sesion.php" class="link">Cerrar sesion</a>
                        <a href="Formulario.php" class="link">Solicitar justificante</a>
                        <a href="Status_justificantes.php" class="link">Revisar status de justificantes</a>
                    </nav>
                </header>
                <h1>Status de justificantes médicos</h1>
                <?php
                    echo '<div class="scrollable">';
                        echo '<table border="1">';
                            echo '<tr>';
                                echo '<th>Contador</th>';
                                echo '<th>Fecha</th>';
                                echo '<th>Status</th>';
                                echo '<th>Archivo</th>';
                            echo '</tr>';
                            $cont = 1;
                            while ($row = $records->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                    echo '<td>' . $cont . '</td>';
                                    echo '<td>' . $row['fecha_jus'] . '</td>';
                                    echo '<td>' . $row['status'] . '</td>';
                                    if($row['status'] == "Pendiente"){
                                        echo '<td>' . 'Aún no se ha revisado tu información' . '</td>';
                                    }
                                    else if($row['status'] == "Rechazado"){
                                        echo '<td>' . 'Tu información no cumplió las especificaciones' . '</td>';
                                    }
                                echo '</tr>';
                                $cont++;
                            }
                        echo '</table>';
                    echo '</div>';
                ?>
            </section>
            <section class="contenedor-2">
                <div class="text">
                    <h2>Nuestro proposito</h2>
                    <p>En Musescom podras interactuar con usuarios para compartir 
                        tus creaciones y aprendizaje de los cursos que impartimos.</p>
                </div>
                <div class="fotos">
                    <div class="fotos_img">
                        <img src="../img/foto1.jpg" alt="">
                        <h3>CURSOS</h3>
                        <p>Todos nuestros cursos sin ningun costo.</p>
                    </div>
                    <div class="fotos_img">
                        <img src="../img/foto2.jpg" alt="">
                        <h3>SUBE TUS CREACIONES</h3>
                        <p>Comparte tu musica con miles de usuarios.</p>
                    </div>
                    <div class="fotos_img">
                        <img src="../img/foto3.jpg" alt="">
                        <h3>CHAT CON LA COMUNIDAD</h3>
                        <p>Chat para hablar sobre musica.</p>
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
                    <h2>Los mejores cursos</h2>
                    <p>Los cursos fueron creados por alumnos del Instituto Politecnico Nacional 
                        de la Escuela Superior de Computo (ESCOM)</p>
                    <a href="#">Ver cursos</a>
                </div>
            </section>
            <section class="contenedor-4">
                <h2 class="contenedor-4_titulo">¿QUÉ QUIERES HACER HOY?</h2>
                <div class="contenedor-4_bloques">
                    <div class="bloque">
                        <h3>CURSOS</h3>
                        <img src="../img/piano_icono.png" alt="icono_piano">
                        <p>Ingresa a nuestros cursos de piano que tenemos para ti.</p>
                        <a href="../Cursos.html">Ir a cursos</a>
                    </div>
                    <div class="bloque">
                        <h3>SUBIR CANCIONES</h3>
                        <img src="../img/canciones_icono.png" alt="icono_canciones">
                        <p>Aqui puedes compartir tus creaciones con la comunidad</p>
                        <a href="Canciones.php">Compartir canciones</a>
                    </div>
                    <div class="bloque">
                        <h3>CHAT</h3>
                        <img src="../img/chat_icono.png" alt="icono_chat">
                        <p>Platica con toda la comunidad acerca de tu aprendizaje.</p>
                        <a href="">Ir al chat</a>
                    </div>
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