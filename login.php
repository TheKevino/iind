<?php
if (isset($_SESSION['user'])) {
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
  <link rel="stylesheet" href="residencias/css/jquery-ui.css">
  <script src="residencias/js/jquery-ui.js"></script>
  <script src="residencias/js/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="css/login.css">
  <link href="assets/css/fontawesome.css" rel="stylesheet">
  <link href="assets/css/brands.css" rel="stylesheet">
  <link href="assets/css/solid.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
    crossorigin="anonymous"></script>
</head>

<body>

  <div class="main">

    <div class="info-container">

      <div class="banner">

        <div class="tec-logo">
          <div class="images">
            <img src="assets/Images/venado.png">
            <img src="residencias/img/login/tec.png">
          </div>
          <div class="text-tec">
            <p>Departamento de Ingeniería Industrial.</p>
            <p>Gestión de calidad.</p>
            <p>Proceso acádemico.</p>
          </div>
        </div>

      </div>

      <div class="info-body">
        <!-- INICIO CARRUSEL -->
        <div class="slider position"></div>
        <!-- FIN CARRUSEL -->
      </div>

    </div>

    <div class="img-cabecera">
      <img src="residencias/img/login/tec.png">
    </div>

    <form action="redirection.php" method="post" class="login-container">
      <div class="contenedor">
        <div class="cabecera">
          <p class="text-login">Inicio de sesión</p>
          <p class="text-secundario">¿No tienes cuenta?</p>
          <p class="text-secundario">Pidela al jefe de departamento.</p>
        </div>

        <div class="cuerpo">
          <div class="block-div">
            <div class="input-wrapper">
              <input type="text" name="usuario" id="usuario" placeholder="Usuario" />
              <i class="fa-regular fa-user input-icon" id="usericon"></i>
            </div>
          </div>
          <div class="block-div">
            <div class="input-wrapper password">
              <input type="password" name="pass" id="pass" placeholder="Contraseña" />
              <i class="fa-regular fa-lock input-icon" id="lockicon"></i>
            </div>
          </div>
        </div>

        <div class="boton">
          <input type="submit" value="Acceder" name="login" class="button">
        </div>

      </div>

    </form>

  </div>
  <!-- Footer -->
  <footer>

    <section>
      <div class="container text-center text-md-start p-5">
        <div class="row">
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">ARQUITECTOS DE SOFTWARE
            </h6>
            <p class="order">Manuel Francisco Correa Martinez</p>
            <p class="order">Guillermo Martinez Fuentes</p>
            <p class="order">Jayleene Alondra Martinez Moreno</p>
            <p class="order">Kevin Jose Partida Espinoza</p>
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
    <div class="text-center p-4" style="background-color:#1d1b31; color: white;">
      © 2024 Copyright: Depto. Ing. Industrial
    </div>
    <!-- Copyright -->
  </footer>

  <script src="js/login.js"></script>
</body>

</html>