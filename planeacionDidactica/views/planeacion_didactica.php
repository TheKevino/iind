<?php
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }

    include("includes/db.php");

    $user->setUser($userSession->getCurrentUser());
    $idUsuario = $user->getIdUsuario();
    $tipo = $user->getTipo();
    $nombreDocente = $user->getNombre();
    $anio_actual = date("Y");
    $periodo1 = "Enero-Junio";
    $periodo2 = "Verano";
    $periodo3 = "Agosto-Diciembre";

    /*
    $queryMaterias = "SELECT idMateria, clave, nombre FROM materias ORDER BY nombre ASC";
    $resultMaterias = mysqli_query($conn, $queryMaterias);
    */

    $queryMaterias = "SELECT materias.idMateria, materias.clave, materias.nombre as 'nombreMateria', grupos.nombre as 'nombreGrupo', grupos.idGrupo as 'idGrupo' FROM usuarioimparte, materias, grupos 
    WHERE (usuarioimparte.idMateria = materias.idMateria AND usuarioimparte.idGrupo = grupos.idGrupo) AND usuarioimparte.idUsuario = $idUsuario ORDER BY materias.nombre";
    $resultMaterias = mysqli_query($conn, $queryMaterias);

    $queryCarreras = "SELECT idCarrera, nombre FROM carreras ORDER BY nombre ASC";
    $resultCarreras = mysqli_query($conn, $queryCarreras);
    $rowCarreras = mysqli_fetch_array($resultCarreras);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="residencias/img/favicon.ico">
    <title>Crear Planeacion Didactica</title>
    <link rel="stylesheet" href="residencias/css/jquery-ui.css">
    <script src="residencias/js/jquery-ui.js"></script>
    <script src="residencias/js/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Extend Icon -->
    <script
      src="https://kit.fontawesome.com/8eed7147bf.js"
      crossorigin="anonymous"></script>
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

    .btn-alta{
        background-color: #1d1b31;
        color: white;
    }

</style>

  <!-- Formulario -->
    <form class="contenedor" action="planeacionDidactica/controller/crear_planeacion.php?idU=<?=$idUsuario;?>" method="POST">
 
        <div class="card card-body col-md-8 mt-4" id="containerForm">

            <h2>Nueva planeación</h2>

            <div class="row col-md-12">
                <div class="col-md-6 mt-2">
                    <label for="selectMateria">Asignatura:</label>

                    <select class="form-select" name="selectMateria" id="selectMateria" >
                        <!-- PARTE PARA LLENAR EL SELECT DEL FORMULARIO CON LAS CARRERAS -->
                        <?php while($rowMaterias = mysqli_fetch_array($resultMaterias)){ ?>

                        <option value=<?= $rowMaterias['idMateria']."_".$rowMaterias['idGrupo']; ?>><?= $rowMaterias['clave']." - ".utf8_decode($rowMaterias['nombreMateria'])." - ".$rowMaterias['nombreGrupo']; ?></option>
                                
                        <?php } ?>

                    </select>

                </div>

                <div class="col-md-6 mt-2" id="carrera">
                    
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2">
                    <label for="gruposAtendidos">Docente:</label>
                    <input type="text" readonly name="docente" id="docente" class="form-control" value="<?= $nombreDocente; ?>" >
                </div>
                <div class="col-md-6 mt-2">
                    <label for="nombre">Periodo</label>
                    <select class="form-select" name="selectPeriodo" id="selectPeriodo" >
                        <option value ='<?=$periodo1." ".$anio_actual;?>'> <?= $periodo1." ".$anio_actual; ?> </option>
                        <option value ='<?=$periodo2." ".$anio_actual;?>'> <?= $periodo2." ".$anio_actual; ?> </option>
                        <option value ='<?=$periodo3." ".$anio_actual;?>'> <?= $periodo3." ".$anio_actual; ?> </option>
                    </select>
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2" id="grupo">
                    
                </div>

                <div class="col-md-6 mt-2">
                    <label for="aula">Aula:</label>
                    <input type="text" name="aula" id="aula" class="form-control" value="">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2">
                    <label for="semana">Número de semanas:</label>
                    <select class="form-select" name="semana" id="semana">
                        <?php
                            for($i=1 ; $i<=16 ; $i++){
                        ?> 

                        <option <?= $i == 16 ? "selected" : ""; ?> value="<?=$i?>"><?=$i?></option>
                        
                        <?php
                            }
                        ?>
                    </select>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-8">
                    <button class="btn btn-alta" id="btnGuardar">Guardar</button>
                </div>
            </div>

        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="planeacionDidactica/js/planeacion_didactica.js"></script>
</body>
</html>
