<?php 
    session_start();

    $code = $_POST['codigo'];
    $codigo = $_SESSION["codigo"];

    if($code == $codigo){
        echo "<script>window.location='../Cambiar_contrasena.html'</script>";
    }
    else{
        echo "<script>alert('Código incorrecto'); window.location='../Confirma_cuenta.html'</script>";
    }

?>