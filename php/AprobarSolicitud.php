<?php
require 'Conexion_base_de_datos.php';
session_start();

// Verificar si el usuario tiene permisos de administrador o está logueado (ajusta según tus necesidades)
if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    header('Location: ../index.html');
    exit;
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el ID de la solicitud desde el formulario
    if (isset($_POST['solicitud_id'])) {
        $solicitudId = $_POST['solicitud_id'];

        // Actualizar el estado de la solicitud a "aprobado"
        $updateQuery = "UPDATE datos_justificante SET status = 'aprobado' WHERE id = :id";
        $updateStatement = $conn->prepare($updateQuery);
        $updateStatement->bindParam(':id', $solicitudId);

        if ($updateStatement->execute()) {
            // Redirigir o mostrar un mensaje de éxito
            header('Location: Admin.php'); // Cambia esto según tus necesidades
            exit;
        } else {
            // Manejar errores si la actualización no tiene éxito
            echo "Error al aprobar la solicitud.";
        }
    } else {
        // Manejar caso en el que no se proporciona el ID de la solicitud
        echo "ID de solicitud no proporcionado.";
    }
}

// Redirigir si no se ha enviado el formulario
header('Location: Admin.php');
exit;
?>
