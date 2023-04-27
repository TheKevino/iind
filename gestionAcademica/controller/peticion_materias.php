<?php

include('../../includes/db.php');

$tabla="";
$query = "SELECT idMateria, carreras.nombre as 'carrera', clave, materias.nombre as 'nombre' FROM materias, carreras 
WHERE materias.idCarrera = carreras.idCarrera ORDER BY materias.nombre";

if(isset($_POST['materias'])){
    $q=$conn->real_escape_string($_POST['materias']);
    $query = "SELECT idMateria, carreras.nombre as 'carrera', clave, materias.nombre as 'nombre' FROM materias, carreras 
    WHERE materias.idCarrera = carreras.idCarrera AND
    (carreras.nombre LIKE '%".$q."%' OR clave LIKE '%".$q."%' OR materias.nombre LIKE '%".$q."%') ORDER BY materias.nombre";
}
$result = mysqli_query($conn, $query);

if($result->num_rows > 0){
    $tabla.='
    <table class="table table-striped table-bordered" id="tabla_resultados">
    <thead>
        <tr>
            <th>Carrera</th>
            <th>Clave</th>
            <th>Asignatura</th>
            <th>Acciones</th>
        </tr>
    </thead>';

    while($row = mysqli_fetch_array($result)){
        $tabla.='
        <tr>
          <td>'.$row['carrera'].'</td>
          <td>'.$row['clave'].'</td>
          <td>'.utf8_decode($row['nombre']).'</td>
          <td>

                <a class="btn m-1" href="gestionAcademica/views/temas.php?id='.$row['idMateria'].'" target="_blank">
                    <i class="fas fa-plus"></i>
                </a>

                <a class="btn m-1" href="gestionAcademica/editForms/edit_materia.php?id='.$row['idMateria'].'" target="_blank">
                    <i class="fas fa-marker"></i>
                </a>

                <a class="m-1" href="gestionAcademica/controller/baja_materia.php?id='.$row['idMateria'].'">
                    <button class="btn" onclick="return confirmacion()"><i class="fas fa-trash"></i></button>
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
        let respuesta = confirm("Seguro(a) que quieres eliminar la asignatura?");
        
        return respuesta;
    }
</script>