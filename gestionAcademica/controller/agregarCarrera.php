<?php

include("../../includes/db.php");
    
if(isset($_POST["btnAgregarCarrera"])){
    
    $carrera =$_POST['carrera'];

    $query = "INSERT INTO carreras(nombre) VALUES('$carrera')";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }

    header("Location: ../../redirection.php?op=10");
}

?>