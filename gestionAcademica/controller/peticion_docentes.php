<?php

include('../../includes/db.php');

$tabla="";
$query = "SELECT * FROM usuarios WHERE tipo != 2";

if(isset($_POST['usuarios'])){
    $q=$conn->real_escape_string($_POST['usuarios']);
    $query = "SELECT * FROM usuarios WHERE
        idUsuario LIKE '%".$q."%' OR
        paterno LIKE '%".$q."%' OR materno LIKE '%".$q."%'
        OR nombres LIKE '%".$q."%' OR usuario LIKE '%".$q."%' ";
}
$result = mysqli_query($conn, $query);

if($result->num_rows > 0){
    $tabla.='
    <table class="table table-bordered" id="tabla_resultados">
    <tr>
        <td>Nombre completo</td>
        <td>Usuario</td>
        <td>Acciones</td>
    </tr>';

    while($row = mysqli_fetch_array($result)){
        $id = $row['idUsuario'];
        $nombreCompleto = $row['paterno'].' '.$row['materno'].' '.$row['nombres'];
        $docente ="onClick=\"asignarDocente('".$id."','".$nombreCompleto."');\"";

        $tabla.='
        <tr>
          <td>'.$nombreCompleto.'</td>
          <td>'.$row['usuario'].'</td>
          <td>
            <button '.$docente.' class="btn btn-complementario-c m-2"><i class="fa fa-check"></i></button>
          </td>
        </tr>';
        
    }

    $tabla.="</table>";
} else {
    $tabla.="Sin coincidencias";
}

echo $tabla;

?>