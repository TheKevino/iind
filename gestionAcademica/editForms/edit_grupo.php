<?php

include("../../includes/db.php");

if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $query = "SELECT idCarrera, nombre FROM carreras";
  $query2 = "SELECT idCarrera, clave, nombre FROM grupos WHERE idGrupo = $id";

  $result = mysqli_query($conn, $query);

  if (!$result) {
    die("Query failed");
  }

  $result2 = mysqli_query($conn, $query2);

  if (!$result) {
    die("Query failed");
  }

  $row2 = mysqli_fetch_array($result2);

}

if (isset($_POST['btnAgregarGrupo'])) {
  $id = $_GET['idG'];
  $carrera = $_POST['selectCarrera'];
  $clave = $_POST['clave'];
  $nombre = $_POST['nombre'];

  $query = "UPDATE grupos SET idCarrera = '$carrera', clave = '$clave', nombre = '$nombre' WHERE idGrupo=$id ";
  $result = mysqli_query($conn, $query);
  header("Location: edit_grupo.php?id=" . $id);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../residencias/img/favicon.ico" />
  <title>Editar Grupo</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/Styleform.css">

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- Validaciones -->
  <script src="../../js/validaciones.js"></script>

  <!-- Extend Icon -->
  <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>

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
      var carrera = formulario.selectCarrera.value;
      var clave = formulario.clave.value;
      var nombre = formulario.nombre.value;

      if (carrera === "" || clave === "" || nombre === "") {
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

  <form class="formulario" id="formulario" action="edit_grupo.php?idG=<?= $id; ?>" method="POST"
    onsubmit="return validarFormulario()">
    <div class="card card-body">
      <h1>Grupo</h1>
      <div class="contenedor">
        <label for="selectCarrera">Carrera:</label>
        <select class="form-select" name="selectCarrera" id="selectCarrera">
          <!-- PARTE PARA LLENAR EL SELECT DEL FORMULARIO CON LAS CARRERAS -->
          <?php while ($row = mysqli_fetch_array($result)) { ?>

            <option <?php if ($row2['idCarrera'] == $row['idCarrera']) {
              echo "selected";
            } ?> value=<?= $row['idCarrera']; ?>>
              <?= $row['nombre']; ?></option>

          <?php } ?>

        </select>
      </div>
      <div class="contenedor">
        <label for="clave">Clave del grupo:</label>
        <input class="form-control" type="text" placeholder="Clave del grupo" name="clave" id="clave"
          value="<?= $row2['clave'] ?>" />
      </div>
      <div class="contenedor">
        <label for="nombre">Nombre del grupo:</label>
        <input class="form-control" type="text" placeholder="Nombre del grupo" name="nombre" id="nombre"
          value="<?= $row2['nombre'] ?>" />
      </div>
      <div class="contenedor">
        <input type="submit" value="Editar" class="button btn" name="btnAgregarGrupo" id="btnAgregarGrupo">
      </div>
    </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="../js/grupos.js"></script>
</body>

</html>