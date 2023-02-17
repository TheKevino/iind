<?php

include('../../includes/db.php');

$tabla="";
$query = "SELECT * FROM usuarios WHERE tipo != 2";

if(isset($_POST['usuarios'])){
    $q=$conn->real_escape_string($_POST['usuarios']);
    $query = "SELECT * FROM usuarios WHERE
        (idUsuario LIKE '%".$q."%' OR
        paterno LIKE '%".$q."%' OR materno LIKE '%".$q."%'
        OR nombres LIKE '%".$q."%' OR usuario LIKE '%".$q."%'
        OR correo LIKE '%".$q."%') AND tipo != 2 ";
}
$result = mysqli_query($conn, $query);

$cosa = 5;

if($result->num_rows > 0){
    $tabla.='
    <table class="table table-bordered" id="tabla_resultados">
    <tr>
        <td>ID</td>
        <td>Nombre completo</td>
        <td>Acciones</td>
    </tr>';

    while($row = mysqli_fetch_array($result)){

        $id = $row['idUsuario'];
        $nombreCompleto = $row['paterno'].' '.$row['materno'].' '.$row['nombres'];
        $asesor ="onClick=\"asignarAsesor('".$id."','".$nombreCompleto."','".$row['correo']."');\"";
        $primerRevisor ="onClick=\"asignarRevisor1('".$id."','".$nombreCompleto."','".$row['correo']."');\""; 
        $segundoRevisor ="onClick=\"asignarRevisor2('".$id."','".$nombreCompleto."','".$row['correo']."');\""; 

        $tabla.='
        <tr>
            <td class="col-md-1">'.$id.'</td>
            <td class="col-md-5">'.$nombreCompleto.'</td>
            <td class="col-md-6">
                <button '.$asesor.' class="btn btn-principal m-2">Asesor Interno</button>
                <button '.$primerRevisor.' class="btn btn-complementario-a m-2">Revisor 1</button>
                <button '.$segundoRevisor.' class="btn btn-complementario-c m-2">Revisor 2</button>
            </td>
        </tr>';
        
    }

    $tabla.="</table>";
} else {
    $tabla.="Sin coincidencias";
}

echo $tabla;

?>