<?php

    include("../../includes/db.php");

    $id = $_GET['id'];
    $idU= $_GET['idU'];
    $concepto;
    $tipoFirma;

    if(isset($_POST['asesorFirma'])){
        $concepto = "firmaAsesorInterno";
        $tipoFirma = "firma";
    }

    if(isset($_POST['asesorFirmaQR'])){
        $concepto = "firmaAsesorInterno";
        $tipoFirma = "firmaQR";
    }

    if(isset($_POST['revisor1Firma'])){
        $concepto = "firmaRevisor1";
        $tipoFirma = "firma";
    }

    if(isset($_POST['revisor1FirmaQR'])){
        $concepto = "firmaRevisor1";
        $tipoFirma = "firmaQR";
    }

    if(isset($_POST['revisor2Firma'])){
        $concepto = "firmaRevisor2";
        $tipoFirma = "firma";
    }

    if(isset($_POST['revisor2FirmaQR'])){
        $concepto = "firmaRevisor2";
        $tipoFirma = "firmaQR";
    }

    $query="UPDATE formularios SET $concepto = (SELECT $tipoFirma FROM usuarios WHERE idUsuario=$idU) WHERE idFormulario=$id";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Error");
    } else{
        header("Location: ../Formularios/formulario1.php?id=".base64_encode($id));
    }

?>