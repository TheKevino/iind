<?php


include_once('../../includes/user.php');
include_once('../../includes/user_session.php');
$userSession = new UserSession();
$user = new User();
$user->setUser($userSession->getCurrentUser());

if(!isset($_SESSION['user'])){
    header('Location: login.php');
}

require '../../word/vendor/autoload.php';
include '../../includes/responsable.php';
require '../../includes/db.php';

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;

date_default_timezone_set('America/Los_Angeles');
$meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $query = "SELECT * FROM formularios, usuarios WHERE idFormulario = '$id' AND idAsesorInterno = idUsuario 
    OR idRevisor1 = idUsuario AND idFormulario = '$id'
    OR idRevisor2 = idUsuario AND idFormulario = '$id'";
    
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result)){
        $nombreEstudiante = $row[1] ." ".$row[2]." ".$row[3];
        $nc = $row[5];
        $nombreProyecto = $row[6];
        $producto = $row[7];
    
        if($row[9] == $row[15]){
            if($row[10]==NULL) $row[10] = "../img/image.jpg";
            $asesorInterno = new Responsable($row[9], $row[16]." ".$row[17]." ".$row[18] , $row[10]);
        } else if($row[11] == $row[15]){
            if($row[12]==NULL) $row[12] = "../img/image.jpg";
            $revisor1 = new Responsable($row[11],$row[16]." ".$row[17]." ".$row[18] , $row[12]);
        }  else if($row[13] == $row[15]){
            if($row[14]==NULL) $row[14] = "../img/image.jpg";
            $revisor2 = new Responsable($row[13], $row[16]." ".$row[17]." ".$row[18] , $row[14]);
        }
          
    }//fin while
    
    $nombreEstudiante = strtoupper($nombreEstudiante);
    $fecha = date("d")." de ". $meses[date("n")-1]." de ". date("Y");
} //fin if

if(!isset($asesorInterno)) $asesorInterno = new Responsable("", "", "");
if(!isset($revisor1)) $revisor1 = new Responsable("", "", "");
if(!isset($revisor2)) $revisor2 = new Responsable("", "", "");

$templateWord = new TemplateProcessor('../../word/plantilla.docx');

$templateWord->setValue('nombre', $nombreEstudiante);
$templateWord->setValue('noControl', $nc);
$templateWord->setValue('nombreProyecto', $nombreProyecto);
$templateWord->setValue('producto', $producto);
$templateWord->setValue('fecha', $fecha);
$templateWord->setValue('asesorInterno', $asesorInterno->getNombre());
$templateWord->setValue('revisor', $revisor1->getNombre());
$templateWord->setValue('revisor2', $revisor2->getNombre());

if($asesorInterno->getFirma()!="../img/image.jpg") {
    $templateWord->setImageValue('firmaAsesor', '../'.$asesorInterno->getFirma());
} else {
    $templateWord->setValue('firmaAsesor', '');
}

if($revisor1->getFirma()!="../img/image.jpg") {
    $templateWord->setImageValue('firmaRevisor', '../'.$revisor1->getFirma());
} else {
    $templateWord->setValue('firmaRevisor', '');
}

if($revisor2->getFirma()!="../img/image.jpg") {
    $templateWord->setImageValue('firmaRevisor2', '../'.$revisor2->getFirma());
} else {
    $templateWord->setValue('firmaRevisor2', '');
}

//$templateWord->saveAs('../../../../Users/public/prueba.docx');
header("Content-Disposition: attachment; filename='".$nc.".docx'");
$templateWord->saveAs('php://output');
header("Location: redirection.php?op=0");

?>