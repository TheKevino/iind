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

    .contenedor-encargados{
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width:100%;
    }

    .btn-editar-encargados{
        background-color: #1d1b31;
        color: white;
        width: 15rem;
        border-radius: 5px;
    }

</style>

    <form class="contenedor-encargados" action="encargados/editar_encargados.php" method="POST">
    
        <div class="card card-body col-md-8 mt-4">

            <!-- Campos -->
            <div class="row col-md-12">
                <div class="col-md-6 mt-2">
                    <label for="estudiosPro">Jefe de division de estudios profesionales:</label>
                    <input type="text" class="form-control mt-1" placeholder="Jefe de division de estudios profesionales" 
                        name="estudiosPro" id="estudiosPro" value="<?= $jefeDivEstudiosProf ?>">
                </div>

                <div class="col-md-6 mt-2">
                    <label for="estudiosPro">Jefe del depto. de Ing. Industrial:</label>
                    <input type="text" class="form-control mt-1" placeholder="Jefe del depto de ingenieria industrial" 
                    name="jefeIndustrial" id="jefeIndustrial" value="<?= $jefeDeptoIngIndustrial ?>">
                </div>
            </div>

        </div>

        <!-- Boton -->
        <div class="row mt-2">
            <div class="col-md-8">
                <input type="submit" class="btn-editar-encargados" name="btnEditarEncargados" id="btnEditarEncargados" value="Editar">
            </div>
        </div>

    </form>

</div>