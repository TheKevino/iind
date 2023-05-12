<?php

include("../../includes/db.php");
include("../../includes/email.php");


use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};
require '../../email/vendor/autoload.php';

$id = $_GET['id'];

$query = "SELECT usuario, password, correo FROM usuarios WHERE idUsuario = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

if($row["correo"] != null){

    try{
        $ObjEmail = new Email();
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = $ObjEmail->getHost();
        $mail->SMTPAuth = true;
        $mail->Username = $ObjEmail->getUserName();
        $mail->Password = $ObjEmail->getPassword();
        $mail->SMTPSecure = $ObjEmail->getSecure();
        $mail->Port = $ObjEmail->getPort();
        
        $mail->setFrom($ObjEmail->getUserName(), 'SERVICIOS DE CORREO');
        $mail->addAddress($row["correo"]);
        
        $mail->isHTML(false);
        $mail->Subject = "USUARIO Y PASSWORD";
        $mail->Body = 'USUARIO: '. $row["usuario"] ." PASSWORD: ". $row["password"];
        $mail->send();
    
    } catch(Exception $e){
        echo 'Error '. $mail->ErrorInfo;
    } //fin try catch


}

header("Location: ../../redirection.php");

?>