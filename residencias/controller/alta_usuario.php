<?php

    include("../../includes/db.php");
    include("../../includes/email.php");
    include("../../includes/utilidades.php");

    use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};
    require '../../email/vendor/autoload.php';

    $mensaje = "";
    $tipo = "";
    $util = new Utilidades();
        
        $paterno =$_POST['paterno'];
        $materno =$_POST['materno'];
        $nombres =$_POST['nombres'];
        $correo = $_POST['email'];
        $nombresLista = explode(" ", $nombres);

        $apPaternoUsuario = $util->eliminar_acentos($paterno);
        $nombreUsuario = $util->eliminar_acentos($nombresLista[0]);

        $usuario = str_replace(" ", "", strtolower($apPaternoUsuario).".".strtolower($nombreUsuario).rand(1,1500000));
        $pass = str_replace(" ", "", ucfirst(strtolower($apPaternoUsuario)).strtolower($nombreUsuario)."$");

        $query = "INSERT INTO usuarios(paterno, materno, nombres, usuario, password, correo) 
                    VALUES('$paterno', '$materno', '$nombres', '$usuario', '$pass', '$correo')";

        $result = mysqli_query($conn, $query);

        if(!empty($correo)){

            $mail = new PHPMailer(true);
            $ObjEmail = new Email();
            
            try{
                $mail->isSMTP();
                $mail->Host = $ObjEmail->getHost();
                $mail->SMTPAuth = true;
                $mail->Username = $ObjEmail->getUserName();
                $mail->Password = $ObjEmail->getPassword();
                $mail->SMTPSecure = $ObjEmail->getSecure();
                $mail->Port = $ObjEmail->getPort();
            
                $mail->setFrom($ObjEmail->getUserName(), 'SERVICIOS DE CORREO');
                $mail->addAddress($correo);
            
                $mail->isHTML(false);
                $mail->Subject = "USUARIO Y PASSWORD";
                $mail->Body = 'USUARIO: '. $usuario." PASSWORD: ". $pass;
                $mail->send();
            
            } catch(Exception $e){
                echo 'Error '. $mail->ErrorInfo;
            }
        
        }

?>