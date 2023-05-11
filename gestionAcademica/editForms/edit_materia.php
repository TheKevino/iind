<?php

include("../../includes/db.php");

if (isset($_GET['id'])) {

  $id = $_GET['id'];

  $query = "SELECT idCarrera, nombre FROM carreras";
  $query2 = "SELECT idMateria, idCarrera, clave, nombre, satca, caracterizacion, intencionDidactica,
    competenciasPrevias, competenciasGenericas, competenciasEspecificas, fuentes, apoyosDidacticos FROM materias WHERE idMateria = $id";

  $result = mysqli_query($conn, $query);
  $result2 = mysqli_query($conn, $query2);
  $row2 = mysqli_fetch_array($result2);

  $caracterizacion = $row2['caracterizacion'];
  $caracterizacion = str_replace("<br />", "", $caracterizacion);

  $intencionDidactica = $row2['intencionDidactica'];
  $intencionDidactica = str_replace("<br />", "", $intencionDidactica);

  $competenciasPrevias = $row2['competenciasPrevias'];
  $competenciasPrevias = str_replace("<br />", "", $competenciasPrevias);

  $competenciasGenericas = $row2['competenciasGenericas'];
  $competenciasGenericas = str_replace("<br />", "", $competenciasGenericas);

  $competenciasEspecificas = $row2['competenciasEspecificas'];
  $competenciasEspecificas = str_replace("<br />", "", $competenciasEspecificas);

  $fuentes = $row2['fuentes'];
  $fuentes = str_replace("<br />", "", $fuentes);

  $apoyosDidacticos = $row2['apoyosDidacticos'];
  $apoyosDidacticos = str_replace("<br />", "", $apoyosDidacticos);

}

if (isset($_POST['btnAgregarMateria'])) {
  $id = $_GET['idM'];
  $carrera = $_POST['selectCarrera'];
  $clave = $_POST['claveMateria'];
  $nombre = utf8_encode($_POST['nombreMateria']);
  $satca = $_POST['satca'];
  $caracterizacion = nl2br(utf8_encode($_POST['caracterizacion']));
  $intencionDidactica = nl2br(utf8_encode($_POST['intencion']));

  $competenciasPrevias = nl2br(utf8_encode($_POST['previas']));
  $competenciasGenericas = nl2br(utf8_encode($_POST['genericas']));
  $competenciasEspecificas = nl2br(utf8_encode($_POST['especificas']));

  $fuentes = nl2br(utf8_encode($_POST['fuentes']));
  $apoyosDidacticos = nl2br(utf8_encode($_POST['apDidacticos']));

  $query = "UPDATE materias SET idCarrera = '$carrera', clave = '$clave', nombre = '$nombre', satca = '$satca', caracterizacion = '$caracterizacion', 
    intencionDidactica = '$intencionDidactica', competenciasPrevias = '$competenciasPrevias', competenciasGenericas = '$competenciasGenericas', 
    competenciasEspecificas = '$competenciasEspecificas', fuentes = '$fuentes', apoyosDidacticos = '$apoyosDidacticos' WHERE idMateria=$id ";
  $result = mysqli_query($conn, $query);
  header("Location: edit_materia.php?id=" . $id);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../../residencias/img/favicon.ico" />
  <title>Editar Materia</title>
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
      var carrera = formulario.selectCarrera.value;
      var clave = formulario.claveMateria.value;
      var nombre = formulario.nombreMateria.value;
      var satca = formulario.satca.value;

      if (carrera === "" || clave === "" || nombre === "" || satca === "") {
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

  <form class="formulario" id="formulario" action="edit_materia.php?idM=<?= $id; ?>" method="POST"
    onsubmit="return validarFormulario()">

    <div class="card card-body">
      <h1>Materias</h1>
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
        <label for="claveMateria">Clave materia:</label>
        <input class="form-control" type="text" placeholder="Clave de la materia" name="claveMateria" id="claveMateria"
          value="<?= $row2['clave'] ?>" />
      </div>
      <div class="contenedor">
        <label for="nombreMateria">Nombre de la asignatura:</label>
        <input class="form-control" type="text" placeholder="Nombre de la asignatura" name="nombreMateria"
          id="nombreMateria" oninput="validarSoloLetras(this.id)" value="<?= utf8_decode($row2['nombre']); ?>" />
      </div>
      <div class="contenedor">
        <label for="satca">Satca:</label>
        <input class="form-control" type="text" name="satca" id="satca" placeholder="SATCA. Ej: 2-3-5"
          oninput="validarNumerosYGuiones(this.id)" value="<?= $row2['satca'] ?>" />
      </div>
      <div class="contenedor">
        <label for="caracterizacion">Caracterización de la asignatura:</label>
        <textarea class="form-control" name="caracterizacion" id="caracterizacion"
          placeholder="Caracterización de la asignatura (Opcional)"><?= utf8_decode($caracterizacion); ?></textarea>
      </div>
      <div class="contenedor">
        <label for="intencion">Intencion didactica (Opcional):</label>
        <textarea class="form-control" name="intencion" id="intencion"
          placeholder="Intención didactica (Opcional)"><?= utf8_decode($intencionDidactica); ?></textarea>
      </div>
      <div class="contenedor">
        <label for="previas">Competencias previas (Opcional):</label>
        <textarea class="form-control" name="previas" id="previas"
          placeholder="Competencias previas (Opcional)"><?= utf8_decode($competenciasPrevias); ?></textarea>
      </div>
      <div class="contenedor">
        <label for="genericas">Competencias genericas (Opcional):</label>
        <textarea class="form-control" name="genericas" id="genericas"
          placeholder="Competencias genericas (Opcional.)"><?= utf8_decode($competenciasGenericas); ?></textarea>
      </div>
      <div class="contenedor">
        <label for="especificas">Competencias especificas (Opcional):</label>
        <textarea class="form-control" name="especificas" id="especificas"
          placeholder="Competencias especificas (Opcional.)"><?= utf8_decode($competenciasEspecificas); ?></textarea>
      </div>
      <div class="contenedor">
        <label for="fuentes">Fuentes de información (Opcional):</label>
        <textarea class="form-control" name="fuentes" id="fuentes"
          placeholder="Fuentes de información (Opcional.)"><?= utf8_decode($fuentes); ?></textarea>
      </div>
      <div class="contenedor">
        <label for="apDidacticos">Apoyos didacticos (Opcional):</label>
        <textarea class="form-control" name="apDidacticos" id="apDidacticos"
          placeholder="Apoyos didacticos (Opcional.)"><?= utf8_decode($apoyosDidacticos); ?></textarea>
      </div>
      <div class="contenedor">
        <input type="submit" value="Editar" class="button btn" name="btnAgregarMateria" id="btnAgregarMateria">
      </div>
    </div>
  </form>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="../js/materias.js"></script>
</body>

</html>