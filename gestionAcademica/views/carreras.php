<div class="contenedor-main">
   
    <form class="card card-body col-md-5 mt-4" action="gestionAcademica/controller/agregarCarrera.php" method="POST">
        <h3>Carreras</h3>
  
          <div class="row col-md-12 m-1">
            <div class="col-md-12">
              <input class="form-control" type="text" placeholder="Nombre de la carrera" name="carrera" id="carrera" />
            </div>
          </div>

          <input type="submit" value="Agregar" class="button btn m-2" name="btnAgregarCarrera" id="btnAgregarCarrera">
          
    </form>

    <script src="gestionAcademica/js/carreras.js"></script>
</div>