<?php
$idMateria = $_GET['id'];
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
    <title>Agregar Tema</title>
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
   
    <form class="formulario" action="../controller/agregarTema.php?id=<?=$idMateria;?>" method="POST">

        <h1>Nuevo Tema</h1>
        
        <div class="input-contenedor">
            <input type="number" name="noTema" id="noTema" placeholder="Numero del tema" />
        </div>

        <div class="input-contenedor">
            <input type="text" name="nombreTema" id="nombreTema" placeholder="Nombre del tema" />
        </div>
  
        <textarea name="temasSubtemas" id="temasSubtemas" placeholder="Temas y subtemas para desarrollar la competencia especifica"></textarea>

        <textarea name="actsAprendizaje" id="actsAprendizaje" placeholder="Actividades de aprendizaje"></textarea>

        <textarea name="desCompGenericas" id="desCompGenericas" placeholder="Desarrollo de competencias genericas"></textarea>

        <div class="contenedorbtn">
            <input type="submit" value="Agregar" class="button" name="btnAgregarTema" id="btnAgregarTema">
        </div>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/agregar_tema.js"></script>
</body>
</html>