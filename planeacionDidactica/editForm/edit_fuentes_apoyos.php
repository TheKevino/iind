<?php
    include("../../includes/db.php");
    $idPlaneacion = base64_decode($_GET["id"]);
    $idUsuario = base64_decode($_GET['idu']);

    $query = "SELECT fuentes, apoyosDidacticos FROM planeacionDidactica WHERE idPlaneacion = $idPlaneacion";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $fuentes = $row["fuentes"];
    $fuentes = str_replace("<br />", "", $fuentes);

    $apoyosDidacticos = $row["apoyosDidacticos"];
    $apoyosDidacticos = str_replace("<br />", "", $apoyosDidacticos);

    if(isset($_POST["btnAgregarInfo"])){

        $idPlaneacion = base64_decode($_GET["id"]);
        $idUsuario = base64_decode($_GET["idu"]);

        $fuentes = nl2br(utf8_encode($_POST["fuentes"]));
        $apoyosDidacticos = nl2br(utf8_encode($_POST["apDidacticos"]));

        $query = "UPDATE planeacionDidactica SET fuentes = '$fuentes', apoyosDidacticos = '$apoyosDidacticos' 
            WHERE idPlaneacion = $idPlaneacion";

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
    <title>Editar Fuentes</title>
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

    <form lang="es" class="formulario" action="edit_fuentes_apoyos.php?id=<?=base64_encode($idPlaneacion);?>&idu=<?=base64_encode($idUsuario);?>" method="POST">
        
        <h1>Editar fuentes y apoyos.</h1>

        <textarea name="fuentes" id="fuentes" placeholder="Fuentes de informacion."><?=utf8_decode($fuentes);?></textarea>

        <textarea name="apDidacticos" id="apDidacticos" placeholder="Apoyos didacticos"><?=utf8_decode($apoyosDidacticos);?></textarea>

        <div class="contenedorbtn">
          <input type="submit" value="Editar" class="button" name="btnAgregarInfo" id="btnAgregarInfo">
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
