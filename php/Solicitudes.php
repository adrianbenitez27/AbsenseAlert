<?php
require 'Conexion_base_de_datos.php';
session_start();

// Verificar si el usuario tiene permisos de administrador
if (!isset($_SESSION['usuario']) || !isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    // Si no es administrador, redirige a la página principal o muestra un mensaje de error
    header('Location: ../index.html');
    exit;
}

// Obtener todas las solicitudes

$recordsSolicitudes = $conn->prepare('SELECT id, boleta, nombre, apellido_pat, apellido_mat,fecha_ini,fecha_fin,fecha_jus,razon_ausen,statuss FROM datos_justificante');
$recordsSolicitudes->execute();
$solicitudes = $recordsSolicitudes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#" />
    <!-- <link rel="stylesheet" href="../css/styleIndex.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../datatables/datatables.min.js">
    <link rel="stylesheet" type="text/css" href="../datatables/DataTables-1.13.8/css/dataTables.bootstrap5.min.css">
    <!-- <style>
        table {
            margin: auto; /* Centra la tabla */
        }
        .hidden {
            display: none;
        }
    </style> -->
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SusanoBurrito</a>
                <div class="navbar-nav">
                    <a href="index.php" class="nav-link active">Inicio</a>
                    <?php if (!empty($_SESSION['usuario'])) : ?>
                        <a class="nav-link"><?= $_SESSION['usuario'] ?></a>
                        <a href="Admin.php" class="nav-link">Usuarios</a>
                        <a href="Solicitudes.php" class="nav-link">Solicitudes</a>
                        <a href="Cerrar_sesion.php" class="nav-link">Cerrar sesión</a>
                    <?php else : ?>
                        <a href="Inicio_de_sesion.php" class="nav-link">Accede a tu cuenta</a>
                        <a href="Registro_de_usuario.php" class="nav-link">Crear una cuenta</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>

    <div class="container my-3">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-center">Listado de Solicitudes</h1>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaJustificantes" class="table table-striped table-bordered table-condensed" style="width:100%"> <!-- Tabla de usuarios falta el class -->
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Boleta</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Termino</th>
                                <th>Fecha Solucitud</th>
                                <th>Motivo</th>
                                <th>Status</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($solicitudes as $solicitud) { ?>
                                <tr>
                                    <td><?= $solicitud['id'] ?></td>
                                    <td><?= $solicitud['boleta'] ?></td>
                                    <td><?= $solicitud['nombre'] ?></td>
                                    <td><?= $solicitud['apellido_pat'] ?></td>
                                    <td><?= $solicitud['apellido_mat'] ?></td>
                                    <td><?= $solicitud['fecha_ini'] ?></td>
                                    <td><?= $solicitud['fecha_fin'] ?></td>
                                    <td><?= $solicitud['fecha_jus'] ?></td>
                                    <td><?= $solicitud['razon_ausen'] ?></td>
                                    <td><?= $solicitud['statuss'] ?></td>
                                    <td></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formSolicitudes">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="id" class="col-form-label">Status:</label>
                            <select id="statuss" name="statuss" required>
                                <option selected disabled="">Selecciona una opcion</option>
                                <option value="Rechazado">Rechazado</option>
                                <option value="Aceptado">Aceptado</option>
                                <option value="Pendiente">Pendiente</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="es_admin" class="col-form-label">Motivo:</label>
                            <input type="text" class="form-control" id="razon_ausen">
                        </div>           
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="../jquery/jquery-3.7.1.min.js"></script>
    <script src="../popper/popper.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <!-- datatables JS -->
    <script type="text/javascript" src="../datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../verificacion.js"></script>

</body>

</html>