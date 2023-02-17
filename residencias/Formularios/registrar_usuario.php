<?php 
  if(!isset($_SESSION['user']) || $user->getTipo()!=2){
    header('Location: ../../login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="residencias/img/favicon.ico">
    <title>Registrate</title>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="residencias/css/index.css" />

    <!-- JQuery libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Extend Icon -->
    <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
    <script
      src="https://kit.fontawesome.com/8eed7147bf.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="residencias/css/login.css">
  </head>
  <body>

  <?php include('navigator.php') ?>

  <!--
  <div class="banner">
    <img class="TECNM" src="img/login/banner-img-login.jpg" alt="banner">
    <img class="Sep" src="img/login/SEP.jpg" alt="banner">
  </div>
-->

    <form action="residencias/controller/alta_usuario.php" method="post" class="formulario">
      <h1>Registrar usuario</h1>
      <div class="imgposition">
        <img class="imgicon-form" src="img/login/iconlogin.png" alt="">
      </div>
      <div class="contenedor">
        <div class="input-contenedor">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" name="paterno" placeholder="Apellido paterno" />
        </div>

        <div class="input-contenedor">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" name="materno" placeholder="Apellido materno (opcional)" />
        </div>

        <div class="input-contenedor">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" name="nombres" placeholder="Nombre(s)" />
        </div>

        <div class="input-contenedor">
          <input type="email" class="form-control" name="email" placeholder="Correo Electronico" />
        </div>

        <input type="submit" value="Registrar" name="alta_usuario" class="button">
      </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>
