<?php

include("../../includes/db.php");

if( isset( $_POST["btnAgregarTema"] ) ){
    $idMateria = $_GET['id'];

    $noTema = $_POST['noTema'];
    $nombreTema = utf8_encode($_POST['nombreTema']);
    $temasSubtemas = nl2br(utf8_encode($_POST['temasSubtemas']));
    $actsAprendizaje = nl2br(utf8_encode($_POST['actsAprendizaje']));
    $desCompGenericas = nl2br(utf8_encode($_POST['desCompGenericas']));

    $query = "INSERT INTO temas(idMateria, noTema, nombre, temasSubtemas, actsAprendizaje, desCompGenericas)
        VALUES('$idMateria', '$noTema', '$nombreTema', '$temasSubtemas', '$actsAprendizaje', '$desCompGenericas')";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }

    header("Location: ../views/agregar_tema.php?id=$idMateria");

}

?>