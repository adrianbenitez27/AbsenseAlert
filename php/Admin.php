<?php
require 'Conexion_base_de_datos.php';
session_start();

// Verificar si el usuario tiene permisos de administrador
if (!isset($_SESSION['usuario']) || !isset($_SESSION['es_admin']) || $_SESSION['es_admin'] != 1) {
    // Si no es administrador, redirige a la página principal o muestra un mensaje de error
    header('Location: ../index.html');
    exit;
}

// Obtener todos los usuarios
$consulta = "SELECT id, boleta, usuario, email, es_admin FROM usuarios";
$recordsUsuarios = $conn->prepare($consulta);
$recordsUsuarios->execute();
$usuarios = $recordsUsuarios->fetchAll(PDO::FETCH_ASSOC);

// Obtener todas las solicitudes
$recordsSolicitudes = $conn->prepare('SELECT id, boleta, nombre, apellido_pat, apellido_mat, statuss FROM datos_justificante');
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
                    <?php if(!empty($_SESSION['usuario'])): ?>
                    <a class="nav-link"><?= $_SESSION['usuario'] ?></a>
                    <a href="Admin.php" class="nav-link">Usuarios</a>
                    <a href="Solicitudes.php" class="nav-link">Solicitudes</a>
                    <a href="Cerrar_sesion.php" class="nav-link">Cerrar sesión</a>
                    <?php else: ?>    
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
                <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div> 
    
    <div class="container my-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaUsuarios" class="table table-striped table-bordered table-condensed" style="width:100%">  <!-- Tabla de usuarios falta el class -->
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Boleta</th>
                                <th>Usuario</th>
                                <th>email</th>
                                <th>Rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($usuarios as $usuario){ ?>
                            <tr>
                                <td><?= $usuario['id'] ?></td>
                                <td><?= $usuario['boleta'] ?></td>
                                <td><?= $usuario['usuario'] ?></td>
                                <td><?= $usuario['email'] ?></td>
                                <td><?= $usuario['es_admin'] ?></td>
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
    

    <!--Modal para CRUD-->
    <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="id" class="col-form-label">ID:</label>
                <input type="number" class="form-control" id="id">
                </div>
                <div class="form-group">
                <label for="boleta" class="col-form-label">Boleta:</label>
                <input type="text" class="form-control" id="boleta">
                </div>                
                <div class="form-group">
                <label for="usuario" class="col-form-label">Usuario:</label>
                <input type="text" class="form-control" id="usuario">
                </div>     
                <div class="form-group">
                <label for="email" class="col-form-label">Correo:</label>
                <input type="text" class="form-control" id="email">
                </div>
                <div class="form-group">
                <label for="es_admin" class="col-form-label">Rol:</label>
                <input type="text" class="form-control" id="es_admin">
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

    <script type="text/javascript" src="../main.js"></script> 
   
</body>
</html>
