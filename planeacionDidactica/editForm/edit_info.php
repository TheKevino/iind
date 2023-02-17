<?php
    include("../../includes/db.php");
    //base64_decode(
    $idInfo = base64_decode($_GET["idi"]);
    $idUsuario = base64_decode($_GET["id"]);
    $idPlaneacion = base64_decode($_GET["idp"]);

    $query = "SELECT actsEnsenanza, fechaInicial, fechaFinal, apOpUno, apOpDos FROM infotemas WHERE idInfo = $idInfo";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $actsEnsenanza = $row["actsEnsenanza"];
    $actsEnsenanza = str_replace("<br />", "", $actsEnsenanza);

    $fechaInicial = $row["fechaInicial"];
    $fechaFinal = $row["fechaFinal"];
    $apOpUno = $row["apOpUno"];
    $apOpDos = $row["apOpDos"];

    if(isset($_POST["btnAgregarInfo"])){

        $idInfo = base64_decode($_GET["idi"]);
        $idUsuario = base64_decode($_GET["id"]);
        $idPlaneacion = base64_decode($_GET["idp"]);

        $actsEnsenanza = nl2br(utf8_encode($_POST["actsEnsenanza"]));
        $fechaInicial = $_POST["fechaInicial"];
        $fechaFinal = $_POST["fechaFinal"];
        $opUno = $_POST["opUno"];
        $opDos = $_POST["opDos"];

        $query = "UPDATE infotemas SET actsEnsenanza = '$actsEnsenanza', fechaInicial = '$fechaInicial', fechaFinal = '$fechaFinal', 
            apOpUno = '$opUno', apOpDos = '$opDos' WHERE idInfo = $idInfo";

        $result = mysqli_query($conn, $query);

        header("Location: ../views/ver_planeacion.php?id=".base64_encode($idPlaneacion)."&idu=".base64_encode($idUsuario));

    }//fin if
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../residencias/img/favicon.ico" />
    <title>Editar Informacion</title>
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

    <form lang="es" class="formulario" action="edit_info.php?idi=<?=base64_encode($idInfo);?>&id=<?=base64_encode($idUsuario);?>&idp=<?=base64_encode($idPlaneacion);?>" method="POST">
        
          <h1>Editar informacion</h1>

          <textarea name="actsEnsenanza" id="actsEnsenanza" placeholder="Actividades de enseñanza"><?=utf8_decode($actsEnsenanza);?></textarea>
          <br>

            <label for="fechaInicial">Fecha Inicial</label>
            <div class="input-contenedor">
              <input type="date" name="fechaInicial" id="fechaInicial" placeholder="Fecha inicial" value="<?=$fechaInicial;?>"/>
            </div>

            <label for="fechaFinal">Fecha Final</label>
            <div class="input-contenedor">
              <input type="date" name="fechaFinal" id="fechaFinal" placeholder="Fecha final" value="<?=$fechaFinal;?>"/>
            </div>

            <label for="opUno">Porcentaje de aprobados en 1ra Op.</label>
            <div class="input-contenedor">
              <input type="text" name="opUno" id="opUno" placeholder="Ej: 78.23" value="<?=$apOpUno;?>"/>
            </div>

            <label for="opDos">Porcentaje de aprobados en 2da Op.</label>
            <div class="input-contenedor">
              <input type="text" name="opDos" id="opDos" placeholder="Ej: 28.01" value="<?=$apOpDos;?>"/>
            </div>

            <div class="contenedorbtn">
              <input type="submit" value="Editar" class="button" name="btnAgregarInfo" id="btnAgregarInfo">
            </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/info_tema.js"></script>
</body>
</html>
