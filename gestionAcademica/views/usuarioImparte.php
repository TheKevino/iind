<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="residencias/img/favicon.ico">
    <title>Crear clase</title>
    <link rel="stylesheet" href="residencias/css/jquery-ui.css">
    <script src="residencias/js/jquery-ui.js"></script>
    <script src="residencias/js/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/paleta.css">
    <!-- Extend Icon -->
    <script
      src="https://kit.fontawesome.com/8eed7147bf.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>

<style>

    .contenedor{
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .pagination{
        text-align: center;
        margin: 30px 30px 60px;
        user-select: none;
    }

    .btn-page{
        border: none;
        color: #143F6B;
        margin: 5px;
        padding: 5px 10px;
    }

</style>

    <!-- Navbar -->
  <?php include('navigator.php'); ?>

  <!-- Formulario -->
    <div class="contenedor">
        <div class="pagination">
            <button onclick="paginaDocentes()" class="btn-page">Docente</button>
            <button onclick="paginaMaterias()" class="btn-page">Asignatura</button>
            <button onclick="paginaGrupos()" class="btn-page">Grupo</button>
            <button onclick="paginaFechas()" class="btn-page">Fecha</button>
        </div>

        <div class="row" id="containerGuardar">
            <div class="col-md-8">
                <button class="btn btn-principal" onclick="guardarClase()">Guardar</button>
            </div>
        </div>

        <div class="container card card-body col-md-12 mt-4" id="containerTable">

            <div class="row col-md-12 mt-2">
                <div class="col-md-4">
                    <p>Docente:</p>
                    <input type="text" id="docente" readonly class="form-control-plaintext" value="Sin asignar">
                </div>
                <div class="col-md-4">
                    <p>Asignatura:</p>
                    <input type="text" id="asignatura" readonly class="form-control-plaintext" value="Sin asignar">
                </div>
                <div class="col-md-4">
                    <p>Grupo:</p>
                    <input type="text" id="grupo" readonly class="form-control-plaintext" value="Sin asignar">
                </div>
            </div>

        </div>

        <!-------------------------------------------- TABLA PARA ESCOGER DOCENTE ---------------------------------------------->
        <div class="container card card-body col-md-12 mt-4" id="containerDocentes">
            <h3>Docente</h3>
            <div class="row col-md-12">

                <div class="col-md-10">
                    <input type="text" class="form-control" name="buscador_usuario" id="buscador_usuario" placeholder="Apellidos, nombre, usuario, etc">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-secundario btn-block" name="btnBuscarUsuario" id="btnBuscarUsuario">Buscar</button>
                </div>

            </div>

            <div class="row col-md-12 mt-2">
                
                <div class="col-md-12">
                    <section id="tabla_usuarios">

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
                    <input type="text" class="form-control" name="buscador_materia" id="buscador_materia" placeholder="Informacion de la asignatura">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-secundario btn-block" name="btnBuscarMateria" id="btnBuscarMateria">Buscar</button>
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
                    <input type="text" class="form-control" name="buscador_grupo" id="buscador_grupo" placeholder="Informacion del grupo">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-secundario btn-block" name="btnBuscarGrupo" id="btnBuscarGrupo">Buscar</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="gestionAcademica/js/usuario_imparte.js"></script>
</body>
</html>
