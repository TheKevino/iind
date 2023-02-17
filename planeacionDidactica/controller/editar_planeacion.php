<?php

include("../../includes/db.php");

$idPlaneacion = $_GET['id'];
$ids = $_POST['selectMateria'];

$carrera = $_POST['selectCarrera'];
$periodo = $_POST['selectPeriodo'];
$grupo = $_POST['selectGrupo'];
$aula = $_POST['aula'];
$semana = $_POST['semana'];

$materia = explode("_", $ids);

$query = "UPDATE planeaciondidactica set idMateria = $materia[0], idCarrera = $carrera, periodo = '$periodo', 
grupo = '$grupo', aula = '$aula', noSemanas = '$semana' WHERE idPlaneacion=$idPlaneacion";

$result = mysqli_query($conn, $query);

header("Location: ../../redirection.php?op=planeacion");

?>