
<div class="index-window">
        <!-- Buscador -->
  <div class="articleform">

  <?php if($user->getTipo() == 1){ ?>

    <form class="ADDform mt-3" action="redirection.php?op=19" method="POST">
      <button class="boton btn-principal" id="btnFormulario">
        <i class="fa fa-plus"></i>
        &nbsp;&nbsp;
        Nueva Planeación Didactica
      </button>
    </form>

  <?php } ?>

  <div class="container">

    <div class="row table-responsive">

          <table class="table table-striped" id="tabla">

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

  </div>

<script src="planeacionDidactica/js/index.js"></script>
  <script>
  function confirmacion(){   
      let respuesta = confirm("SEGURO(A) QUE QUIERES ELIMINAR LA PLANEACION?");
      return respuesta;
  }
  </script>
</div>