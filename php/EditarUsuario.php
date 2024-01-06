<?php
require 'Conexion_base_de_datos.php';
session_start();

// Verificar si el usuario tiene permisos de administrador
if (!isset($_SESSION['usuario']) || !isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    // Si no es administrador, redirige a la página principal o muestra un mensaje de error
    header('Location: ../index.html');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se ha enviado el formulario de edición
    if (isset($_POST['user_id']) && isset($_POST['boleta']) && isset($_POST['usuario']) && isset($_POST['email']) && isset($_POST['es_admin'])) {
        $userId = $_POST['user_id'];
        $boleta = $_POST['boleta'];
        $usuario = $_POST['usuario'];
        $email = $_POST['email'];
        $es_admin = $_POST['es_admin'];

        // Actualizar los datos del usuario en la base de datos
        $updateQuery = "UPDATE usuarios SET boleta = :boleta, usuario = :usuario, email = :email, es_admin = :es_admin WHERE id = :id";
        $updateStatement = $conn->prepare($updateQuery);
        $updateStatement->bindParam(':boleta', $boleta);
        $updateStatement->bindParam(':usuario', $usuario);
        $updateStatement->bindParam(':email', $email);
        $updateStatement->bindParam(':es_admin', $es_admin);
        $updateStatement->bindParam(':id', $userId);

        if ($updateStatement->execute()) {
            // Redirigir a la página de administrador después de la actualización exitosa
            header('Location: Admin.php');
            exit;
        } else {
            // Manejar errores si la actualización no tiene éxito (puedes personalizar esto según tus necesidades)
            echo "Error al actualizar los datos.";
        }
    }
}

// Obtener los datos del usuario (excepto la contraseña)
if (!isset($_GET['id'])) {
    // Redirige a la página principal si no se proporciona un ID de usuario
    header('Location: Admin.php');
    exit;
}

$userId = $_GET['id'];

$records = $conn->prepare('SELECT id, boleta, usuario, email, es_admin FROM usuarios WHERE id = :id');
$records->bindParam(':id', $userId);
$records->execute();
$usuario = $records->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    // Redirige a la página principal si el usuario no se encuentra
    header('Location: Admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styleIndex.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Editar Usuario</title>
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
                    <?php endif; ?>
                </nav>
            </header>
            <div class="banner">
                <div class="banner_textos">
                    <h2>Editar Usuario</h2>
                    <form action="" method="post">
                        <input type="hidden" name="user_id" value="<?= $usuario['id'] ?>">
                        
                        <label for="boleta">Boleta:</label>
                        <input type="text" id="boleta" name="boleta" value="<?= $usuario['boleta'] ?>" required>
                        <br>
                        
                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" value="<?= $usuario['usuario'] ?>" required>
                        <br>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?= $usuario['email'] ?>" required>
                        <br>

                        <label for="es_admin">Es Admin:</label>
                        <input type="text" id="es_admin" name="es_admin" value="<?= $usuario['es_admin'] ?>">
                        <br>
                        <br>
                        <br>

                        <button type="submit">Guardar</button>
                        <a href="Admin.php"><button type="submit">Cancelar</button></a>
                    </form>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
