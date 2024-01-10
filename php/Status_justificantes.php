<?php
require 'Conexion_base_de_datos.php';
require 'fdpdf/fpdf.php'; // Asegúrate de proporcionar la ruta correcta a la biblioteca FPDF
session_start();

if (isset($_SESSION['usuario_id'])) {
    $records = $conn->prepare('SELECT id,boleta,nombre,apellido_pat,apellido_mat,fecha_nac,genero,curp,
        direccion,colonia,estado_proce,codigo_postal,telefono,email,escuela_proce,fecha_ini,fecha_fin,razon_ausen,
        archivo_com_med,statuss,fecha_jus FROM datos_justificante WHERE id=:id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
}

// Función para generar PDF con FPDF
function generarPDF($row)
{
    $pdf = new FPDF('P', 'mm', 'Letter'); // Especificamos orientación, unidad y tamaño del papel
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    // Logo e información del Instituto Politécnico Nacional
    $pdf->Image('burrito.png', 10, 10, 30);
    $pdf->SetY(10);
    $pdf->Cell(0, 10, utf8_decode('Instituto Politécnico Nacional'), 0, 1,'C');
    $pdf->Cell(0, 10, utf8_decode('Escuela Superior de Cómputo'), 0, 1,'C');

    // Información del Justificante Médico
    $pdf->SetY(50);
    $pdf->Cell(0, 10, utf8_decode('Asunto: Justificante Médico'), 0, 1);
    $pdf->SetY(60);
    $pdf->Cell(0, 10, 'Querido Profesor', 0, 1);
    $pdf->SetY(70);
    $pdf->Cell(0, 10, utf8_decode('Depto Médico'), 0, 1);
    $pdf->SetY(80);
    $pdf->Cell(0, 10, 'Presente:', 0, 1);

    // Datos del alumno
    $pdf->SetY(100);
    $pdf->Cell(0, 10, 'Nombre: ' . $row['nombre'] . ' ' . $row['apellido_pat'] . ' ' . $row['apellido_mat'], 0, 1);
    $pdf->Cell(0, 10, 'Boleta: ' . $row['boleta'], 0, 1);

    // Contenido del justificante
$pdf->SetY(120);
$pdf->MultiCell(0, 10, utf8_decode('Estimado Profesor,

Por la presente, justifico la ausencia del alumno ' . $row['nombre'] . ' ' . $row['apellido_pat'] . ' ' . $row['apellido_mat'] . ', con boleta ' . $row['boleta'] . ', debido a su ausencia planificada desde el ' . $row['fecha_ini'] . ' hasta el ' . $row['fecha_fin'] . '. Nuestro compromiso con la excelencia académica y respeto a las normativas nos motiva a informar detalladamente los motivos de la ausencia.

Agradecemos su comprensión.

Atentamente,

[Firma del alumno]'));

    // Fecha en la esquina inferior derecha
    $pdf->SetY(245);
    $pdf->SetX(-40);
    $pdf->Cell(0, 10, 'Fecha: ' . $row['fecha_ini'], 0, 1, 'R');

    // Guarda el PDF en un archivo
    $pdf->Output('justificante_aprobado.pdf', 'F');
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Index.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Status justificantes</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th,
        td {
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
                    <img src="../img/LogoBurrito1.jpg" alt="logoBurrito">
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
                echo '<td>' . $row['statuss'] . '</td>';
                if ($row['statuss'] == "Pendiente") {
                    echo '<td>' . 'Aún no se ha revisado tu información' . '</td>';
                } else if ($row['statuss'] == "Rechazado") {
                    echo '<td>' . 'Tu información no cumplió las especificaciones' . '</td>';
                } else if ($row['statuss'] == "Aprobado") {
                    // Llama a la función para generar el PDF con el contenido deseado
                    generarPDF($row);
                    echo '<td>' . 'Justificante aprobado - <a href="justificante_aprobado.pdf" target="_blank">Descargar PDF</a>' . '</td>';
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
                
                    <p>El estado de tu justificante está siendo procesado. Agradecemos tu paciencia mientras revisamos la información proporcionada. Te notificaremos cualquier cambio en el estado de tu solicitud. Si tienes alguna pregunta o necesitas asistencia, no dudes en ponerte en contacto con nuestro equipo de soporte.</p>
               
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