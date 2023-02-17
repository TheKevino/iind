<?php

include("../../includes/db.php");

$idTema = $_GET['id'];
$idMateria = $_GET['idm'];

echo $idTema . "\n";
echo $idMateria . "\n";


$query = "DELETE FROM temas WHERE idTema = $idTema AND idMateria = $idMateria";

$result = mysqli_query($conn, $query);

if(!$result){
    die("Query failed");
}

header("Location: ../views/temas.php?id=$idMateria");


?>