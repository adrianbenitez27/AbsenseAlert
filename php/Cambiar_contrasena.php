<?php
    session_start();
    require 'Conexion_base_de_datos.php';

    if (!empty($_POST['contrasena']) && !empty($_POST['repetir_contrasena'])){
        if($_POST['contrasena'] == $_POST['repetir_contrasena']){
            $hash_contrasena = hash('sha256', $_POST['contrasena']);
    
            $records = $conn->prepare('UPDATE usuarios SET contrasena=:contrasena WHERE email=:correo_electronico');
            $records->bindParam(':contrasena',$hash_contrasena);
            $records->bindParam(':correo_electronico',$_SESSION['correo_electronico']);
            
            try{
                $records->execute();
                echo "<script>alert('Contraseña cambiada'); window.location='../index.html'</script>";
            } catch (PDOException $e) {
                echo "<script>alert('Error al cambiar la contraseña'); window.location='../Cambiar_contrasena.html'</script>";
            }
        }
        else{
            echo "<script>alert('Las contraseñas no coinciden'); window.location='../Cambiar_contrasena.html'</script>";
        }
    }
?>