<?php

    include("../../includes/db.php");

        
    $id = base64_decode($_GET['id']);

    $query = "DELETE FROM planeaciondidactica WHERE idPlaneacion = $id";

    $result = mysqli_query($conn, $query);

    header("Location: ../../redirection.php?");


?>