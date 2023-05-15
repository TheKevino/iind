<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="residencias/img/favicon.ico">
    <title>Crear Formulario</title>
    <link rel="stylesheet" href="residencias/css/jquery-ui.css">
    <script src="residencias/js/jquery-ui.js"></script>
    <script src="residencias/js/jquery-3.6.0.min.js"></script>
    <script src="js/validaciones.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/paleta.css">
    <!-- Extend Icon -->
    <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
</head>

<body>

    <style>
        .contenedor {
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

        .btn {
            background-color: #1d1b31;
            color: white !important;
        }

        .btn-page {
            border: none;
            color: #0d6efd !important;
            margin: 5px;
            padding: 5px 10px;
        }
    </style>

    <!-- Formulario -->
    <div class="contenedor">
        <div class="pagination">
            <button onclick="paginaUno()" class="btn-page">1</button>
            <button onclick="paginaDos()" class="btn-page">2</button>
        </div>

        <div class="row">
            <div class="col-md-8">
                <button class="btn btn-principal" onclick="guardarFormulario()">Guardar</button>
            </div>
        </div>

        <div class="card card-body col-md-8 mt-4" id="containerForm">

            <h2>Informacion del alumno y producto</h2>

            <div class="row col-md-12">
                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" placeholder="Apellido paterno" name="paterno" id="paterno"
                        oninput="validarSoloLetras(this.name)">
                </div>
                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" placeholder="Apellido materno" name="materno" id="materno"
                        oninput="validarSoloLetras(this.name)">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2">
                    <input type="text" class="form-control" placeholder="Nombre(s)" name="nombres" id="nombres"
                        oninput="validarSoloLetras(this.name)">
                </div>
                <div class="col-md-6 mt-2">
                    <input type="number" class="form-control" placeholder="Numero de control" name="nc" id="nc">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2">
                    <input type="text" readonly class="form-control-plaintext" value="Carrera: Ingenieria Industrial">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-12 mt-2">
                    <input type="text" class="form-control" placeholder="Nombre del proyecto" name="nombreProyecto"
                        id="nombreProyecto">
                </div>
            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-12 mt-2">
                    <label for="comboProducto">Producto</label>
                    <select class="form-select" name="nombreProyecto" id="comboProducto">
                        <option selected value="PROYECTO">PROYECTO</option>
                        <option value="INFORME TECNICO DE RESIDENCIA PROFESIONAL">INFORME TECNICO DE RESIDENCIA
                            PROFESIONAL</option>
                        <option value="TESIS">TESIS</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
            </div>

            <div class="row col-md-12 mt-1" id="especifique" style="display:none">
                <div class="col-md-12 mt-2">
                    <input type="text" class="form-control" placeholder="Especifique" name="esp" id="esp">
                </div>
            </div>

        </div>

        <div class="container card card-body col-md-12 mt-4" id="containerTable" style="display:none">
            <div class="row col-md-12">

                <div class="col-md-10">
                    <input type="text" class="form-control" name="buscador_usuario" id="buscador_usuario"
                        placeholder="Apellidos, nombre, usuario, etc">
                </div>

                <div class="col-md-2">
                    <button class="btn btn-secundario btn-block" name="btnBuscarUsuario"
                        id="btnBuscarUsuario">Buscar</button>
                </div>

            </div>

            <div class="row col-md-12 mt-2">
                <div class="col-md-4">
                    <p>Asesor Interno:</p>
                    <input type="text" id="asesor" readonly class="form-control-plaintext" value="Sin asignar">
                </div>
                <div class="col-md-4">
                    <p>Revisor 1:</p>
                    <input type="text" id="revisor1" readonly class="form-control-plaintext" value="Sin asignar">
                </div>
                <div class="col-md-4">
                    <p>Revisor 2:</p>
                    <input type="text" id="revisor2" readonly class="form-control-plaintext" value="Sin asignar">
                </div>
            </div>

            <div class="row col-md-12 mt-2">

                <div class="col-md-12">
                    <section id="tabla_usuarios">

                    </section>
                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="residencias/js/registrar_formulario.js"></script>
</body>

</html>