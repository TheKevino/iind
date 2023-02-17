<?php

include('../../includes/db.php');
include('../../includes/user.php');
include('../../includes/user_session.php');

$userSession = new UserSession();
$user = new User();
$user->setUser($userSession->getCurrentUser());
$idUsuario = $user->getIdUsuario();

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


$tabla="";
$query = "SELECT grupos.nombre as 'grupo', carreras.nombre as 'carrera', materias.nombre as 'materia', fechaInicio, fechaFin 
        FROM grupos, carreras, materias, usuarios, usuarioimparte 
        WHERE (grupos.idGrupo = usuarioimparte.idGrupo AND carreras.idCarrera = grupos.idCarrera AND grupos.idGrupo = usuarioimparte.idGrupo 
        AND materias.idMateria = usuarioimparte.idMateria) AND (usuarios.idUsuario = usuarioimparte.idUsuario) 
        AND usuarioimparte.idUsuario = $idUsuario";

if(isset($_POST['clases'])){
    $q=$conn->real_escape_string($_POST['clases']);
    $query = "SELECT grupos.nombre as 'grupo', carreras.nombre as 'carrera', materias.nombre as 'materia', fechaInicio, fechaFin 
        FROM grupos, carreras, materias, usuarios, usuarioimparte 
        WHERE (grupos.idGrupo = usuarioimparte.idGrupo AND carreras.idCarrera = grupos.idCarrera AND grupos.idGrupo = usuarioimparte.idGrupo 
        AND materias.idMateria = usuarioimparte.idMateria) AND (usuarios.idUsuario = usuarioimparte.idUsuario) 
        AND (grupos.nombre LIKE '%".$q."%' OR carreras.nombre LIKE '%".$q."%' OR materias.nombre LIKE '%".$q."%' 
        OR fechaInicio LIKE '%".$q."%' OR fechaFin LIKE '%".$q."%')
        AND usuarioimparte.idUsuario = $idUsuario ORDER BY fechaFin DESC";
}
$result = mysqli_query($conn, $query);

if($result->num_rows > 0){
    $tabla.='
    <table class="table table-striped table-bordered" id="tabla_resultados">
    <tr>
        <th>Grupo</th>
        <th>Carrera</th>
        <th>Asignatura</th>
        <th>Fecha de inicio</th>
        <th>Fecha de terminacion</th>
    </tr>';

    while($row = mysqli_fetch_array($result)){
        $fechaInicial = explode("-", $row['fechaInicio']); 
        $fechaFinal = explode("-", $row['fechaFin']);

        $tabla.='
        <tr>
          <td>'.$row['grupo'].'</td>
          <td>'.$row['carrera'].'</td>
          <td>'.utf8_decode($row['materia']).'</td>
          <td>'.$fechaInicial[2]." de ". $meses[$fechaInicial[1]]." del ".$fechaInicial[0].'</td>
          <td>'.$fechaFinal[2]." de ". $meses[$fechaFinal[1]]." del ".$fechaFinal[0].'</td>
        </tr>';
        
    }

    $tabla.="</table>";
} else {
    $tabla.="Sin historial";
}

echo $tabla;

?>