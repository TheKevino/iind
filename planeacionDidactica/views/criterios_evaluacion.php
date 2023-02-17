<?php

    $idTema = base64_decode($_GET["id"]);
    $idUsuario = base64_decode($_GET["idu"]);
    $idPlaneacion = base64_decode($_GET["idp"]);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../residencias/img/favicon.ico">
    <title>Nuevo criterio de evaluacion</title>
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
    <form class="contenedor" action="../controller/agregar_criterio.php?id=<?=$idTema;?>&idu=<?=$idUsuario;?>&idp=<?=$idPlaneacion;?>" method="POST">
 
        <div class="card card-body col-md-8 mt-4" id="containerForm">

            <h2>Nuevo criterio de evaluacion.</h2>

            <div class="row col-md-12">
                <div class="col-md-6 mt-2">
                    <label for="evidencia">Evidencia de aprendizaje:</label>
                    <input type="text" class="form-control" name="evidencia" id="evidencia">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="porcentaje">Porcentaje:</label>
                    <input type="text" class="form-control" name="porcentaje" id="porcentaje">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-12 mt-2">
                    <label for="checkgroup">Indicadores de alcance:</label>

                    <div class="form-check" id="checkgroup">
                        <input class="form-check-input" type="checkbox" value="1" name="a" id="a">
                        <label class="form-check-label" for="a">A: Se adapta a situaciones y contextos complejos.</label>
                    </div>

                    <div class="form-check" id="checkgroup">
                        <input class="form-check-input" type="checkbox" value="1" name="b" id="b">
                        <label class="form-check-label" for="b">B: Hace aportaciones a las actividades académicas desarrolladas.</label>
                    </div>

                    <div class="form-check" id="checkgroup">
                        <input class="form-check-input" type="checkbox" value="1" name="c" id="c">
                        <label class="form-check-label" for="c">C: Propone y/o explica soluciones o procedimientos no vistos en clase (cratividad).</label>
                    </div>

                    <div class="form-check" id="checkgroup">
                        <input class="form-check-input" type="checkbox" value="1" name="d" id="d">
                        <label class="form-check-label" for="d">D: Introduce recursos y experiencias que promueven un pensamiento crítico; (por ejemplo, el uso de las tecnologías de la información estableciendo previamente un criterio).</label>
                    </div>

                    <div class="form-check" id="checkgroup">
                        <input class="form-check-input" type="checkbox" value="1" name="e" id="e">
                        <label class="form-check-label" for="e">E: Incorpora conocimientos y actividades interdisciplinarias en su aprendizaje.</label>
                    </div>

                    <div class="form-check" id="checkgroup">
                        <input class="form-check-input" type="checkbox" value="1" name="f" id="f">
                        <label class="form-check-label" for="f">F: Realiza su trabajo de manera autónoma y autorregulada.</label>
                    </div>

                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-12 mt-2">
                    <label for="finSemestre">Instrumentos de evaluacion:</label>
                    <textarea name="instrumentos" id="instrumentos" class="form-control"></textarea>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-8">
                    <button class="btn btn-warning" name="btnAgregar" id="btnAgregar">Agregar</button>
                </div>
            </div>

        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/criterios_evaluacion.js"></script>
</body>
</html>
