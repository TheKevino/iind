<?php
$query = "SELECT * FROM carreras";

$result = mysqli_query($conn, $query);

if (!$result) {
  die("Query failed");
}

?>

<div class="contenedor-main">

  <div class="card card-body col-md-5 mt-4">
    <h3>Grupo</h3>

    <div class="row col-md-12 m-2">
      <div class="col-md-12">
        <select class="form-select" name="selectCarrera" id="selectCarrera">
          <!-- PARTE PARA LLENAR EL SELECT DEL FORMULARIO CON LAS CARRERAS -->
          <?php while ($row = mysqli_fetch_array($result)) { ?>

            <option value=<?= $row['idCarrera']; ?>><?= $row['nombre']; ?></option>

          <?php } ?>
        </select>
      </div>
    </div>

    <div class="row col-md-12 m-2">
      <div class="col-md-12">
        <input class="form-control" type="text" placeholder="Clave del grupo" name="clave" id="clave" />
      </div>
    </div>

    <div class="row col-md-12 m-2">
      <div class="col-md-12">
        <input class="form-control" type="text" placeholder="Nombre del grupo" name="nombre" id="nombre" />
      </div>
    </div>

    <button onclick="agregarGrupo()" class="button btn" name="btnAgregarGrupo" id="btnAgregarGrupo">Agregar</button>

  </div>
  <script src="gestionAcademica/js/grupos.js"></script>
</div>