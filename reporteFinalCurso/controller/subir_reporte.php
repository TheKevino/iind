<?php

include("../../includes/db.php");

$idReporte = $_GET['idR'];
$idUsuario = $_GET['idU'];

$query = "UPDATE reportefinal set estado = 'subido' WHERE idReporte=$idReporte AND idUsuario=$idUsuario";

$result = mysqli_query($conn, $query);

header("Location: ../views/ver_reporte.php?id=".base64_encode($idReporte)."&idUs=".base64_encode($idUsuario));

?>