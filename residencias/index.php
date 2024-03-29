<h2>Residencias profesionales</h2>
<?php if ($user->getTipo() == 2) { ?>

  <div class="buttons-header cabecera-flotante">

    <form action="redirection.php?op=6" method="POST">
      <button class="boton btn-excel">
        <i class='bx bx-file'></i>
        &nbsp;&nbsp;
        Descargar en Excel
      </button>
    </form>

    <form action="redirection.php?op=5" method="POST" target="_blank">
      <button class="boton btn-formulario">
        <i class='bx bx-plus'></i>
        &nbsp;&nbsp;
        Nuevo Formulario
      </button>
    </form>
  </div>

<?php } ?>

<div class="fondo-flotante">

  <div class="row table-responsive">

    <table class="table" id="tabla-residencias">

      <thead>
        <tr>
          <th>No.</th>
          <th>N.C</th>
          <th>Paterno</th>
          <th>Materno</th>
          <th>Nombre(s)</th>
          <th>Producto</th>
          <th>Proyecto</th>
          <th>...</th>
        </tr>
      </thead>

      <tbody>
      </tbody>

    </table>

  </div>

</div>

<script src="residencias/js/index.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

<script>
  function confirmacion() {
    event.preventDefault()
    /*
    let respuesta

    Swal.fire({
      title: '¿SEGURO(A) QUE QUIERES ELIMINAR EL FORMULARIO?',
      text: 'Esta acción no se puede deshacer.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Aceptar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        respuesta = true
      } else {
        return false
      }
    });
    return respuesta
    */
    let respuesta = confirm("SEGURO(A) QUE QUIERES ELIMINAR EL FORMULARIO?");

    if (respuesta == true) {
      return true;
    } else {
      return false;
    }
  }
</script>