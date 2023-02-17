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
        $tabla.='
        <tr>
          <td>'.$row['carrera'].'</td>
          <td>'.$row['clave'].'</td>
          <td>'.$row['nombre'].'</td>
          <td>
              <a class="btn btn-editar" href="gestionAcademica/editForms/edit_grupo.php?id='.$row['idGrupo'].'">
                <i class="fas fa-marker"></i>
              </a>

              <a href="gestionAcademica/controller/baja_grupo.php?id='.$row['idGrupo'].'">
                <button class="btn btn-borrar" onclick="return confirmacion()"><i class="fas fa-trash"></i></button>
              </a>

          </td>
        </tr>';
        
    }

    $tabla.="</table>";
} else {
    $tabla.="Sin coincidencias";
}

echo $tabla;

?>

<script>
    function confirmacion(){   
        let respuesta = confirm("Seguro(a) que quieres eliminar la carrera?");
        
        return respuesta;
    }
</script>