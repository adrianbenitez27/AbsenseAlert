<?php
require 'Conexion_base_de_datos.php';
session_start();

// Verificar si el usuario tiene permisos de administrador o está logueado (ajusta según tus necesidades)
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    header('Location: ../index.html');
    exit;
}

// Obtener el ID de la solicitud desde la URL
if (!isset($_GET['id'])) {
    header('Location: Admin.php'); // Redirige si no se proporciona un ID válido
    exit;
}

$solicitudId = $_GET['id'];

// Obtener los detalles de la solicitud
$recordsSolicitud = $conn->prepare('SELECT * FROM datos_justificante WHERE id = :id');
$recordsSolicitud->bindParam(':id', $solicitudId);
$recordsSolicitud->execute();
$solicitud = $recordsSolicitud->fetch(PDO::FETCH_ASSOC);

// Puedes personalizar el HTML según tus necesidades para mostrar la información
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleIndex.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Información de Solicitud</title>
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
                    <a href="Cerrar_sesion.php" class="link">Cerrar sesión</a>
                    <a href="Admin.php" class="link">Regresar</a>
                </nav>
            </header>
            <div class="banner">
                <div class="banner_textos">
                    <h2>Información de Solicitud</h2>
                    <table>
                        <tbody>
                            <?php foreach ($solicitud as $campo => $valor): ?>
                                <tr>
                                    <th><?= $campo ?>:</th>
                                    <td><?= $valor ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <form action="AprobarSolicitud.php" method="post">
                        <input type="hidden" name="solicitud_id" value="<?= $solicitudId ?>">
                        <button type="submit">Aprobar</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

