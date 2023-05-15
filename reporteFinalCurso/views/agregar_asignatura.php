<?php
    include("../../includes/db.php");

    $idReporte = base64_decode($_GET["id"]);
    $idUsuario = base64_decode($_GET["idUs"]);

    $queryMaterias="SELECT DISTINCT materias.nombre as 'materia'FROM materias, usuarios, usuarioimparte 
    WHERE (usuarios.idUsuario = usuarioimparte.idUsuario) AND (materias.idMateria = usuarioimparte.idMateria) 
    AND usuarioimparte.idUsuario = $idUsuario";
    $resultMaterias = mysqli_query($conn, $queryMaterias);

    $queryCarreras = "SELECT nombre FROM carreras";
    $resultCarreras = mysqli_query($conn, $queryCarreras);
    
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../residencias/img/favicon.ico">
    <title>Agregar asignación</title>
    <link rel="stylesheet" href="../../residencias/css/jquery-ui.css">
    <script src="../../residencias/js/jquery-ui.js"></script>
    <script src="../../residencias/js/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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

</style>

  <!-- Formulario -->
  <div class="contenedor mt-4">
 
        <div class="card card-body col-md-10 mt-2" id="containerForm">

            <h2>Asignaturas programas 2009-2010</h2>
            <h4>Notas importantes:</h4>
            <p>1 -. (*) Son los campos que se llenan manualmente. El resto se calcula automaticamente.</p>
            <p>2 -. En el total de estudiantes incluir tambien a los estudiantes que desertaron.</p>
            <p>Entendiendo como estudiante desertor al que toma la decisión de no presentar exámenes de primera o segunda oportunidad aun teniendo derecho a ellos.</p>
            <p>3 -.Los estudiantes que se incluirán en el Num. de estudiantes no acreditados son todos los estudiantes no acreditados incluyendo los desertores.</p>
            

            <div class="row col-md-12 mt-1">

                <div class="col-md-6 mt-2">
                    <label for="comboAsignatura">Asignatura:</label>
                    <select class="form-select" name="comboAsignatura" id="comboAsignatura" >
                    <?php while($row = mysqli_fetch_array($resultMaterias)){ ?>

                        <option value="<?= $row['materia']; ?>" ><?= utf8_decode($row['materia']); ?></option>
                        
                    <?php } ?>
                    </select>
                </div>

                <div class="col-md-6 mt-2">
                    <label for="comboCarrera">Carrera:</label>
                    <select class="form-select" name="comboCarrera" id="comboCarrera" >
                    <?php while($row = mysqli_fetch_array($resultCarreras)){ ?>

                        <option value="<?= $row['nombre']; ?>"><?= $row['nombre']; ?></option>
                        
                    <?php } ?>
                    </select>
                </div>

            </div>

            <div class="row col-md-12 mt-1">

                <div class="col-md-3 mt-2">
                    <label for="totalEstudiantes" required>Total Estudiantes:(*)</label>
                    <input class="form-control" type="number" name="totalEstudiantes" id="totalEstudiantes" min="0">
                </div>

                <div class="col-md-3 mt-2">
                    <label for="primeraOp">Aprobados 1ra oportunidad: (*)</label>
                    <input class="form-control" type="number" name="primeraOp" id="primeraOp" min="0">
                </div>

                <div class="col-md-3 mt-2">
                    <label for="segundaOp">Aprobados 2da oportunidad: (*)</label>
                    <input class="form-control" type="number" name="segundaOp" id="segundaOp" min="0">
                </div>

                <div class="col-md-3 mt-2">
                    <label for="numDesertores">Num. desertores: (*)</label>
                    <input class="form-control" type="number" name="numDesertores" id="numDesertores" min="0">
                </div>

            </div>

            <div class="row col-md-12 mt-1">
                <div class="col-md-6 mt-2">
                    <label for="totalAcreditados">Total de acreditados:</label>
                    <input class="form-control" readonly type="number" name="totalAcreditados" id="totalAcreditados" min="0">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="porcentajeAcreditados">% de acreditados:</label>
                    <input class="form-control" readonly type="number" name="porcentajeAcreditados" id="porcentajeAcreditados" min="0">
                </div>
            </div>

            <div class="row col-md-12 mt-1">

                <div class="col-md-4 mt-2">
                    <label for="numNoAcreditados">Num. No acreditados:</label>
                    <input class="form-control" readonly type="number" name="numNoAcreditados" id="numNoAcreditados" min="0">
                </div>

                <div class="col-md-4 mt-2">
                    <label for="primeraOp">% No acreditados:</label>
                    <input class="form-control" readonly type="number" name="porcentajeNoAcreditados" id="porcentajeNoAcreditados" min="0">
                </div>

                <div class="col-md-4 mt-2">
                    <label for="porcentajeDesertores">% desertores:</label>
                    <input class="form-control" readonly type="number" name="porcentajeDesertores" id="porcentajeDesertores" min="0">
                </div>

            </div>

        </div><!-- FIN CONTENEDOR -->

        <div class="row mt-4">
            <div class="col-md-8 mb-4">
                <button class="btn btn-success" id="btnGuardar" style="width: 20rem;">Guardar</button>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/agregar_asignatura.js"></script>

