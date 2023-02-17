<?php 
  if(isset($_SESSION['user'])){
    header('Location: redirection.php?op=0');
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="residencias/img/favicon.ico">
    <title>Login</title>
    <link rel="stylesheet" href="residencias/css/login.css">
    <script
    src="https://kit.fontawesome.com/8eed7147bf.js"
    crossorigin="anonymous"
  ></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
  
  <div class="banner">
    <img class="TECNM" src="residencias/img/login/banner-img-login.jpg" alt="banner">
    <img class="Sep" src="residencias/img/login/SEP.jpg" alt="banner">
  </div>

<div style=" margin-bottom:80px;">
    <h2 style ="text-align:center;">Departamento de Ingeniería Industrial</h2>
    <h3 style ="text-align:center;">Gestión de Calidad</h3>
    <h3 style ="text-align:center;">Proceso Acádemico</h3>
</div>
     
    <form action="redirection.php" method="post" class="formulario" style="margin-top: 200px;">
        <h1>Iniciar sesión</h1>
        <div class="imgposition">
          <img class="imgicon-form" src="/img/login/iconlogin.png" alt="">
        </div>
        <div class="input-contenedor">
          <i class="fa-solid fa-message icon"></i>
          <input type="text" name="usuario" placeholder="Usuario" />
        </div>
  
        <div class="input-contenedor">
          <i class="fa-solid fa-key icon"></i>
          <input type="password" name="pass" placeholder="Contraseña" />
        </div>
        <input type="submit" value="Login" name="login" class="button">
    </form>

     <!-- Footer -->
<footer class="text-center text-lg-start bg-white text-muted" >
  
  <section class="" style="background-color:#14406bf2; color: white; padding-top: 1px;" >
    <div class="container text-center text-md-start mt-5" >
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">ARQUITECTOS DE SOFTWARE
          </h6>
          <p class="order">Jose Armando Carrillo Valenzuela</p>
          <p class="order">Kevin Jose Partida Espinoza</p>
          <p class="order">Keny Alexander Miranda Villegas</p>
        </div>

        <div class="col-md-3 text-center mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4 order">
           JEFES DE PROYECTO        
         </h6>
        <p class="order">Oscar Vidal Arellano Tanori</p>
        <p class="order">Karla Maria Apodaca Ibarra</p>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p class="order">industrial@hermosillo.tecnm.mx</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color:#143f6b; color: white;">
    © 2022 Copyright: DeptoIndustrial
  </div>
  <!-- Copyright -->
</footer>
</body>
</html>