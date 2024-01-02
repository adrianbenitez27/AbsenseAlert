<?php
    session_start();
    require 'Conexion_base_de_datos.php';

    if (!empty($_POST['correo_electronico'])){
        $records = $conn->prepare('SELECT id,boleta,usuario,email,contrasena FROM usuarios WHERE email=:correo_electronico');
        $records->bindParam(':correo_electronico',$_POST['correo_electronico']);
        $records->execute();
        $resultado = $records->fetch(PDO::FETCH_ASSOC);
        $mensaje='';
        echo $resultado;
        if(!empty($resultado['usuario'])){
            $code = random_int(1000,9999);
            $_SESSION["codigo"] = $code;
            $_SESSION['correo_electronico'] = $_POST['correo_electronico'];

            echo "<script>alert('Se ha enviado un código de recuperación a su correo, ingréselo en el siguiente espacio'); 
                window.location='../Confirma_cuenta.html'</script>";

            include("phpMailer/class.phpmailer.php");
            include("phpMailer/class.smtp.php");

            $email_user = "oracleedmundo@gmail.com";
            $email_password = "guhevfwsdqfivgru";
            $the_subject = "Recupera tu cuenta";
            $address_to = $_POST['correo_electronico'];
            $from_name = "Empresa";
            $phpmailer = new PHPMailer();

            // ---------- datos de la cuenta de Gmail -------------------------------
            $phpmailer->Username = $email_user;
            $phpmailer->Password = $email_password; 
            //-----------------------------------------------------------------------
            // $phpmailer->SMTPDebug = 1;
            $phpmailer->SMTPSecure = 'tls';
            $phpmailer->Host = "smtp.gmail.com"; // GMail
            $phpmailer->Port = 587;
            $phpmailer->IsSMTP(); // use SMTP
            $phpmailer->SMTPAuth = true;

            $phpmailer->setFrom($phpmailer->Username,$from_name);
            $phpmailer->AddAddress($address_to); // recipients email

            $phpmailer->Subject = $the_subject;	
            $phpmailer->Body .= "<h1>Hola usuario con correo $address_to, ingresa el siguiente código para recuperar tu contraseña.</h1>";
            $phpmailer->Body .= "<p style='color:#3498db;'>Tu código de verificación es: $code</p>";
            $phpmailer->Body .= "<p>Fecha: ".date("d-m-Y")."</p>";
            $phpmailer->IsHTML(true);

            $phpmailer->Send();
        }else{
            echo "<script>alert('No existe algún usuario con este correo electrónico'); 
                window.location='Recuperar_cuenta.php'</script>";
        }
    }
?>