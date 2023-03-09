  <h2>Planeacion e instrumentación didáctica</h2>
  <?php if($user->getTipo() == 1){ ?>

    <form class="buttons-header cabecera-flotante" action="redirection.php?op=19" method="POST">
      <button class="boton btn-formulario" id="btnFormulario">
        <i class="fa fa-plus"></i>
        &nbsp;&nbsp;
        Nueva Planeación
      </button>
    </form>

  <?php } ?>

  <div class="fondo-flotante">

    <div class="row table-responsive">

          <table class="table" id="tabla-planeacion">

            <thead>
              <tr>
                <th>No.</th>
                <?php if($user->getTipo() == 2){ ?>
                <th>Docente</th>
                <?php } ?>
                <th>Carrera</th>
                <th>Materia</th>
                <th>Grupo</th>
                <th>Aula</th>
                <th>Periodo</th>
                <th>...</th>
              </tr>
            </thead>

            <tbody>
            </tbody>

          </table>

    </div>

  </div>

<script src="planeacionDidactica/js/index.js"></script>
  <script>
  function confirmacion(){   
      let respuesta = confirm("SEGURO(A) QUE QUIERES ELIMINAR LA PLANEACION?");
      return respuesta;
  }
  </script>