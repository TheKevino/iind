<?php
include('../../includes/db.php');
include('../../includes/user.php');
include('../../includes/user_session.php');


$userSession = new UserSession();
$user = new User();
$user->setUser($userSession->getCurrentUser());

$id = $_GET['id'];

if( isset($_GET['id']) ){
  $id = $_GET['id'];
  $query = "SELECT * FROM usuarios WHERE idUsuario = $id";
  $result = mysqli_query($conn, $query);
  
  if( mysqli_num_rows($result) == 1 ){
      $row = mysqli_fetch_array($result);
      $paterno = $row['paterno'];
      $materno = $row['materno'];
      $nombres = $row['nombres'];
      $correo = $row['correo'];
  }
}

if( isset($_POST['update_usuario']) ){
  $id = $_GET['id'];
  $paterno = $_POST['paterno'];
  $materno = $_POST['materno'];
  $nombres = $_POST['nombres'];
  $email = $_POST['email'];
  $usuario = $paterno.".".$nombres;

  $query = "UPDATE usuarios set paterno = '$paterno', materno = '$materno', nombres='$nombres', correo = '$email' WHERE idUsuario = $id ";
  mysqli_query($conn, $query);

  header("Location: ../../redirection.php?op=2");

}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="img/favicon.ico">
    <title>Editar Usuario</title>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="../css/index.css" />

    <!-- JQuery libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Extend Icon -->
    <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
    <script
      src="https://kit.fontawesome.com/8eed7147bf.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="../css/login.css">
  </head>
  <body>

<!-- Navbar -->
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="../../redirection.php?op=index"><i class="fa fa-home"></i>  Usuario: <?php echo $user->getNombre(); ?></a>
      <ul class="nav justify-content-end">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../../redirection.php?op=1">Agregar Usuario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../redirection.php?op=2">Consultar Usuario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../logout.php">Cerrar sesion</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Formulario -->
    <form action="editar_usuario.php?id=<?php echo $_GET['id']; ?>" method="post" class="formulario">
      <h1>Editar usuario</h1>
      <div class="imgposition">
        <img class="imgicon-form" src="../img/login/iconlogin.png" alt="">
      </div>
      <div class="contenedor">
        <div class="input-contenedor">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" name="paterno" placeholder="Apellido paterno" value="<?php echo $paterno; ?>" />
        </div>

        <div class="input-contenedor">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" name="materno" placeholder="Apellido materno (opcional)" value="<?php if($materno!=null || $materno !="") {echo $materno;} ?>"/>
        </div>

        <div class="input-contenedor">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" name="nombres" placeholder="Nombre(s)" value="<?php echo $nombres; ?>"/>
        </div>

        <div class="input-contenedor">
          <input type="email" class="form-control" name="email" placeholder="Correo Electronico" value="<?php echo $correo; ?>"/>
        </div>

        <input type="submit" value="Editar" name="update_usuario" class="button">
      </div>
    </form>
  </body>
</html>