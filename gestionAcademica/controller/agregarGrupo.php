<?php

include("../../includes/db.php");
    
    $carrera =$_POST['selectCarrera'];
    $clave =$_POST['clave'];
    $nombre =$_POST['nombre'];

    $query = "INSERT INTO grupos(idCarrera, clave, nombre) VALUES('$carrera', '$clave', '$nombre')";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }

    header("Location: ../../redirection.php?op=9");

?>