<?php

include('../../includes/db.php');

$idReporte = $_GET['id'];
$idUsuario = $_GET['idUs'];
$idAsignProg = $_GET['idAsign'];

$asignatura = $_POST['asignatura'];
$carrera = $_POST['carrera'];
$totalEstudiantes = $_POST['totalEstudiantes'];
$primeraOp = $_POST['primeraOp'];
$segundaOp = $_POST['segundaOp'];
$totalAcreditados = $_POST['totalAcreditados'];
$porcentajeAcreditados = $_POST['porcentajeAcreditados'];
$EstudiantesNoAcreditados = $_POST['EstudiantesNoAcreditados'];
$porcentajeNoAcreditados = $_POST['porcentajeNoAcreditados'];
$desertores = $_POST['desertores'];
$porcentajeDesertores = $_POST['porcentajeDesertores'];


$query = "UPDATE asignprogramas SET asignatura = '$asignatura', carrera = '$carrera', totalEstudiantes = '$totalEstudiantes', primeraOp = '$primeraOp', 
            segundaOp = '$segundaOp', totalAcreditados = '$totalAcreditados', porcentajeAcreditados = '$porcentajeAcreditados', 
            estudiantesNoAcreditados = '$EstudiantesNoAcreditados', porcentajeNoAcreditados = '$porcentajeNoAcreditados', desertores = '$desertores', 
            porcentajeDesertores = '$porcentajeDesertores' WHERE idAsignPrograma = $idAsignProg";

$result = mysqli_query($conn, $query);

if(!$result){
    die("Query failed");
}

?>