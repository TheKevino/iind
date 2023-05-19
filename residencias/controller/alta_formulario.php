<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};
require '../../email/vendor/autoload.php';
include('../../includes/db.php');

$paterno = $_POST['paterno'];
$materno = $_POST['materno'];
$nombres = $_POST['nombres'];
$nc = $_POST['nc'];
$nombreProyecto = $_POST['nombreProyecto'];
$producto = $_POST['producto'];
$idAsesor = $_POST['idAsesor'];
$idRevisor1 = $_POST['idRevisor1'];
$idRevisor2 = $_POST['idRevisor2'];
$correoAsesor = $_POST['correoAsesor'];
$correoRevisor1 = $_POST['correoRevisor1'];
$correoRevisor2 = $_POST['correoRevisor2'];

$query = "INSERT INTO formularios (paternoAlumno, maternoAlumno, nombresAlumno, noControl, nombreProyecto, producto, idAsesorInterno, idRevisor1, idRevisor2) VALUES('$paterno', '$materno', '$nombres', '$nc', '$nombreProyecto', '$producto', '$idAsesor', '$idRevisor1', '$idRevisor2')";

$result = mysqli_query($conn, $query);

if(!$result){
    die("Query failed");
}
/*
$mail = new PHPMailer(true);

try{
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = $ObjEmail->getHost();
    $mail->SMTPAuth = true;
    $mail->Username = $ObjEmail->getUserName();
    $mail->Password = $ObjEmail->getPassword();
    $mail->SMTPSecure = $ObjEmail->getSecure();
    $mail->Port = $ObjEmail->getPort();

    $mail->setFrom($ObjEmail->getUserName(), 'SERVICIOS DE CORREO');
    $mail->addAddress($correoAsesor);
    $mail->addAddress($correoRevisor1);
    $mail->addAddress($correoRevisor2);

    $mail->isHTML(false);
    $mail->Subject = "FIRMA DE FORMATO";
    $mail->Body = 'Han sido agregados como asesores o revisores del siguiente proyecto: '.utf8_decode($nombreProyecto).
            '. Tipo de producto: '. $producto .'. Del alumno: '.utf8_decode($paterno)." ".utf8_decode($materno)." ".$nombres.". 
             Numero de control: ". $nc;
    $mail->send();

} catch(Exception $e){
    echo 'Error '. $mail->ErrorInfo;
}

header("Location: ../../redirection.php?op=5");
*/

?>