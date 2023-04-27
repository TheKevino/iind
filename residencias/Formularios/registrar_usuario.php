  <div class="contenedor-main">

    <div class="card card-body col-md-5 mt-4">
      <h2>Registrar usuario</h2>

        <div class="row col-md-12">
          <input class="form-control m-2" type="text" name="paterno" id="paterno" placeholder="Apellido paterno" />
        </div>

        <div class="row col-md-12">
          <input class="form-control m-2" type="text" name="materno" id="materno" placeholder="Apellido materno (opcional)" />
        </div>

        <div class="row col-md-12">
          <input class="form-control m-2" type="text" name="nombres" id="nombres" placeholder="Nombre(s)" />
        </div>

        <div class="row col-md-12">
          <input type="email" class="form-control m-2" name="email" id="email" placeholder="Correo Electronico" />
        </div>

        <button id="altausuario" class="button btn" onclick="guardarUsuario()" >Registrar</button>

    </div>

    <script src="residencias/js/registrar_usuario.js"></script>

  </div>
