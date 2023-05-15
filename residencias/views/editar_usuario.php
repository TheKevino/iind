<?php
include('../../includes/db.php');
include('../../includes/user.php');
include('../../includes/user_session.php');


$userSession = new UserSession();
$user = new User();
$user->setUser($userSession->getCurrentUser());

$id = $_GET['id'];

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "SELECT * FROM usuarios WHERE idUsuario = $id";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $paterno = $row['paterno'];
    $materno = $row['materno'];
    $nombres = $row['nombres'];
    $correo = $row['correo'];
  }
}

if (isset($_POST['update_usuario'])) {
  $id = $_GET['id'];
  $paterno = $_POST['paterno'];
  $materno = $_POST['materno'];
  $nombres = $_POST['nombres'];
  $email = $_POST['email'];
  $usuario = $paterno . "." . $nombres;

  $query = "UPDATE usuarios set paterno = '$paterno', materno = '$materno', nombres='$nombres', correo = '$email' WHERE idUsuario = $id ";
  mysqli_query($conn, $query);

  header("Location: editar_usuario.php?id=" . $id);

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../img/favicon.ico">
  <title>Editar Usuario</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/index.css" />

  <!-- JQuery libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../../js/validaciones.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- Extend Icon -->
  <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>

  <style>
    .contenedor {
      height: auto;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .btn {
      background-color: #1d1b31;
      color: white !important;
    }

    .centrar {
      align-items: center;
      margin: 0 auto;
    }
  </style>

  <script>
    function validarCamposString() {
      // Obtener los campos del formulario
      var apellidoP = document.getElementById("paterno");
      var apellidoM = document.getElementById("materno");
      var nombre = document.getElementById("nombres");
      var email = document.getElementById("email");

      // Verificar si hay campos vacíos
      if (apellidoP.value == "" || apellidoM.value == "" || nombre.value == "" || email.value == "") {
        Swal.fire({
          title: 'Error!',
          text: 'Faltan campos por llenar',
          icon: 'error',
          confirmButtonText: 'Ok'
        })
        return false; // Detener el envío del formulario
      }

      // Si no hay campos vacíos, permitir el envío del formulario
      return true;
    }
  </script>


  <!-- Formulario -->
  <form action="editar_usuario.php?id=<?php echo $_GET['id']; ?>" method="post" class="contenedor"
    onsubmit="return validarCamposString()">
    <div class="card card-body col-md-8 mt-4">
      <h1>Editar usuario</h1>
      <div class="contenedor">
        <div class="col-md-6 mt-2">
          <label for="paterno">Apellido paterno:</label>
          <input id="paterno" class="form-control" type="text" name="paterno" placeholder="Apellido paterno"
            oninput="validarSoloLetras(this.name)" value="<?php echo $paterno; ?>" />
        </div>

        <div class="col-md-6 mt-2">
          <label for="materno">Apellido materno:</label>
          <input id="materno" class="form-control" type="text" name="materno" oninput="validarSoloLetras(this.name)"
            placeholder="Apellido materno (opcional)" value="<?php if ($materno != null || $materno != "") {
              echo $materno;
            } ?>" />
        </div>

        <div class="col-md-6 mt-2">
          <label for="nombres">Nombres:</label>
          <input id="nombres" type="text" class="form-control" name="nombres" placeholder="Nombre(s)"
            oninput="validarSoloLetras(this.name)" value="<?php echo $nombres; ?>" />
        </div>
        <div class="col-md-6 mt-2">
          <label for="correo">Correo electronico:</label>
          <input id="email" type="email" class="form-control" name="email" placeholder="Correo Electronico"
            value="<?php echo $correo; ?>" />
        </div>
        <div class="row mt-4 centrar">
          <input type="submit" value="Editar" name="update_usuario" class="button btn">
        </div>
      </div>
    </div>
  </form>
</body>

</html>