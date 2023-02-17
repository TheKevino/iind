<?php

include("../includes/db.php");

if(!isset($_SESSION['user']) || $user->getTipo()!=1){
    header('Location: ../login.php');
}

$idUsuario = $user->getIdUsuario();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="img/favicon.ico">
    <title>Editar contraseña</title>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/index.css" />

    <!-- JQuery libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Extend Icon -->
    <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
    <script
      src="https://kit.fontawesome.com/8eed7147bf.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>

<!-- Navbar -->
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="redirection.php?op=0"><i class="fa fa-home"></i>  Usuario: <?php echo $user->getNombre(); ?></a>
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="redirection.php?op=3">Editar Firma</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="redirection.php?op=4">Cambiar Contraseña</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Cerrar sesion</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Formulario -->
    <form action="controller/update_password.php?id=<?php echo $idUsuario; ?>" method="post" class="formulario">
      <h1>Editar Contraseña</h1>
      <div class="imgposition">
        <img class="imgicon-form" src="../img/login/iconlogin.png" alt="">
      </div>
      <div class="contenedor">

      <div class="input-contenedor">
          <i class="fa fa-key icon"></i>
          <input type="password" name="oldPass" placeholder="Contraseña actual" />
        </div>

        <div class="input-contenedor">
          <i class="fa fa-lock icon"></i>
          <input type="password" name="newPass" placeholder="Contraseña nueva" />
        </div>

        <div class="input-contenedor">
          <i class="fa fa-lock icon"></i>
          <input type="password" name="confirmNewPass" placeholder="Confirmar contraseña nueva" />
        </div>

        <input type="submit" value="Editar" name="update_password" class="button">
      </div>
    </form>
  </body>
</html>