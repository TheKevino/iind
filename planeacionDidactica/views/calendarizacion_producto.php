<?php
    include("../../includes/db.php");
    $idPlaneacion = base64_decode($_GET["id"]);
    $idUsuario = base64_decode($_GET['idu']);
    $noSemanas = base64_decode($_GET['n']);

    if(isset($_POST['btnAgregarInfo'])){

        $idPlaneacion = base64_decode($_GET["id"]);
        $idUsuario = base64_decode($_GET['idu']);
        $noSemanas = base64_decode($_GET['n']);

        $semana = $_POST["semana"];
        $producto = $_POST["producto"];
        $tipo = $_POST["tipo"];

        $query = "INSERT INTO calendarizaciones(idPlaneacion, idUsuario, semana, tipo, producto)
            VALUES('$idPlaneacion', '$idUsuario', '$semana', '$tipo', '$producto')";

        $result = mysqli_query($conn, $query);

        header("Location: calendarizacion_producto.php?id=".base64_encode($idPlaneacion)."&idu=".base64_encode($idUsuario)."&n=".base64_encode($noSemanas));

    }//fin if

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../residencias/img/favicon.ico" />
    <title>Calendarizacion</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="../../gestionAcademica/css/Styleform.css">

    <!-- Extend Icon -->
    <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
</head>
<body>

    <form class="formulario" action="calendarizacion_producto.php?id=<?=base64_encode($idPlaneacion);?>&idu=<?=base64_encode($idUsuario);?>&n=<?=base64_encode($noSemanas);?>" method="POST">
        
        <h1>Calendarizacion</h1>

        <label for="semana">No. Semana:</label>
        <div class="input-contenedor">
            <select name="semana" id="semana">
                <?php
                    for($i=1 ; $i<=$noSemanas ; $i++){
                ?> 

                <option value="<?=$i?>"><?=$i?></option>
                
                <?php
                    }
                ?>
            </select>
        </div>

        <label for="tipo">Tipo:</label>
        <div class="input-contenedor">
            <select name="tipo" id="tipo">
                <option value="TP">Tiempo Planeado (TP)</option>
                <option value="TR">Tiempo Real (TR)</option>
                <option value="SD">Seguimiento Departamental (SD)</option>
            </select>
        </div>

        <div class="input-contenedor">
            <input type="text" name="producto" id="producto" placeholder="Producto. Ej: EF1"/>
        </div>

        <div class="contenedorbtn">
          <input type="submit" value="Agregar" class="button" name="btnAgregarInfo" id="btnAgregarInfo">
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
