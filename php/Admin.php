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
$records = $conn->prepare('SELECT id, boleta, usuario, email, es_admin FROM usuarios');
$records->execute();
$usuarios = $records->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleIndex.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Admin Panel</title>
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
            </div>
        </section>
    </main>
    
    <script>
        function eliminarUsuario(userId) {
            // Aquí puedes implementar la lógica para eliminar el usuario con el ID userId
            console.log('Eliminar usuario con ID: ' + userId);
        }

        function editarUsuario(userId) {
            // Redirige a editar.php con el ID del usuario
            window.location.href = 'Editar.php?id=' + userId;
        }
    </script>
</body>
</html>
