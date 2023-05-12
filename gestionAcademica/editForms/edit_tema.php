<?php
    include("../../includes/db.php");
    $idTema = $_GET['id'];
    $idMateria = $_GET['idm'];

    $query = "SELECT noTema, nombre, temasSubtemas, actsAprendizaje, desCompGenericas FROM temas 
    WHERE idTema = $idTema AND idMateria = $idMateria";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    $noTema = $row['noTema'];
    $nombreTema = $row['nombre'];

    $temasSubtemas = $row['temasSubtemas'];
    $temasSubtemas = str_replace("<br />", "", $temasSubtemas);

    $actsAprendizaje = $row['actsAprendizaje'];
    $actsAprendizaje = str_replace("<br />", "", $actsAprendizaje);

    $desCompGenericas = $row['desCompGenericas'];
    $desCompGenericas = str_replace("<br />", "", $desCompGenericas);


    if(isset($_POST['btnAgregarTema'])){

        $idTema = $_GET['id'];
        $idMateria = $_GET['idm'];

        $noTema = $_POST['noTema'];
        $nombreTema = utf8_encode($_POST['nombreTema']);
        $temasSubtemas = nl2br(utf8_encode($_POST['temasSubtemas']));
        $actsAprendizaje = nl2br(utf8_encode($_POST['actsAprendizaje']));
        $desCompGenericas = nl2br(utf8_encode($_POST['desCompGenericas']));

        $query = "UPDATE temas SET noTema = $noTema, nombre = '$nombreTema', temasSubtemas = '$temasSubtemas', 
            actsAprendizaje = '$actsAprendizaje', desCompGenericas = '$desCompGenericas'
            WHERE idTema = $idTema AND idMateria = $idMateria";

        $result = mysqli_query($conn, $query);

        header("Location: edit_tema.php?id=$idTema&idm=$idMateria");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../residencias/img/favicon.ico" />
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Editar Tema</title>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="../css/Styleform.css">
    
        <!-- Extend Icon -->
        <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
  
</head>
<body>
   
    <form class="formulario" action="edit_tema.php?id=<?= $idTema; ?>&idm=<?= $idMateria; ?>" method="POST">

        <h1>Editar Tema</h1>
        
        <div class="input-contenedor">
            <input type="number" name="noTema" id="noTema" placeholder="Numero del tema" value=<?= utf8_decode($noTema); ?> />
        </div>

        <div class="input-contenedor">
            <input type="text" name="nombreTema" id="nombreTema" placeholder="Nombre del tema" value="<?= utf8_decode($row['nombre']); ?>" />
        </div>
  
        <textarea name="temasSubtemas" id="temasSubtemas" placeholder="Temas y subtemas para desarrollar la competencia especifica"><?= utf8_decode($temasSubtemas); ?> </textarea>

        <textarea name="actsAprendizaje" id="actsAprendizaje" placeholder="Actividades de aprendizaje"><?= utf8_decode($actsAprendizaje); ?> </textarea>

        <textarea name="desCompGenericas" id="desCompGenericas" placeholder="Desarrollo de competencias genericas"><?= utf8_decode($desCompGenericas); ?> </textarea>

        <div class="contenedorbtn">
            <input type="submit" value="Editar" class="button" name="btnAgregarTema" id="btnAgregarTema">
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/agregar_tema.js"></script>
</body>
</html>