<?php

include("../../includes/db.php");

$queryUsuarios = "SELECT idUsuario FROM usuarios";
$resultUsuarios = mysqli_query($conn, $queryUsuarios);


while($rowUsuarios = mysqli_fetch_array($resultUsuarios)){

    $idUsuario = $rowUsuarios["idUsuario"];

    $queryPlaneaciones = "SELECT idPlaneacion, idMateria FROM planeaciondidactica WHERE idUsuario = $idUsuario";
    $resultPlaneaciones = mysqli_query($conn, $queryPlaneaciones);

    while($rowPlaneaciones = mysqli_fetch_array($resultPlaneaciones)){

        $idPlaneacion = $rowPlaneaciones["idPlaneacion"];

        $queryInfos = 'SELECT planeaciondidactica.idPlaneacion as "planeacion", infotemas.idInfo as "info" FROM planeaciondidactica, infotemas, temas, materias 
        WHERE (infotemas.idTema = temas.idTema AND temas.idMateria = materias.idMateria AND materias.idMateria = planeaciondidactica.idMateria)
        AND planeaciondidactica.idUsuario = '.$idUsuario.' AND planeaciondidactica.idPlaneacion = '.$idPlaneacion;
        $resultInfos = mysqli_query($conn, $queryInfos);

        while($rowInfos = mysqli_fetch_array($resultInfos)){

            $idInfo = $rowInfos["info"];

            $queryInfo = "SELECT * from infotemas where idInfo = $idInfo";
            $resultInfo = mysqli_query($conn, $queryInfo);

            while($rowInfo = mysqli_fetch_array($resultInfo)){
                $idInfoTema = $rowInfo["idInfo"];
                if($rowInfo["idUsuario"] == $idUsuario){

                    $queryCorreccion = "UPDATE infotemas SET idPlaneacion = $idPlaneacion WHERE idInfo = $idInfoTema";
                    $resultCorreccion = mysqli_query($conn, $queryCorreccion);

                    if(!$resultCorreccion){
                        echo mysqli_error($conn);
                    }
                    
                }
            }//fin while
            
        }//fin while


    }//fin while
    
}//fin while


?>