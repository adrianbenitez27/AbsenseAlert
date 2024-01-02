<?php 
    session_start();
    require 'Conexion_base_de_datos.php';

    $_SESSION['usuario_id'];

    $records = $conn->prepare('SELECT id,boleta,usuario,email,contrasena FROM usuarios WHERE id=:id');
    $records->bindParam(':id',$_SESSION['usuario_id']);
    $records->execute();
    $resultado = $records->fetch(PDO::FETCH_ASSOC);

    $ruta_archivo = '../justificantes_medicos/' . $_SESSION['usuario_id'] . '-' . $_FILES['archivo_com_med']['name'];
    
    if(!empty($resultado['usuario']) && move_uploaded_file($_FILES['archivo_com_med']['tmp_name'], $ruta_archivo)){
        $sql = "INSERT INTO datos_justificante (id, boleta, nombre, apellido_pat, apellido_mat, fecha_nac, genero, curp, 
        direccion, colonia, estado_proce, codigo_postal, telefono, email, escuela_proce, fecha_ini, fecha_fin, 
        razon_ausen, archivo_com_med) VALUES (:id, :boleta, :nombre, :apellido_pat, :apellido_mat, :fecha_nac, :genero, :curp, 
        :direccion, :colonia, :estado_proce, :codigo_postal, :telefono, :correo_electronico, :escuela_proce, :fecha_ini, 
        :fecha_fin, :razon_ausen, :archivo_com_med)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_SESSION['usuario_id']);       
        $stmt->bindParam(':boleta', $_POST['boleta']);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':apellido_pat', $_POST['apellido_pat']);
        $stmt->bindParam(':apellido_mat', $_POST['apellido_mat']);
        $stmt->bindParam(':fecha_nac', $_POST['fecha_nac']);
        $stmt->bindParam(':genero', $_POST['genero']);
        $stmt->bindParam(':curp', $_POST['curp']);
        $stmt->bindParam(':direccion', $_POST['direccion']);
        $stmt->bindParam(':colonia', $_POST['colonia']);
        $stmt->bindParam(':estado_proce', $_POST['estado_proce']);
        $stmt->bindParam(':codigo_postal', $_POST['codigo_postal']);
        $stmt->bindParam(':telefono', $_POST['telefono']);
        $stmt->bindParam(':correo_electronico', $_POST['correo_electronico']);
        $stmt->bindParam(':escuela_proce', $_POST['escuela_proce']);
        $stmt->bindParam(':fecha_ini', $_POST['fecha_ini']);
        $stmt->bindParam(':fecha_fin', $_POST['fecha_fin']);
        $stmt->bindParam(':razon_ausen', $_POST['razon_ausen']);
        $stmt->bindParam(':archivo_com_med', $ruta_archivo);

        if ($stmt->execute()){
            echo "<script>alert('Justificante ingresado correctamente'); 
            window.location='index.php'</script>";
        }else{
            echo "<script>alert('Ocurrió un problema al ingresar los datos del justificante'); 
            window.location='Formulario.php'</script>";
        }
    }else{
        echo "<script>alert('No existe algún usuario con este identificador'); 
            window.location='../index.html'</script>";
    }
?>