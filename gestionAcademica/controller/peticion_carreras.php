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
    <thead>
        <tr>
            <th>Carrera</th>
            <th>Acciones</th>
        </tr>
    </thead>';

    while($row = mysqli_fetch_array($result)){
        $tabla.='
        <tr>
          <td>'.$row['nombre'].'</td>
          <td>
              <a target="_blank" class="btn" href="gestionAcademica/editForms/edit_carrera.php?id='.$row['idCarrera'].'">
                <i class="fas fa-marker"></i>
              </a>

              <a>
                <button class="btn" onclick="borrarCarrera('.$row['idCarrera'].')"><i class="fas fa-trash"></i></button>
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