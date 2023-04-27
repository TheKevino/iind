<div>
  <style>

        .contenedor-busqueda{
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

  </style>

  <h2>Consultar usuarios</h2>

  <div class="contenedor-busqueda">

    <div class="card card-body col-md-8 mt-4 mb-4">
        <div class="row">
          <div class="col-md-8">
            <input type="text" class="form-control" id="buscador_usuario_consulta" name="buscador_usuario_consulta" autocomplete="off" placeholder="Nombre, apellidos, usuario, etc.">
          </div>
          <div class="col-md-4">
            <button class="boton btn-consulta" name="btnBuscarUsuarioConsulta" id="btnBuscarUsuarioConsulta">Buscar</button>
          </div>
        </div>
    </div>

  </div>

  <div class="tabla-usuarios">
    <section id="tabla_usuarios_consulta">

    </section>
  </div>

  <script src="residencias/js/consulta_usuarios.js"></script>
</div>