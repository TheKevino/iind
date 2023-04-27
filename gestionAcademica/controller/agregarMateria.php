<?php

include("../../includes/db.php");
    
    $carrera = $_POST['selectCarrera'];
    $clave = $_POST['claveMateria'];
    $nombre = utf8_encode($_POST['nombreMateria']);
    $satca = $_POST['satca'];
    $caracterizacion = nl2br(utf8_encode($_POST['caracterizacion']));
    $intencionDidactica = nl2br(utf8_encode($_POST['intencion']));
    $competenciasPrevias = nl2br(utf8_encode($_POST['previas']));
    $competenciasGenericas = nl2br(utf8_encode($_POST['genericas']));
    $competenciasEspecificas = nl2br(utf8_encode($_POST['especificas']));
    $fuentes = nl2br(utf8_encode($_POST['fuentes']));
    $apDidacticos = nl2br(utf8_encode($_POST['apDidacticos']));

    $query = "INSERT INTO materias(idCarrera, clave, nombre, satca, caracterizacion, intencionDidactica, competenciasPrevias, 
    competenciasGenericas, competenciasEspecificas, fuentes, apoyosDidacticos) VALUES('$carrera', '$clave', '$nombre', '$satca', '$caracterizacion', 
    '$intencionDidactica', '$competenciasPrevias', '$competenciasGenericas', '$competenciasEspecificas', '$fuentes', '$apDidacticos')";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }


?>