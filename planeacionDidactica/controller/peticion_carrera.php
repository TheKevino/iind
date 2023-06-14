<?php

include('../../includes/db.php');

$idMateria=$_POST['idMateria'];

$query = "SELECT idCarrera, nombre FROM carreras WHERE idCarrera IN (SELECT idCarrera FROM materias WHERE idMateria = $idMateria)";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$resultado = "<label>Carrera:</label>";
$resultado .= "<select class='form-select' name='selectCarrera' id='selectCarrera' readonly>";
$resultado .= "<option value = ".$row['idCarrera'].">";
$resultado .= $row["nombre"];
$resultado .= "</option>";
$resultado .= "</select>";

echo $resultado;

?>