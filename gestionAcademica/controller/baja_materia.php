<?php

    include("../../includes/db.php");

        
        $id = $_POST['id'];

        echo("alert($id)");

        $query = "DELETE FROM materias WHERE idMateria = $id";

        $result = mysqli_query($conn, $query);

        if(!$result){
            die("Query failed");
        }

?>