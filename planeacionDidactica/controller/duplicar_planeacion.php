<?php
    include("../../includes/db.php");

    $idplaneacion = base64_decode($_GET["idplaneacion"]);

    $query = "  INSERT INTO planeaciondidactica(idUsuario, idMateria, idCarrera, nombreDocente, grupo, periodo, aula, fuentes, apoyosDidacticos, noSemanas)
                SELECT idUsuario, idMateria, idCarrera, nombreDocente, grupo, periodo, aula, fuentes, apoyosDidacticos, noSemanas FROM planeaciondidactica 
                WHERE idPlaneacion = $idplaneacion";

    if( mysqli_query($conn, $query) ){

        $idnuevaplaneacion = mysqli_insert_id($conn);
        $nuevaquery = " SELECT * FROM infotemas WHERE idPlaneacion = $idplaneacion";
        $resultado = mysqli_query($conn, $nuevaquery);
    
        if (mysqli_num_rows($resultado) > 0) {
            // Recorrer las filas del resultado utilizando un bucle while
            while ($fila = mysqli_fetch_assoc($resultado)) {

                $queryinfotemas = " INSERT INTO infotemas(idPlaneacion, idTema, idUsuario, actsEnsenanza)
                                    SELECT $idnuevaplaneacion, idTema, idUsuario, actsEnsenanza FROM infotemas
                                    WHERE idInfo=".$fila["idInfo"];
                mysqli_query($conn, $queryinfotemas);
                
            }
        }

    }

    header("Location: ../../redirection.php");

?>