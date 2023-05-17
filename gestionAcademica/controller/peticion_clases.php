<?php

include('../../includes/db.php');

$tabla="";
$query = "SELECT idClase, usuarios.paterno as 'paterno', usuarios.materno as 'materno', usuarios.nombres as 'nombres', 
        materias.nombre as 'materia', grupos.nombre as 'grupo', fechaInicio, fechaFin FROM usuarios, materias, grupos, usuarioimparte
          WHERE usuarios.idUsuario = usuarioimparte.idUsuario AND usuarioimparte.idMateria = materias.idMateria 
          AND usuarioimparte.idGrupo = grupos.idGrupo ORDER BY grupos.nombre";

if(isset($_POST['clases'])){
    $q=$conn->real_escape_string($_POST['clases']);
    $query = "SELECT idClase, usuarios.paterno as 'paterno', usuarios.materno as 'materno', usuarios.nombres as 'nombres', 
        materias.nombre as 'materia', grupos.nombre as 'grupo', fechaInicio, fechaFin FROM usuarios, materias, grupos, usuarioimparte
        WHERE (usuarios.idUsuario = usuarioimparte.idUsuario AND usuarioimparte.idMateria = materias.idMateria 
        AND usuarioimparte.idGrupo = grupos.idGrupo) AND (usuarios.paterno LIKE '%".$q."%' OR usuarios.materno LIKE '%".$q."%' OR
        usuarios.nombres LIKE '%".$q."%' OR materias.nombre LIKE '%".$q."%' OR grupos.nombre LIKE '%".$q."%') ORDER BY grupos.nombre";
}
$result = mysqli_query($conn, $query);

$meses = array(
    "01" => "enero",
    "02" => "febrero",
    "03" => "marzo",
    "04" => "abril",
    "05" => "mayo",
    "06" => "junio",
    "07" => "julio",
    "08" => "agosto",
    "09" => "septiembre",
    "10" => "octubre",
    "11" => "noviembre",
    "12" => "diciembre",
);

if($result->num_rows > 0){
    $tabla.='
    <table class="table table-striped table-bordered" id="tabla_resultados">
    <tr>
        <th>Docente</th>
        <th>Asignatura</th>
        <th>Grupo</th>
        <th>Fecha de inicio</th>
        <th>Fecha de terminacion</th>
        <th>Acciones</th>
    </tr>';

    while($row = mysqli_fetch_array($result)){
        $fechaInicial = explode("-", $row['fechaInicio']); 
        $fechaFinal = explode("-", $row['fechaFin']);

        $tabla.='
        <tr>
          <td>'.$row['paterno']." ".$row['materno']." ".$row['nombres'].'</td>
          <td>'.utf8_decode($row['materia']).'</td>
          <td>'.$row['grupo'].'</td>
          <td>'.$fechaInicial[2]." de ". $meses[$fechaInicial[1]]." del ".$fechaInicial[0].'</td>
          <td>'.$fechaFinal[2]." de ". $meses[$fechaFinal[1]]." del ".$fechaFinal[0].'</td>
          <td>
              <a>
                <button class="btn-consulta" onclick="borrarClase('.$row['idClase'].')"><i class="fas fa-trash"></i></button>
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
        let respuesta = confirm("Seguro(a) que quieres eliminar la clase?");
        
        return respuesta;
    }
</script>