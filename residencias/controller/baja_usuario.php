<?php

    include("../../includes/db.php");

        
        $id = $_POST['id'];

        //Borrar usuario
        $query = "DELETE FROM usuarios WHERE idUsuario = $id";
        $result = mysqli_query($conn, $query) or die("Error". mysqli_error($conn));

        //Borrar Firma
        $queryFirma = "SELECT firma, firmaQR FROM usuarios WHERE idUsuario = $id";
        $resultFirma = mysqli_query($conn, $queryFirma);
        $row = mysqli_fetch_array($resultFirma);

        if($row['firma'] != null){
            unlink("../".$row['firma']);
        }

        if($row['firmaQR'] != null){
            unlink("../".$row['firmaQR']);
        }

?>