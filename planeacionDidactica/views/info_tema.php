<?php
    include("../../includes/db.php");

    $idUsuario = base64_decode($_GET["id"]);
    $idTema = base64_decode($_GET["idt"]);
    $idPlaneacion = base64_decode($_GET["idp"]);

    if(isset($_POST["btnAgregarInfo"])){

        $idUsuario = base64_decode($_GET["id"]);
        $idTema = base64_decode($_GET["idt"]);
        $idPlaneacion = base64_decode($_GET["idp"]);

        $actsEnsenanza = nl2br(utf8_encode($_POST["actsEnsenanza"]));
        $fechaInicial = $_POST["fechaInicial"];
        $fechaFinal = $_POST["fechaFinal"];
        $opUno = $_POST["opUno"];
        $opDos = $_POST["opDos"];

        $query = "INSERT INTO infotemas(idPlaneacion, idTema, idUsuario, actsEnsenanza, fechaInicial, fechaFinal, apOpUno, apOpDos) 
            VALUES ($idPlaneacion, $idTema, $idUsuario, '$actsEnsenanza', '$fechaInicial', '$fechaFinal', '$opUno', '$opDos')";

        $result = mysqli_query($conn, $query);

        header("Location: ver_planeacion.php?id=".base64_encode($idPlaneacion)."&idu=".base64_encode($idUsuario));

    }//fin if
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../residencias/img/favicon.ico" />
    <title>Agregar Informacion</title>
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

    <form class="formulario" action="info_tema.php?id=<?= base64_encode($idUsuario);?>&idt=<?= base64_encode($idTema);?>&idp=<?= base64_encode($idPlaneacion);?>" method="POST">
        
          <h1>Agregar informacion</h1>

          <textarea name="actsEnsenanza" id="actsEnsenanza" placeholder="Actividades de enseñanza"></textarea>
          <br>

          <label for="fechaInicial">Fecha Inicial:</label>
            <div class="input-contenedor">
              <input type="date" name="fechaInicial" id="fechaInicial" placeholder="Fecha inicial" />
            </div>
            
            <label for="fechaInicial">Fecha Final:</label>
            <div class="input-contenedor">
              <input type="date" name="fechaFinal" id="fechaFinal" placeholder="Fecha Final" />
            </div>

            <label for="opUno">Porcentaje de aprobados en 1ra Op.</label>
            <div class="input-contenedor">
              <input type="text" name="opUno" id="opUno" placeholder="Ej: 78.23" />
            </div>

            <label for="opDos">Porcentaje de aprobados en 2da Op.</label>
            <div class="input-contenedor">
              <input type="text" name="opDos" id="opDos" placeholder="Ej: 28.01" />
            </div>

            <div class="contenedorbtn">
              <input type="submit" value="Agregar" class="button" name="btnAgregarInfo" id="btnAgregarInfo">
            </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
 
</body>
</html>
