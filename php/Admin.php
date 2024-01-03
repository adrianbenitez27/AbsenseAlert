<?php
require 'Conexion_base_de_datos.php';
session_start();

// Verificar si el usuario tiene permisos de administrador
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    // Si no es administrador, redirige a la página principal o muestra un mensaje de error
    header('Location: ../index.html');
    exit;
}

// Obtener todos los usuarios
$recordsUsuarios = $conn->prepare('SELECT id, boleta, usuario, email, es_admin FROM usuarios');
$recordsUsuarios->execute();
$usuarios = $recordsUsuarios->fetchAll(PDO::FETCH_ASSOC);

// Obtener todas las solicitudes
$recordsSolicitudes = $conn->prepare('SELECT id, boleta, nombre, apellido_pat, apellido_mat, status FROM datos_justificante');
$recordsSolicitudes->execute();
$solicitudes = $recordsSolicitudes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleIndex.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Admin Panel</title>
    <style>
        table {
            margin: auto; /* Centra la tabla */
        }
        .hidden {
            display: none;
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

                    <?php if(!empty($_SESSION['usuario_id'])): ?>
                        <a class="link"><?= $_SESSION['usuario'] ?></a>
                        <a href="Cerrar_sesion.php" class="link">Cerrar sesión</a>
                    <?php else: ?>    
                        <a href="Inicio_de_sesion.php" class="link">Accede a tu cuenta</a>
                        <a href="Registro_de_usuario.php" class="link">Crear una cuenta</a>
                    <?php endif; ?>
                </nav>
            </header>
            <div class="banner">
                <div class="banner_textos">
                    <button onclick="toggleSection('usuariosSection')">Mostrar Usuarios</button>
                    <button onclick="toggleSection('solicitudesSection')">Mostrar Solicitudes</button>

                    <div id="usuariosSection" class="hidden">
                        <h2>Listado de Usuarios</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Boleta</th>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Es_Admin</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td><?= $usuario['id'] ?></td>
                                        <td><?= $usuario['boleta'] ?></td>
                                        <td><?= $usuario['usuario'] ?></td>
                                        <td><?= $usuario['email'] ?></td>
                                        <td><?= $usuario['es_admin'] ?></td>
                                        <td>
                                            <button onclick="eliminarUsuario(<?= $usuario['id'] ?>)">Eliminar</button>
                                            <button onclick="editarUsuario(<?= $usuario['id'] ?>)">Editar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div id="solicitudesSection" class="hidden">
                        <h2>Listado de Solicitudes</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Boleta</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($solicitudes as $solicitud): ?>
                                    <tr>
                                        <td><?= $solicitud['id'] ?></td>
                                        <td><?= $solicitud['boleta'] ?></td>
                                        <td><?= $solicitud['nombre'] ?></td>
                                        <td><?= $solicitud['apellido_pat'] ?></td>
                                        <td><?= $solicitud['apellido_mat'] ?></td>
                                        <td><?= $solicitud['status'] ?></td>
                                        <td>
                                            <button onclick="aprobarSolicitud(<?= $solicitud['id'] ?>)">Aprobar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <script>
        function toggleSection(sectionId) {
            var section = document.getElementById(sectionId);
            section.style.display = section.style.display === 'none' ? 'block' : 'none';
        }
        
        function eliminarUsuario(userId) {
            // Implementa la lógica para eliminar el usuario con el ID userId
            console.log('Eliminar usuario con ID: ' + userId);
        }

        function editarUsuario(userId) {
            // Redirige a editar.php con el ID del usuario
            window.location.href = 'EditarUsuario.php?id=' + userId;
        }
    </script>
</body>
</html>
