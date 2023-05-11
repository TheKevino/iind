<h2>Reporte final del curso</h2>
<?php if ($user->getTipo() == 1) { ?>

  <form class="buttons-header cabecera-flotante" action="redirection.php?op=18" method="POST" target="_blank">
    <button class="boton btn-formulario" id="btnFormulario">
      <i class="fa fa-plus"></i>
      &nbsp;&nbsp;
      Nuevo Reporte
    </button>
  </form>

<?php } ?>

<div class="fondo-flotante">

  <div class="row table-responsive">

    <table class="table" id="tabla-reporte">

      <thead>
        <tr>
          <th>No.</th>
          <?php if ($user->getTipo() == 2) { ?> <!-- para mostrar nombre del docente -->
            <th>Docente</th>
          <?php } ?>
          <?php if ($user->getTipo() == 1) { ?> <!-- Para mostrar el estado del reporte -->
            <th>Estado</th>
          <?php } ?>
          <th>Departamento</th>
          <th>Inicio del semestre</th>
          <th>Final del semestre</th>
          <th>No. Grupos</th>
          <th>Asign. Diferentes</th>
          <th>...</th>
        </tr>
      </thead>

      <tbody>
      </tbody>

    </table>

  </div>

</div>



<script src="reporteFinalCurso/js/index.js"></script>

<script>
  function confirmacion() {
    /*
    event.preventDefault()
    Swal.fire({
      title: '¿SEGURO(A) QUE QUIERES ELIMINAR EL REPORTE?',
      text: 'Esta acción no se puede deshacer.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Aceptar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        respuesta = true
      } else {
        respuesta = false
      }
    });
    return respuesta
    */
    let respuesta = confirm("SEGURO(A) QUE QUIERES ELIMINAR EL REPORTE?");
    return respuesta;
  }
</script>