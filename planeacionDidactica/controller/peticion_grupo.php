<?php

include('../../includes/db.php');

$idGrupo=$_POST['idGrupo'];

$queryGrupo = "SELECT nombre FROM grupos WHERE idGrupo = $idGrupo";
$resultGrupo = mysqli_query($conn, $queryGrupo);
$rowGrupo = mysqli_fetch_array($resultGrupo);

$resultado = "<label>Grupo:</label>";
$resultado .= "<select class='form-select' name='selectGrupo' id='selectGrupo'>";
$resultado .= "<option value = ".$rowGrupo['nombre'].">";
$resultado .= $rowGrupo["nombre"];
$resultado .= "</option>";
$resultado .= "</select>";

echo $resultado;

?>