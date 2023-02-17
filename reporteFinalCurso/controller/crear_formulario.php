<?php

    include("../../includes/db.php");
    
    $idUsuario = $_GET['idU'];
    $departamento = $_POST['departamento'];
    $nombre = $_POST['nombre'];
    $inicioSemestre = $_POST['inicioSemestre'];
    $finSemestre = $_POST['finSemestre'];
    $gruposAtendidos = $_POST['gruposAtendidos'];
    $asignaturasDiferentes = $_POST['asignaturasDiferentes'];

    $query = "INSERT INTO reportefinal(idUsuario, departamento, inicioSemestre, finalSemestre, nombreDocente, gruposAtendidos, asignaturasDiferentes)
        VALUES ('$idUsuario', '$departamento', '$inicioSemestre', '$finSemestre', '$nombre', '$gruposAtendidos', '$asignaturasDiferentes')";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }

    header("Location: ../../redirection.php?op=reporteFinal");
?>