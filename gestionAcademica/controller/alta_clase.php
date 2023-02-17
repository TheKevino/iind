<?php

include('../../includes/db.php');


$docente = $_POST['docente'];
$asignatura = $_POST['asignatura'];
$grupo = $_POST['grupo'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];

$query = "INSERT INTO usuarioimparte(idUsuario, idMateria, idGrupo, fechaInicio, fechaFin) 
            VALUES('$docente', '$asignatura', '$grupo', '$fecha_inicio', '$fecha_final')";

$result = mysqli_query($conn, $query);

if(!$result){
    die("Query failed");
}

?>