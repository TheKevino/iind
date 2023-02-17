<?php

include('../../includes/db.php');

$tabla="";
$query = "SELECT idGrupo, carreras.nombre as 'carrera', clave, grupos.nombre as 'nombre' FROM grupos, carreras WHERE grupos.idCarrera = carreras.idCarrera";

if(isset($_POST['grupos'])){
    $q=$conn->real_escape_string($_POST['grupos']);
    $query = "SELECT idGrupo, carreras.nombre as 'carrera', clave, grupos.nombre as 'nombre' 
    FROM grupos, carreras WHERE grupos.idCarrera = carreras.idCarrera AND
    (carreras.nombre LIKE '%".$q."%' OR clave LIKE '%".$q."%' OR grupos.nombre LIKE '%".$q."%')";
}
$result = mysqli_query($conn, $query);

if($result->num_rows > 0){
    $tabla.='
    <table class="table table-striped table-bordered" id="tabla_resultados">
    <tr>
        <th>Carrera</th>
        <th>Clave</th>
        <th>Grupo</th>
        <th>Acciones</th>
    </tr>';

    while($row = mysqli_fetch_array($result)){
        $id = $row['idGrupo'];
        $grupo ="onClick=\"asignarGrupo('".$id."','".$row['nombre']."', '".$row['clave']."');\"";

        $tabla.='
        <tr>
          <td>'.$row['carrera'].'</td>
          <td>'.$row['clave'].'</td>
          <td>'.$row['nombre'].'</td>
          <td>
            <button '.$grupo.' class="btn btn-complementario-c"><i class="fas fa-check"></i></button>
          </td>
        </tr>';
        
    }

    $tabla.="</table>";
} else {
    $tabla.="Sin coincidencias";
}

echo $tabla;

?>