<?php

$query = "SELECT * FROM carreras";

$result = mysqli_query($conn, $query);

if (!$result) {
  die("Query failed");
}

?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

<!-- Validaciones -->
<script src="js/validaciones.js"></script>

<div class="contenedor-main">

  <div class="card card-body col-md-5 mt-4">

    <h3>Materia</h3>

    <div class="row col-md-12">
      <div class="col-md-12">
        <select class="form-select m-2" name="selectCarrera" id="selectCarrera">
          <!-- PARTE PARA LLENAR EL SELECT DEL FORMULARIO CON LAS CARRERAS -->
          <?php while ($row = mysqli_fetch_array($result)) { ?>

            <option value=<?= $row['idCarrera']; ?>><?= $row['nombre']; ?></option>

          <?php } ?>
        </select>
      </div>
    </div>

    <div class="row col-md-12">
      <div class="col-md-4">
        <input class="form-control m-2" type="text" name="claveMateria" id="claveMateria"
          placeholder="Clave de la materia (*)" onchange="claveMateria(this.id)" />
      </div>

      <div class="col-md-4">
        <input class="form-control m-2" type="text" name="nombreMateria" id="nombreMateria"
          placeholder="Nombre de la materia (*)" onchange="validarSoloLetrasID(this.id)" />
      </div>

      <div class="col-md-4">
        <input class="form-control m-2" type="text" name="satca" id="satca" placeholder="SATCA. Ej: 2-3-5 (*)" onchange="validarNumerosYGuiones(this.id)"/>
      </div>
    </div>

    <div class="row col-md-12">
      <div class="col-md-12">
        <textarea class="form-control m-2" name="caracterizacion" id="caracterizacion"
          placeholder="Caracterización de la asignatura"></textarea>
      </div>
    </div>

    <div class="row col-md-12">
      <div class="col-md-12">
        <textarea class="form-control m-2" name="intencion" id="intencion"
          placeholder="Intención didactica."></textarea>
      </div>
    </div>

    <div class="row col-md-12">
      <div class="col-md-4">
        <textarea class="form-control m-2" name="previas" id="previas"
          placeholder="Competencias previas."></textarea>
      </div>

      <div class="col-md-4">
        <textarea class="form-control m-2" name="genericas" id="genericas"
          placeholder="Competencias genericas."></textarea>
      </div>

      <div class="col-md-4">
        <textarea class="form-control m-2" name="especificas" id="especificas"
          placeholder="Competencias especificas."></textarea>
      </div>
    </div>

    <div class="row col-md-12">
      <div class="col-md-6">
        <textarea class="form-control m-2" name="fuentes" id="fuentes"
          placeholder="Fuentes de información."></textarea>
      </div>

      <div class="col-md-6">
        <textarea class="form-control m-2" name="apDidacticos" id="apDidacticos"
          placeholder="Apoyos didacticos."></textarea>
      </div>
    </div>

    <button onclick="agregarMateria()" class="button btn m-2" name="btnAgregarMateria" id="btnAgregarMateria">Agregar</button>
  </div>

  <script src="gestionAcademica/js/materias.js"></script>
</div>