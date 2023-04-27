<?php

include("../../includes/db.php");

$idUsuario = $_GET['idU'];
$materia = $_POST['selectMateria'];
$nombreDocente = $_POST['docente'];
$carrera = $_POST['selectCarrera'];
$periodo = $_POST['selectPeriodo'];
$grupo = $_POST['selectGrupo'];
$aula = strlen($_POST['aula']) > 0 ? $_POST['aula'] : "S.A";
$semana = $_POST['semana'];

$query = "INSERT INTO planeaciondidactica(idUsuario, idMateria, idCarrera, nombreDocente, grupo, periodo, aula, noSemanas) 
    VALUES ('$idUsuario', '$materia', '$carrera', '$nombreDocente', '$grupo', '$periodo', '$aula', '$semana')";

$result = mysqli_query($conn, $query);

if(!$result){
    die("Query failed");
}

header("Location: ../../redirection.php?op=19");

?>