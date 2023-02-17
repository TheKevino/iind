<?php

include('../includes/db.php');

if(isset($_POST['btnEditarEncargados'])){

    $nuevoJefeDivEstudiosPro = $_POST['estudiosPro'];
    $nuevoJefeDeptoIngIndustrial = $_POST['jefeIndustrial'];

    if(empty($nuevoJefeDivEstudiosPro) || empty($nuevoJefeDeptoIngIndustrial)){
        header("Location: ../redirection.php?op=7");
    } else{

        $query = "UPDATE encargados SET jefeDivisionEstudiosProf = '$nuevoJefeDivEstudiosPro', jefeDeptoIngInd = '$nuevoJefeDeptoIngIndustrial'
             WHERE id=1";
        $result = mysqli_query($conn, $query);
        header("Location: ../redirection.php?op=0");

    }
}

?>