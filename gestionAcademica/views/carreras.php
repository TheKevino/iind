<?php

  if(!isset($_SESSION['user'])){
    header('Location: login.php');
  }

  include_once('includes/user.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="residencias/img/favicon.ico" />
    <title>Agregar Carrera</title>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="gestionAcademica/css/Styleform.css">
    
        <!-- Extend Icon -->
        <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
  
</head>
<body>

  <?php include('navigator.php'); ?>
   
    <form class="formulario" action="gestionAcademica/controller/agregarCarrera.php" method="POST">
        <h1>Carreras</h1>
  
          <div class="input-contenedor">
            <i class="fa-solid fa-key icon"></i>
            <input type="text" placeholder="Nombre de la carrera" name="carrera" id="carrera" />
          </div>

          <div class="contenedorbtn">
            <input type="submit" value="Agregar" class="button" name="btnAgregarCarrera" id="btnAgregarCarrera">
          </div>  
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="gestionAcademica/js/carreras.js"></script>
</body>
</html>