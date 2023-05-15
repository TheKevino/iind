<div>
    <style>
        .contenedor-crear-clase {
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .pagination {
            text-align: center;
            margin: 30px 30px 60px;
            user-select: none;
        }

        .btn-page {
            border: none;
            background-color: transparent;
            color: #1d1b31;
            border: 2px #1d1b31 solid;
            margin: 5px;
            padding: 5px 10px;
        }
    </style>
    <h3>Crear clase</h3>
    <!-- Formulario -->
    <div class="contenedor-crear-clase">
        <div class="pagination">
            <button onclick="paginaDocentes()" class="btn-page">Docente</button>
            <button onclick="paginaMaterias()" class="btn-page">Asignatura</button>
            <button onclick="paginaGrupos()" class="btn-page">Grupo</button>
            <button onclick="paginaFechas()" class="btn-page">Fecha</button>
        </div>

        <div class="container card card-body col-md-12 mt-4" id="containerTable">

            <div class="row col-md-12 mt-2">
                <div class="col-md-4">
                    <p>Docente (*)</p>
                    <input type="text" id="docente" readonly class="form-control-plaintext" value="Sin asignar">
                </div>
                <div class="col-md-4">
                    <p>Asignatura (*)</p>
                    <input type="text" id="asignatura" readonly class="form-control-plaintext" value="Sin asignar">
                </div>
                <div class="col-md-4">
                    <p>Grupo (*)</p>
                    <input type="text" id="grupo" readonly class="form-control-plaintext" value="Sin asignar">
                </div>
            </div>

            <div class="row col-md-12 mt-2">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <button class="btn-consulta mt-3" style="width:100% !important" onclick="guardarClase()">Guardar</button>
                </div>
                <div class="col-md-4">
                </div>
            </div>

        </div>

        <!-------------------------------------------- TABLA PARA ESCOGER DOCENTE ---------------------------------------------->
        <div class="container card card-body col-md-12 mt-4" id="containerDocentes">
            <h3>Docente</h3>
            <div class="row col-md-12">

                <div class="col-md-10">
                    <input type="text" class="form-control" name="buscador_usuario_clase" id="buscador_usuario_clase"
                        placeholder="Apellidos, nombre, usuario, etc">
                </div>

                <div class="col-md-2">
                    <button class="btn-consulta" name="btnBuscarUsuarioClase" id="btnBuscarUsuarioClase">Buscar</button>
                </div>

            </div>

            <div class="row col-md-12 mt-2">

                <div class="col-md-12">
                    <section id="tabla_usuarios_clases">

                    </section>
                </div>

            </div>

        </div>
        <!---------------------------------------------------------------------------------------------------------------------->
        <!-------------------------------------------- TABLA PARA ESCOGER ASIGNATURA ------------------------------------------->
        <div class="container card card-body col-md-12 mt-4" id="containerMaterias" style="display:none;">
            <h3>Asignatura</h3>
            <div class="row col-md-12">

                <div class="col-md-10">
                    <input type="text" class="form-control" name="buscador_materia_imparte" id="buscador_materia_imparte"
                        placeholder="Informacion de la asignatura">
                </div>

                <div class="col-md-2">
                    <button class="btn-consulta" name="btnBuscarMateriaImparte" id="btnBuscarMateriaImparte">Buscar</button>
                </div>

            </div>

            <div class="row col-md-12 mt-2">

                <div class="col-md-12">
                    <section id="tabla_materia">

                    </section>
                </div>

            </div>

        </div>
        <!---------------------------------------------------------------------------------------------------------------------->
        <!-------------------------------------------- TABLA PARA ESCOGER GRUPO ------------------------------------------------>
        <div class="container card card-body col-md-12 mt-4" id="containerGrupos" style="display:none;">
            <h3>Grupo</h3>
            <div class="row col-md-12">

                <div class="col-md-10">
                    <input type="text" class="form-control" name="buscador_grupo_imparte" id="buscador_grupo_imparte"
                        placeholder="Informacion del grupo">
                </div>

                <div class="col-md-2">
                    <button class="btn-consulta" name="btnBuscarGrupoImparte" id="btnBuscarGrupoImparte">Buscar</button>
                </div>

            </div>

            <div class="row col-md-12 mt-2">

                <div class="col-md-12">
                    <section id="tabla_grupos">

                    </section>
                </div>

            </div>

        </div>
        <!---------------------------------------------------------------------------------------------------------------------->
        <!-------------------------------------------- ASIGNAR FECHA ----------------------------------------------------------->
        <div class="container card card-body col-md-12 mt-4" id="containerFechas" style="display:none;">
            <h3>Fechas</h3>
            <div class="row col-md-12">

                <div class="col-md-6">
                    <label for="fecha_inicio">Fecha de inicio del semestre:</label>
                    <input type="date" class="form-control" id="fecha_inicio" placeholder="Fecha de inicio">
                </div>
                <div class="col-md-6">
                    <label for="fecha_fin">Fecha de terminacion del semestre:</label>
                    <input type="date" class="form-control" id="fecha_fin" placeholder="Fecha de terminacion">
                </div>

            </div>

        </div>

    </div>

    <script src="gestionAcademica/js/usuario_imparte.js"></script>
</div>