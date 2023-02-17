<div class="index-window">

  <div class="article-form mt-3">

  <?php if($user->getTipo() == 2){ ?>

    <div class="col-md-5">
      <div class="row col-md-12">

        <div class="col-md-6">
          <form class="ADDform" action="redirection.php?op=6" method="POST">
            <button class="boton btn-complementario-c">
              <i class="fa fa-file-excel-o"></i>
              &nbsp;&nbsp;
              Excel
            </button>
          </form>
        </div>

        <div class="col-md-6">
          <form class="ADDform" action="redirection.php?op=5" method="POST">
            <button class="boton btn-principal">
              <i class="fa fa-plus"></i>
              &nbsp;&nbsp;
              Nuevo Formulario
            </button>
          </form>
        </div>

      </div>
    </div>

  </div>

  <?php } ?>

  <div class="container">

    <div class="row table-responsive">

          <table class="compact table table-striped" id="tabla">

            <thead>
              <tr>
                <th>No. Formulario</th>
                <th>N. Control</th>
                <th>Ap. Paterno</th>
                <th>Ap. Materno</th>
                <th>Nombre(s)</th>
                <th>Producto</th>
                <th>Nombre del proyecto</th>
                <th>...</th>
              </tr>
            </thead>

            <tbody>
            </tbody>

          </table>
          
      </div>

  </div>

  <script src="residencias/js/index.js"></script>

    <script>
      function confirmacion(){   
          let respuesta = confirm("SEGURO(A) QUE QUIERES ELIMINAR EL FORMULARIO?");
          
          if(respuesta == true){ 
              return true;
          } else { 
              return false;
          }
      }
    </script>
</div>