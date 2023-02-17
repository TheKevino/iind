<?php

    include("../../includes/db.php");

        
    $idCalendarizacion = base64_decode($_GET['id']);
    $idUsuario = base64_decode($_GET['idu']);
    $idPlaneacion = base64_decode($_GET['idp']);

    $query = "DELETE FROM calendarizaciones WHERE idCalendarizacion = $idCalendarizacion";

    $result = mysqli_query($conn, $query);

    header("Location: ../views/ver_planeacion.php?id=".base64_encode($idPlaneacion)."&idu=".base64_encode($idUsuario));


?>