<script src="js/validaciones.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">
  
  <div class="contenedor-main">

    <div class="card card-body col-md-5 mt-4">
      <h2>Registrar usuario</h2>

        <div class="row col-md-12">
          <input class="form-control m-2" type="text" name="paterno" id="paterno" placeholder="Apellido paterno" oninput="validarSoloLetras(this.name)" />
        </div>

        <div class="row col-md-12">
          <input class="form-control m-2" type="text" name="materno" id="materno" placeholder="Apellido materno (opcional)" oninput="validarSoloLetras(this.name)" />
        </div>

        <div class="row col-md-12">
          <input class="form-control m-2" type="text" name="nombres" id="nombres" placeholder="Nombre(s)" oninput="validarSoloLetras(this.name)" />
        </div>

        <div class="row col-md-12">
          <input type="email" class="form-control m-2" name="email" id="email" placeholder="Correo Electronico" />
        </div>

        <button id="altausuario" class="button btn" onclick="guardarUsuario()" >Registrar</button>

    </div>

    <script src="residencias/js/registrar_usuario.js"></script>

  </div>
