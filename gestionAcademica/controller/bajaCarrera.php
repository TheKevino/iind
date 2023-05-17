<?php

    include("../../includes/db.php");

        
        $id = $_POST['id'];

        $query = "DELETE FROM carreras WHERE idCarrera = $id";

        $result = mysqli_query($conn, $query);

        if(!$result){
            die("Query failed");
        }

?>