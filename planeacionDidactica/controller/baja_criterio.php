<?php

    include("../../includes/db.php");

        
    $id = base64_decode($_GET['id']);
    $idUsuario = base64_decode($_GET['idu']);
    $idPlaneacion = base64_decode($_GET['idp']);

    $query = "DELETE FROM matrizevaluacion WHERE idCriterio = $id";

    $result = mysqli_query($conn, $query);

    header("Location: ../views/ver_planeacion.php?id=".base64_encode($idPlaneacion)."&idu=".base64_encode($idUsuario));


?>