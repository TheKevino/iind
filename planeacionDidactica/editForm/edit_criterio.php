<?php

    include("../../includes/db.php");

    $idCriterio = base64_decode($_GET["id"]);
    $idUsuario = base64_decode($_GET["idu"]);
    $idPlaneacion = base64_decode($_GET["idp"]);

    
    $query = "SELECT evidencia, porcentaje, a, b, c, d, e, f, instrumentos FROM matrizevaluacion
        WHERE idCriterio = $idCriterio";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $evidencia = utf8_decode($row["evidencia"]);

    $porcentaje = $row["porcentaje"];

    $a = $row["a"] == 1? "checked" : "";
    $b = $row["b"] == 1? "checked" : "";
    $c = $row["c"] == 1? "checked" : "";
    $d = $row["d"] == 1? "checked" : "";
    $e = $row["e"] == 1? "checked" : "";
    $f = $row["f"] == 1? "checked" : "";

    $instrumentos = utf8_decode($row["instrumentos"]);
    $instrumentos = str_replace("<br />", "", $instrumentos);

    if(isset($_POST["btnAgregar"])){
          
        $idCriterio = base64_decode($_GET["id"]);
        $idUsuario = base64_decode($_GET["idu"]);
        $idPlaneacion = base64_decode($_GET["idp"]);

        $evidencia = utf8_encode($_POST["evidencia"]);
        $porcentaje = $_POST["porcentaje"];

        $A = isset($_POST["a"]) ? $_POST["a"] : 0;
        $B = isset($_POST["b"]) ? $_POST["b"] : 0;
        $C = isset($_POST["c"]) ? $_POST["c"] : 0;
        $D = isset($_POST["d"]) ? $_POST["d"] : 0;
        $E = isset($_POST["e"]) ? $_POST["e"] : 0;
        $F = isset($_POST["f"]) ? $_POST["f"] : 0;

        $instrumentos = nl2br(utf8_encode($_POST["instrumentos"]));

        $query = "UPDATE matrizevaluacion SET evidencia = '$evidencia', porcentaje = '$porcentaje', 
        a = '$A', b = '$B', c = '$C', d = '$D', e = '$E', f = '$F', instrumentos = '$instrumentos' WHERE idCriterio = $idCriterio";

        $result = mysqli_query($conn, $query);

        header("Location: ../views/ver_planeacion.php?id=".base64_encode($idPlaneacion)."&idu=".base64_encode($idUsuario));

    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../residencias/img/favicon.ico">
    <title>Editar criterio de evaluacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Extend Icon -->
    <script
      src="https://kit.fontawesome.com/8eed7147bf.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>

<style>

    .contenedor{
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

</style>

  <!-- Formulario -->
    <form class="contenedor" action="edit_criterio.php?id=<?=base64_encode($idCriterio);?>&idu=<?=base64_encode($idUsuario);?>&idp=<?=base64_encode($idPlaneacion);?>" method="POST">
 
        <div class="card card-body col-md-8 mt-4" id="containerForm">

            <h2>Editar criterio de evaluacion.</h2>

            <div class="row col-md-12">
                <div class="col-md-6 mt-2">
                    <label for="evidencia">Evidencia de aprendizaje:</label>
                    <input type="text" class="form-control" name="evidencia" id="evidencia" value="<?=$evidencia;?>">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="porcentaje">Porcentaje:</label>
                    <input type="text" class="form-control" name="porcentaje" id="porcentaje" value="<?=$porcentaje;?>">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-12 mt-2">
                <label for="checkgroup">Indicadores de alcance:</label>

                <div class="form-check" id="checkgroup">
                    <input class="form-check-input" type="checkbox" value="1" name="a" id="a" <?=$a?> >
                    <label class="form-check-label" for="a">A</label>
                </div>

                <div class="form-check" id="checkgroup">
                    <input class="form-check-input" type="checkbox" value="1" name="b" id="b" <?=$b?> >
                    <label class="form-check-label" for="b">B</label>
                </div>

                <div class="form-check" id="checkgroup">
                    <input class="form-check-input" type="checkbox" value="1" name="c" id="c" <?=$c?> >
                    <label class="form-check-label" for="c">C</label>
                </div>

                <div class="form-check" id="checkgroup">
                    <input class="form-check-input" type="checkbox" value="1" name="d" id="d" <?=$d?> >
                    <label class="form-check-label" for="d">D</label>
                </div>

                <div class="form-check" id="checkgroup">
                    <input class="form-check-input" type="checkbox" value="1" name="e" id="e" <?=$e?> >
                    <label class="form-check-label" for="e">E</label>
                </div>

                <div class="form-check" id="checkgroup">
                    <input class="form-check-input" type="checkbox" value="1" name="f" id="f" <?=$f?> >
                    <label class="form-check-label" for="f">F</label>
                </div>

                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-12 mt-2">
                    <label for="finSemestre">Instrumentos de evaluacion:</label>
                    <textarea name="instrumentos" id="instrumentos" class="form-control"><?=$instrumentos;?></textarea>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-8">
                    <button class="btn btn-warning" name="btnAgregar" id="btnAgregar">Editar</button>
                </div>
            </div>

        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/criterios_evaluacion.js"></script>
</body>
</html>
