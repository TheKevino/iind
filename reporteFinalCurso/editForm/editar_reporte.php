<?php
    include("../../includes/db.php");
    $idReporte = base64_decode($_GET['id']);

    $query = "SELECT departamento, inicioSemestre, finalSemestre, nombreDocente, gruposAtendidos, asignaturasDiferentes FROM reportefinal 
    where idReporte=$idReporte";

    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }

    $row = mysqli_fetch_array($result);

    if( isset($_POST['btnGuardar']) ){
        $idReporte = base64_decode($_GET['id']);
        $departamento = $_POST['departamento'];
        $inicioSemestre = $_POST['inicioSemestre'];
        $finalSemestre = $_POST['finSemestre'];
        $nombreDocente = $_POST['nombre'];
        $gruposAtendidos = $_POST['gruposAtendidos'];
        $asignaturasDiferentes = $_POST['asignaturasDiferentes'];

        $query = "UPDATE reportefinal SET departamento = '$departamento', inicioSemestre = '$inicioSemestre', finalSemestre = '$finalSemestre', 
            nombreDocente = '$nombreDocente', gruposAtendidos = '$gruposAtendidos', asignaturasDiferentes = '$asignaturasDiferentes' WHERE idReporte=$idReporte";
        $result = mysqli_query($conn, $query);
        header("Location: ../../redirection.php?op=reporteFinal");
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../residencias/img/favicon.ico" />
    <title>Editar Reporte Final</title>
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
    <form class="contenedor" action="editar_reporte.php?id=<?= base64_encode($idReporte);?>" method="POST">
 
        <div class="card card-body col-md-8 mt-5" id="containerForm">
            <h2>Edicion del reporte</h2>

            <div class="row col-md-12">
                <div class="col-md-6 mt-2">
                    <label for="departamento">Departamento:</label>
                    <input type="text" class="form-control" placeholder="Departamento" name="departamento" id="departamento" value = "<?= $row['departamento']; ?>">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="nombre">Nombre completo del docente:</label>
                    <input type="text" class="form-control" readonly placeholder="Nombre completo" name="nombre" id="nombre" value = "<?= $row['nombreDocente']; ?>">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2">
                    <label for="inicioSemestre">Inicio del semestre</label>
                    <input type="date" class="form-control" placeholder="Inicio del semestre" name="inicioSemestre" id="inicioSemestre" value = "<?= $row['inicioSemestre']; ?>">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="finSemestre">Final del semestre:</label>
                    <input type="date" class="form-control" placeholder="Final del semestre" name="finSemestre" id="finSemestre" value = "<?= $row['finalSemestre']; ?>">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2">
                    <label for="finSemestre">No. de grupos atendidos:</label>
                    <input type="number" name="gruposAtendidos" id="gruposAtendidos" class="form-control" value = "<?= $row['gruposAtendidos']; ?>" >
                </div>

                <div class="col-md-6 mt-2">
                    <label for="finSemestre">No. de asignaturas diferentes:</label>
                    <input type="number" name="asignaturasDiferentes" id="asignaturasDiferentes" class="form-control" value = "<?= $row['asignaturasDiferentes']; ?>">
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-8">
                    <button class="btn btn-warning" name="btnGuardar" id="btnGuardar">Guardar</button>
                </div>
            </div>

        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/reporte_formulario.js"></script>
</body>
</html>
