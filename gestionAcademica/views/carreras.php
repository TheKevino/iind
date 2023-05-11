<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

<!-- Validaciones -->
<script src="../../js/validaciones.js"></script>

<div class="contenedor-main">

  <form class="card card-body col-md-5 mt-4" action="gestionAcademica/controller/agregarCarrera.php" method="POST">
    <h3>Carreras</h3>

    <div class="row col-md-12 m-1">
      <div class="col-md-12">
        <input class="form-control" type="text" placeholder="Nombre de la carrera" name="carrera" id="carrera" oninput="validarSoloLetras(this.id)"/>
      </div>
    </div>

    <input type="submit" value="Agregar" class="button btn m-2" name="btnAgregarCarrera" id="btnAgregarCarrera">

  </form>

  <script src="gestionAcademica/js/carreras.js"></script>
</div>