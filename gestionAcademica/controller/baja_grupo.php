<?php

    include("../../includes/db.php");

        
        $id = $_POST['id'];

        $query = "DELETE FROM grupos WHERE idGrupo = $id";

        $result = mysqli_query($conn, $query);

        if(!$result){
            die("Query failed");
        }
?>