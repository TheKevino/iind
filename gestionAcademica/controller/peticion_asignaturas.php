<?php

include('../../includes/db.php');

$tabla="";
$query = "SELECT idMateria, carreras.nombre as 'carrera', clave, materias.nombre as 'nombre' FROM materias, carreras WHERE materias.idCarrera = carreras.idCarrera";

if(isset($_POST['materias'])){
    $q=$conn->real_escape_string($_POST['materias']);
    $query = "SELECT idMateria, carreras.nombre as 'carrera', clave, materias.nombre as 'nombre' FROM materias, carreras 
    WHERE materias.idCarrera = carreras.idCarrera AND
    (carreras.nombre LIKE '%".$q."%' OR clave LIKE '%".$q."%' OR materias.nombre LIKE '%".$q."%')";
}
$result = mysqli_query($conn, $query);

if($result->num_rows > 0){
    $tabla.='
    <table class="table table-striped table-bordered" id="tabla_resultados">
    <tr>
        <th>Carrera</th>
        <th>Clave</th>
        <th>Asignatura</th>
        <th>Acciones</th>
    </tr>';

    while($row = mysqli_fetch_array($result)){
        $id = $row['idMateria'];
        $docente ="onClick=\"asignarMateria('".$id."','".utf8_decode($row['nombre'])."');\"";

        $tabla.='
        <tr>
          <td>'.$row['carrera'].'</td>
          <td>'.$row['clave'].'</td>
          <td>'.utf8_decode($row['nombre']).'</td>
          <td>
            <button '.$docente.' class="btn btn-complementario-c"><i class="fas fa-check"></i></button>
          </td>
        </tr>';
        
    }

    $tabla.="</table>";
} else {
    $tabla.="Sin coincidencias";
}

echo $tabla;

?>