<!-- SCRIPT PARA REGISTRAR LA ASIGNATURA -->
<script>
    btnGuardar.addEventListener('click', (e)=>{
    let asignatura = document.getElementById('comboAsignatura').value;
    let carrera = document.getElementById('comboCarrera').value;
    let totalEstudiantes = document.getElementById('totalEstudiantes').value;
    let primeraOp = document.getElementById('primeraOp').value;
    let segundaOp = document.getElementById('segundaOp').value;
    let totalAcreditados = document.getElementById('totalAcreditados').value;
    let porcentajeAcreditados = document.getElementById('porcentajeAcreditados').value;
    let numNoAcreditados = document.getElementById('numNoAcreditados').value;
    let porcentajeNoAcreditados = document.getElementById('porcentajeNoAcreditados').value;
    let numDesertores = document.getElementById('numDesertores').value;
    let porcentajeDesertores = document.getElementById('porcentajeDesertores').value;

    if( totalEstudiantes.length < 1 || primeraOp.length < 1 || segundaOp.length < 1 || totalAcreditados.length < 1 || porcentajeAcreditados.length < 1 || 
        numNoAcreditados.length < 1 || porcentajeNoAcreditados.length < 1 || numDesertores.length < 1 || porcentajeDesertores.length < 1 ){

        alert("No se permiten campos vacios");

    } else if ( parseInt(totalEstudiantes) < 0 || parseInt(primeraOp) < 0 || parseInt(segundaOp) < 0 || parseInt(totalAcreditados) < 0 || 
                parseInt(porcentajeAcreditados) < 0 || parseInt(numNoAcreditados) < 0 || parseInt(porcentajeNoAcreditados) < 0 || parseInt(numDesertores) < 0 
                || parseInt(porcentajeDesertores) < 0 ){

        alert("No se permiten valores negativos");

    } else{
        //para mandar la informacion a php
        $.post('../controller/alta_asignatura_reporte.php', { idReporte:<?= $idReporte;?>, asignatura: asignatura, carrera: carrera,
            totalEstudiantes: totalEstudiantes, primeraOp: primeraOp, segundaOp: segundaOp, totalAcreditados: totalAcreditados, porcentajeAcreditados: porcentajeAcreditados,
            EstudiantesNoAcreditados: numNoAcreditados, porcentajeNoAcreditados: porcentajeNoAcreditados, desertores: numDesertores, porcentajeDesertores: porcentajeDesertores }, function(data){

                if(data!=null){
                    alert("Asignatura agregada al reporte");
                    location.href ="agregar_asignatura.php?id=<?= base64_encode($idReporte);?>&idUs=<?= base64_encode($idUsuario);?>";
                } else{
                    alert("Error guardando la asignatura");
                }

        });
    }

});
</script>

</body>
</html>
