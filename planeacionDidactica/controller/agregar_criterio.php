<?php

include("../../includes/db.php");

$idTema = $_GET["id"];
$idUsuario = $_GET["idu"];
$idPlaneacion = $_GET["idp"];

$evidencia = utf8_encode($_POST["evidencia"]);
$porcentaje = $_POST["porcentaje"];

$A = isset($_POST["a"]) ? $_POST["a"] : 0;
$B = isset($_POST["b"]) ? $_POST["b"] : 0;
$C = isset($_POST["c"]) ? $_POST["c"] : 0;
$D = isset($_POST["d"]) ? $_POST["d"] : 0;
$E = isset($_POST["e"]) ? $_POST["e"] : 0;
$F = isset($_POST["f"]) ? $_POST["f"] : 0;

$instrumentos = nl2br(utf8_encode($_POST["instrumentos"]));

$query = "INSERT INTO matrizevaluacion(idTema, idUsuario, evidencia, porcentaje, a, b, c, d, e, f, instrumentos)
    VALUES('$idTema', '$idUsuario', '$evidencia', '$porcentaje', '$A', '$B', '$C', '$D', '$E', '$F', '$instrumentos')";

$result = mysqli_query($conn, $query);
header("Location: ../views/criterios_evaluacion.php?id=".base64_encode($idTema)."&idu=".base64_encode($idUsuario)."&idp=".base64_encode($idPlaneacion));
//header("Location: ../views/ver_planeacion.php?id=".base64_encode($idPlaneacion)."&idu=".base64_encode($idUsuario));

?>