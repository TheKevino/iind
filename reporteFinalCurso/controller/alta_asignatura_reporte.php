<?php

include('../../includes/db.php');

/*
$idReporte = 2;
$asignatura = "POO";
$carrera = "Sistemas";
$totalEstudiantes = 126;
$primeraOp = 72;
$segundaOp = 29;
$totalAcreditados = 101;
$porcentajeAcreditados = 80;
$EstudiantesNoAcreditados = 25;
$porcentajeNoAcreditados = 19;
$desertores = 24;
$porcentajeDesertores = 19;
*/

$idReporte = $_POST['idReporte'];
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


$query = "INSERT INTO asignprogramas(idReporte, asignatura, carrera, totalEstudiantes, primeraOp, segundaOp, totalAcreditados, porcentajeAcreditados, 
        estudiantesNoAcreditados, porcentajeNoAcreditados, desertores, porcentajeDesertores) 
            VALUES('$idReporte', '$asignatura', '$carrera', '$totalEstudiantes', '$primeraOp', '$segundaOp', '$totalAcreditados', '$porcentajeAcreditados', 
            '$EstudiantesNoAcreditados', '$porcentajeNoAcreditados', '$desertores', '$porcentajeDesertores')";

$result = mysqli_query($conn, $query);

if(!$result){
    die("Query failed");
}

?>