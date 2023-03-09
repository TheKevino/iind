<?php

include('../../includes/db.php');
include('../../includes/user.php');
include('../../includes/user_session.php');

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

$userSession = new UserSession();
$user = new User();
$user->setUser($userSession->getCurrentUser());
$idUsuario = $user->getIdUsuario();
$fecha_actual = date("Y") .'-'. date("m") .'-'.date("d");

$tabla="";
$query = "SELECT grupos.nombre as 'grupo', carreras.nombre as 'carrera', materias.nombre as 'materia', fechaInicio, fechaFin 
        FROM grupos, carreras, materias, usuarios, usuarioimparte 
        WHERE (grupos.idGrupo = usuarioimparte.idGrupo AND carreras.idCarrera = grupos.idCarrera AND grupos.idGrupo = usuarioimparte.idGrupo 
        AND materias.idMateria = usuarioimparte.idMateria) AND (usuarios.idUsuario = usuarioimparte.idUsuario)
        AND ('".$fecha_actual."' BETWEEN fechaInicio AND fechaFin)
        AND usuarioimparte.idUsuario = $idUsuario";
$result = mysqli_query($conn, $query);

if($result->num_rows > 0){
    $tabla.='
    <table class="table table-bordered mt-5" id="tabla_resultados">
    <thead>
        <tr>
            <th>Grupo</th>
            <th>Carrera</th>
            <th>Asignatura</th>
            <th>Fecha de inicio</th>
            <th>Fecha de terminacion</th>
        </tr>
    </thead>
    <tbody>';

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

    $tabla.="</tbody></table>";
} else {
    $tabla.="Sin historial";
}

echo $tabla;

?>