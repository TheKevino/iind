<?php

if(!isset($_SESSION['user'])){
    header('Location: login.php');
}

include('includes/db.php');

//Query para los encargados
$jefeDivEstudiosProf;
$jefeDeptoIngIndustrial;

$query = "SELECT * FROM encargados";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_array($result);
$jefeDivEstudiosProf = $row['jefeDivisionEstudiosProf'];
$jefeDeptoIngIndustrial = $row['jefeDeptoIngInd'];

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar encargados</title>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
      <link
      href="css/paleta.css" rel="stylesheet"/>
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

    form{
        width:100vw;
    }

</style>

<!-- Navbar -->
<?php include('navigator.php'); ?>


    <form class="contenedor" action="encargados/editar_encargados.php" method="POST">
    
        <div class="card card-body col-md-8 mt-4">

            <!-- Campos -->
            <div class="row col-md-12">
                <div class="col-md-6 mt-2">
                    <label for="estudiosPro">Jefe de division de estudios profesionales:</label>
                    <input type="text" class="form-control mt-1" placeholder="Jefe de division de estudios profesionales" 
                        name="estudiosPro" id="estudiosPro" value="<?= $jefeDivEstudiosProf ?>">
                </div>

                <div class="col-md-6 mt-2">
                    <label for="estudiosPro">Jefe del depto. de Ing. Industrial:</label>
                    <input type="text" class="form-control mt-1" placeholder="Jefe del depto de ingenieria industrial" 
                    name="jefeIndustrial" id="jefeIndustrial" value="<?= $jefeDeptoIngIndustrial ?>">
                </div>
            </div>

        </div>

        <!-- Boton -->
        <div class="row mt-2">
            <div class="col-md-8">
                <input type="submit" class="btn btn-secundario" name="btnEditarEncargados" id="btnEditarEncargados" value="Editar">
            </div>
        </div>

    </form>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>