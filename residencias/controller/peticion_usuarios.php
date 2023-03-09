<?php

include('../../includes/db.php');

$tabla="";
$query = "SELECT idUsuario, paterno, materno, nombres, usuario, password, correo
             FROM usuarios WHERE tipo != 2 ORDER BY paterno ASC";

if(isset($_POST['usuarios'])){
    $q=$conn->real_escape_string($_POST['usuarios']);
    $query = "SELECT idUsuario, paterno, materno, nombres, usuario, password, correo FROM usuarios WHERE
        (idUsuario LIKE '%".$q."%' OR
        paterno LIKE '%".$q."%' OR materno LIKE '%".$q."%'
        OR nombres LIKE '%".$q."%' OR usuario LIKE '%".$q."%'
        OR correo LIKE '%".$q."%') AND tipo != 2 ORDER BY paterno ASC";
}
$result = mysqli_query($conn, $query);

if($result->num_rows > 0){
    $tabla.='
    <table class="table table-bordered" id="tabla_resultados_consulta_usuarios">
    <tr>
        <th>ID</th>
        <th>Ap. Paterno</th>
        <th>Ap. Materno</th>
        <th>Nombre(s)</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>';

    while($row = mysqli_fetch_array($result)){
        $tabla.='
        <tr>
          <td>'.$row['idUsuario'].'</td>
          <td>'.$row['paterno'].'</td>
          <td>'.$row['materno'].'</td>
          <td>'.$row['nombres'].'</td>
          <td>'.$row['correo'].'</td>
          <td>
              <a class="btn btn-editar" href="residencias/views/editar_usuario.php?id='.$row['idUsuario'].'">
                <i class="fas fa-marker"></i>
              </a>

              <a href="residencias/controller/baja_usuario.php?id='.$row['idUsuario'].'">
                <button class="btn btn-borrar" onclick="return confirmacion()"><i class="fas fa-trash"></i></button>
              </a>

              <a href="residencias/controller/recuperar_info.php?id='.$row['idUsuario'].'"">
                <button class="btn btn-principal"><i class="fa fa-key"></i></button>
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
        let respuesta = confirm("Seguro(a) que quieres eliminar al usuario?");
        
        if(respuesta == true){ 
            return true;
        } else { 
            return false;
        }
    }
</script>