<?php
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }

    include("includes/db.php");

    $user->setUser($userSession->getCurrentUser());
    $idUsuario = $user->getIdUsuario();
    $nombreDocente = $user->getNombre();
    $fecha_actual = date("Y") .'-'. date("m") .'-'.date("d");

    $queryMaterias = "SELECT count(DISTINCT usuarioimparte.idMateria) as 'noMaterias' FROM usuarios, usuarioimparte 
    WHERE (usuarios.idUsuario = usuarioimparte.idUsuario) AND ('".$fecha_actual."' BETWEEN usuarioimparte.fechaInicio AND usuarioimparte.fechaFin) 
    AND usuarioimparte.idUsuario = $idUsuario";

    $resultMaterias = mysqli_query($conn, $queryMaterias);

    $numMaterias = mysqli_fetch_array($resultMaterias);

    $queryGrupos = "SELECT count(DISTINCT usuarioimparte.idGrupo) as 'noGrupos' FROM usuarios, usuarioimparte 
    WHERE (usuarios.idUsuario = usuarioimparte.idUsuario) AND ('".$fecha_actual."' BETWEEN usuarioimparte.fechaInicio AND usuarioimparte.fechaFin)
    AND usuarioimparte.idUsuario = $idUsuario";

    $resultGrupos = mysqli_query($conn, $queryGrupos);

    $numGrupos = mysqli_fetch_array($resultGrupos);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="residencias/img/favicon.ico">
    <title>Crear Reporte Final</title>
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
    <form class="contenedor" action="reporteFinalCurso/controller/crear_formulario.php?idU=<?= $idUsuario; ?>" method="POST">
 
        <div class="card card-body col-md-8 mt-4" id="containerForm">

            <h2>Creacion del reporte.</h2>

            <div class="row col-md-12">
                <div class="col-md-6 mt-2">
                    <label for="departamento">Departamento:</label>
                    <input type="text" class="form-control" placeholder="Departamento" name="departamento" id="departamento" value="Ingeniería Industrial">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="nombre">Nombre completo del docente:</label>
                    <input type="text" class="form-control" readonly placeholder="Nombre completo" name="nombre" id="nombre" value="<?= $nombreDocente; ?>">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2">
                    <label for="inicioSemestre">Inicio del semestre</label>
                    <input type="date" class="form-control" placeholder="Inicio del semestre" name="inicioSemestre" id="inicioSemestre">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="finSemestre">Final del semestre:</label>
                    <input type="date" class="form-control" placeholder="Final del semestre" name="finSemestre" id="finSemestre">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2">
                    <label for="finSemestre">No. de grupos atendidos:</label>
                    <input type="number" name="gruposAtendidos" id="gruposAtendidos" class="form-control" value="<?= $numGrupos['noGrupos']; ?>" >
                </div>

                <div class="col-md-6 mt-2">
                    <label for="finSemestre">No. de asignaturas diferentes:</label>
                    <input type="number" name="asignaturasDiferentes" id="asignaturasDiferentes" class="form-control" value="<?= $numMaterias['noMaterias']; ?>">
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-8">
                    <button class="btn btn-warning" id="btnGuardar">Guardar</button>
                </div>
            </div>

        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="reporteFinalCurso/js/reporte_formulario.js"></script>
</body>
</html>
