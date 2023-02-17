<?php
include_once('../../includes/db.php');
include_once('../../includes/user.php');
include_once('../../includes/user_session.php');
$userSession = new UserSession();
$user = new User();
$user->setUser($userSession->getCurrentUser());

$idUsuario = $user->getIdUsuario();

if( isset($_GET['id']) ){
    $id = $_GET['id'];
    $query = "SELECT paternoAlumno, maternoAlumno, nombresAlumno, noControl, nombreProyecto, producto FROM formularios WHERE idFormulario = $id";
    $result = mysqli_query($conn, $query);
    
    if( mysqli_num_rows($result) == 1 ){
        $row = mysqli_fetch_array($result);
        $paterno = $row['paternoAlumno'];
        $materno = $row['maternoAlumno'];
        $nombres = $row['nombresAlumno'];
        $noControl = $row['noControl'];
        $nombreProyecto = $row['nombreProyecto'];
        $producto = $row['producto'];
    }
}



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="img/favicon.ico">
    <title>Crear Formulario</title>
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Extend Icon -->
    <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
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
    <form class="contenedor mt-4" action="../controller/update_formulario.php?id=<?= $id ?>" method="post">

        <div class="row">
            <div class="col-md-8">
                <button class="btn btn-warning" onclick="editar()" id="btnEditar">Guardar</button>
            </div>
        </div>
 
        <div class="card card-body col-md-8 mt-4" id="containerForm">

            <h2>Informacion del alumno y producto</h2>

            <div class="row col-md-12">
                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" placeholder="Apellido paterno" name="paterno" id="paterno" value="<?php echo $paterno ?>">
                </div>
                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" placeholder="Apellido materno" name="materno" id="materno" value="<?php echo $materno ?>">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" placeholder="Nombre(s)" name="nombres" id="nombres" value="<?php echo $nombres ?>">
                </div>
                <div class="col-md-6 mt-2">
                    <input type="number" class="form-control" placeholder="Numero de control" name="nc" id="nc" value="<?php echo $noControl ?>">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2">
                    <input type="text" readonly class="form-control-plaintext" value="Carrera: Ingenieria Industrial">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-12 mt-2">
                    <input type="text" class="form-control" placeholder="Nombre del proyecto" name="nombreProyecto" id="nombreProyecto" value="<?php echo $nombreProyecto ?>">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-12 mt-2">
                    <label for="comboProductoo">Producto</label>
                    <select class="form-select" name="comboProductoo" id="comboProductoo" >
                        <option <?php if($producto=="PROYECTO") echo "selected" ?> value="PROYECTO">PROYECTO</option>
                        <option <?php if($producto=="INFORME TECNICO DE RESIDENCIA PROFESIONAL") echo "selected" ?> value="INFORME TECNICO DE RESIDENCIA PROFESIONAL">INFORME TECNICO DE RESIDENCIA PROFESIONAL</option>
                        <option <?php if($producto=="TESIS") echo "selected" ?> value="TESIS">TESIS</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
            </div>

            <div class="row col-md-12 mt-1" id="especifique" style="display:none">
                <div class="col-md-12 mt-2">
                    <input type="text" class="form-control" placeholder="Especifique" name="esp" id="esp" value="<?php if(isset($otroProducto)) echo $otroProducto; ?>">
                </div>
            </div>

        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="../js/editar_formulario.js"></script>  
</body>
</html>