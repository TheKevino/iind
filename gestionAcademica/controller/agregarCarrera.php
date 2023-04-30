<?php

include("../../includes/db.php");
    
    $carrera =$_POST['carrera'];

    $query = "INSERT INTO carreras(nombre) VALUES('$carrera')";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }


?>