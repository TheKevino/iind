<?php
//Query para los encargados
$jefeDivEstudiosProf;
$jefeDeptoIngIndustrial;

$query = "SELECT * FROM encargados";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_array($result);
$jefeDivEstudiosProf = $row['jefeDivisionEstudiosProf'];
$jefeDeptoIngIndustrial = $row['jefeDeptoIngInd'];

?>
<div>

    <style>
        .contenedor-encargados {
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
        }

        .btn-editar-encargados {
            background-color: #1d1b31;
            color: white;
            width: 15rem;
            border-radius: 5px;
        }
    </style>

    <script>
        function validarFormulario() {
            var formulario = document.getElementById("formulario");
            var estudiosPro = formulario.estudiosPro.value;
            var jefeIndustrial = formulario.jefeIndustrial.value;

            if (estudiosPro === "" || jefeIndustrial === "") {
                Swal.fire({
                    title: 'Error!',
                    text: 'Faltan campos por llenar.',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                })
                return false;
            }

            return true;
        }
    </script>

    <script src="js/validaciones.js"></script>

    <form class="contenedor-encargados" id="formulario" action="encargados/editar_encargados.php" method="POST"
        onsubmit="return validarFormulario()">

        <div class="card card-body col-md-8 mt-4">

            <!-- Campos -->
            <div class="row col-md-12">
                <div class="col-md-6 mt-2">
                    <label for="estudiosPro">Jefe de division de estudios profesionales:</label>
                    <input type="text" class="form-control mt-1"
                        placeholder="Jefe de division de estudios profesionales" name="estudiosPro" id="estudiosPro"
                        oninput="validarSoloLetras(this.name)" value="<?= $jefeDivEstudiosProf ?>">
                </div>

                <div class="col-md-6 mt-2">
                    <label for="estudiosPro">Jefe del depto. de Ing. Industrial:</label>
                    <input type="text" class="form-control mt-1" placeholder="Jefe del depto de ingenieria industrial"
                        name="jefeIndustrial" id="jefeIndustrial" oninput="validarSoloLetras(this.name)"
                        value="<?= $jefeDeptoIngIndustrial ?>">
                </div>
            </div>

            <!-- Boton -->
            <input type="submit" class="button btn m-2" name="btnEditarEncargados" id="btnEditarEncargados"
                value="Editar">


        </div>

    </form>

</div>