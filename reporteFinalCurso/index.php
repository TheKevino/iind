<div class="index-window">

  <?php
    include_once('includes/user.php');

    if($user->getTipo() == 2){
      include('navigator.php');
    } else{
      include('user_navigator.php');
    }
  ?>
        <!-- Buscador -->
  <div class="articleform">

  <?php if($user->getTipo() == 1){ ?>
    <!--
    <div class="ADDform">
      <a href="redirection.php?op=18" class="btn btn-success btnform mt-4">Nuevo reporte final</a>
    </div>
    -->

    <form class="ADDform mt-3" action="redirection.php?op=18" method="POST">
      <button class="boton btn-principal" id="btnFormulario">
        <i class="fa fa-plus"></i>
        &nbsp;&nbsp;
        Nuevo Reporte
      </button>
    </form>

  <?php } ?>

  <div class="container">

    <div class="row table-responsive">

          <table class="table table-striped" id="tabla">

            <thead>
              <tr>
                <th>No. Reporte</th>
                <?php if($user->getTipo()==2){ ?> <!-- para mostrar nombre del docente -->
                <th>Docente</th>
                <?php } ?>
                <?php if($user->getTipo()==1){ ?> <!-- Para mostrar el estado del reporte -->
                <th>Estado</th>
                <?php } ?>
                <th>Departamento</th>
                <th>Inicio del semestre</th>
                <th>Final del semestre</th>
                <th>No. Grupos</th>
                <th>Asign. Diferentes</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
            </tbody>

          </table>
          
      </div>

    </div>

  </div>

<script src="reporteFinalCurso/js/index.js"></script>

  <script>
  function confirmacion(){   
      let respuesta = confirm("SEGURO(A) QUE QUIERES ELIMINAR EL REPORTE?");
      return respuesta;
  }
  </script>
  </body>
</html>
