<?php

    include("../../includes/db.php");

        
    $id = $_GET['id'];
    $idReporte = base64_encode($_GET['idR']);
    $idUsuario = base64_encode($_GET['idU']);

    $query = "DELETE FROM asignprogramas WHERE idAsignPrograma = $id";

    $result = mysqli_query($conn, $query);

    header("Location: ../views/ver_reporte.php?id=$idReporte&idUs=$idUsuario");


?>