<?php

include('../../includes/db.php');

$tabla="";
$query = "SELECT idCarrera, nombre FROM carreras";

if(isset($_POST['carreras'])){
    $q=$conn->real_escape_string($_POST['carreras']);
    $query = "SELECT idCarrera, nombre FROM carreras WHERE
        nombre LIKE '%".$q."%' ";
}
$result = mysqli_query($conn, $query);

if($result->num_rows > 0){
    $tabla.='
    <table class="table table-striped table-bordered" id="tabla_resultados">
    <tr>
        <th>Carrera</th>
        <th>Acciones</th>
    </tr>';

    while($row = mysqli_fetch_array($result)){
        $tabla.='
        <tr>
          <td>'.$row['nombre'].'</td>
          <td>
              <a class="btn btn-editar" href="gestionAcademica/editForms/edit_carrera.php?id='.$row['idCarrera'].'">
                <i class="fas fa-marker"></i>
              </a>

              <a href="gestionAcademica/controller/bajaCarrera.php?id='.$row['idCarrera'].'">
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