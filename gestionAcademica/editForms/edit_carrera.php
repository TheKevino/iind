<?php

include("../../includes/db.php");

$id = $_GET['id'];

$query = "SELECT * FROM carreras where idCarrera=$id";

$result = mysqli_query($conn, $query);

if (!$result) {
  die("Query failed");
}

$row = mysqli_fetch_array($result);

if (isset($_POST['btnAgregarCarrera'])) {
  $id = $_GET['id'];
  $nombreCarrera = $_POST['carrera'];

  $query = "UPDATE carreras SET nombre = '$nombreCarrera' WHERE idCarrera=$id";
  $result = mysqli_query($conn, $query);
  header("Location: edit_carrera.php?id=" . $id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../residencias/img/favicon.ico" />
  <title>Editar Carrera</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/Styleform.css">

  <!-- Extend Icon -->
  <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- Validaciones -->
  <script src="../../js/validaciones.js"></script>

</head>

<body>

  <style>
    .contenedor {
      height: auto;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      margin-bottom: 2rem;
    }

    .btn {
      background-color: #1d1b31;
      color: white !important;
    }

    .btn:hover {
      background-color: #333145;
    }

    .centrar {
      align-items: center;
      margin: 0 auto;
    }
  </style>

  <script>
    function validarFormulario() {
      var formulario = document.getElementById("formulario");
      var carrera = formulario.carrera.value;

      if (carrera === "") {
        Swal.fire({
          title: 'Error!',
          text: 'Faltan campos por llenar.',
          icon: 'error',
          confirmButtonText: 'Ok'
        })
        return false;
      }

      return true;
    }
  </script>

  <form class="formulario" id="formulario" action="edit_carrera.php?id=<?= $id; ?> " method="POST"
    onsubmit="return validarFormulario()">
    <div class="card card-body">
      <h1>Carreras</h1>

      <div class="contenedor">
        <div class="mt-2">
          <input class="form-control" type="text" placeholder="Nombre de la carrera" name="carrera" id="carrera"
            oninput="validarSoloLetras(this.id)" value="<?php echo $row['nombre']; ?>" />
        </div>
      </div>

      <div class="contenedorbtn">
        <input type="submit" value="Editar" class="button btn" name="btnAgregarCarrera" id="btnAgregarCarrera">
      </div>
    </div>
    </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="../js/carreras.js"></script>
</body>

</html>