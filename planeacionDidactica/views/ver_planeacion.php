<?php
include("../../includes/db.php");

/* $idPlaneacion = base64_decode($_GET['id']);
$idUsuario = base64_decode($_GET['idu']); */

$idPlaneacion = base64_decode($_GET['id']);
$idUsuario = base64_decode($_GET['idu']);

$nombreCarrera = utf8_encode("INGENIERÍA INDUSTRIAL");

//Query para la planeacion
$queryPlaneacion = "SELECT idMateria, idCarrera, nombreDocente, grupo, periodo, aula, fuentes, apoyosDidacticos, noSemanas
 FROM planeaciondidactica WHERE idPlaneacion=$idPlaneacion";
 
$resultPlaneacion = mysqli_query($conn, $queryPlaneacion);
$rowPlaneacion = mysqli_fetch_array($resultPlaneacion);

$nombreDocente = $rowPlaneacion['nombreDocente'];
$datosDocente = explode(" ", $nombreDocente);
$grupo = $rowPlaneacion['grupo'] == null? "SIN ASIGNAR" : strtoupper($rowPlaneacion['grupo']);
$aula = $rowPlaneacion['aula'] == null? "SIN ASIGNAR" : strtoupper($rowPlaneacion['aula']);
$periodo = strtoupper($rowPlaneacion['periodo']);
$fuentesUsuario = $rowPlaneacion['fuentes'] == null? "" : $rowPlaneacion['fuentes'];
$apoyosDidacticosUsuario = $rowPlaneacion['apoyosDidacticos'] == null? "" : $rowPlaneacion['apoyosDidacticos'];
$noSemanas = $rowPlaneacion['noSemanas'];
$semanaSeguimientoDepartamental = ceil($noSemanas/2);

//Query para la materia
$idMateria = $rowPlaneacion['idMateria'];
$queryMateria = "SELECT clave, nombre, satca, caracterizacion, intencionDidactica, competenciasPrevias, 
    competenciasGenericas, competenciasEspecificas, fuentes, apoyosDidacticos FROM materias WHERE idMateria=$idMateria";
$resultMateria = mysqli_query($conn, $queryMateria);
$rowMateria = mysqli_fetch_array($resultMateria);

$claveMateria = strtoupper($rowMateria['clave']);
$nombreMateria = mb_strtoupper(utf8_decode($rowMateria['nombre']));
$satca = $rowMateria['satca'] == null? "SIN DEFINIR" : strtoupper($rowMateria['satca']);
$caracterizacion = $rowMateria['caracterizacion'] == null? "SIN DEFINIR" : $rowMateria['caracterizacion'];
$intencionDidactica = $rowMateria['intencionDidactica'] == null? "SIN DEFINIR" : $rowMateria['intencionDidactica'];
$competenciasPrevias = $rowMateria['competenciasPrevias'] == null? "SIN DEFINIR" : $rowMateria['competenciasPrevias'];
$competenciasGenericas = $rowMateria['competenciasGenericas'] == null? "SIN DEFINIR" : $rowMateria['competenciasGenericas'];
$competenciasEspecificas = $rowMateria['competenciasEspecificas'] == null? "SIN DEFINIR" : $rowMateria['competenciasEspecificas'];
$fuentes = $rowMateria['fuentes'] == null? "" : $rowMateria['fuentes'];
$apoyosDidacticos = $rowMateria['apoyosDidacticos'] == null? "" : $rowMateria['apoyosDidacticos'];

//Query para los temas
//$queryTemas = "SELECT idTema, noTema, nombre, temasSubtemas, actsAprendizaje, desCompGenericas, horasTeoricoPracticas FROM temas 
//WHERE idMateria = $idMateria ORDER BY noTema ASC";

$queryTemas = "SELECT idTema, noTema, temas.nombre as 'nombre', temasSubtemas, actsAprendizaje, desCompGenericas, satca FROM temas, materias 
    WHERE (temas.idMateria = materias.idMateria) AND temas.idMateria = $idMateria ORDER BY noTema ASC";

$resultTemas = mysqli_query($conn, $queryTemas);

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../residencias/img/favicon.ico" />
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title><?= $nombreMateria; ?></title>
    <!-- CSS only -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"/>
    <link rel="stylesheet" href="../css/planeacion_didactica.css">
    <link rel="stylesheet" href="../../residencias/css/index.css" />
    <link rel="stylesheet" href="../../css/paleta.css" />
    <link rel="stylesheet" href="../../css/tablas.css">
    <link rel="stylesheet" href="../../gestionAcademica/css/temas.css">
    <!-- Extend Icon -->
    <script src="https://kit.fontawesome.com/8eed7147bf.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="main" id="main">

<a href="../../redirection.php?op=menu" class="volver-btn btn-principal"><i class='fa fa-home'>&nbsp;&nbsp;</i>Regresar</a>

    <div class="container-items" id="container">

        <div class="datos">
            <div class="datos-container">
                <p>NOMBRE DE LA ASIGNATURA: <strong><?= $nombreMateria; ?></strong></p>
                <p>CARRERA: <strong><?= utf8_decode($nombreCarrera); ?></strong></p>
                <div class="comodin">
                    <P>CLAVE DE LA ASIGNATURA: <strong><?= $claveMateria; ?></strong></p>
                    <p>GRUPO: <strong><?= $grupo; ?></strong></p>
                    <p>AULA: <strong><?= $aula; ?></strong></p>
                </div>
                <p>PROFESOR: <strong><?= mb_strtoupper($nombreDocente); ?></strong></p>
                <p>HORAS TEORICAS-HORAS PRACTICAS-CREDITOS: <strong><?= $satca; ?></strong></p>
            </div>
        </div>

        <div class="atributos break-avoid">
            <div class="atributos-container">
                <p>1. Caracterizacion de la asignatura.</p>
                <div class="atributos-info">
                    <p><?= utf8_decode($caracterizacion); ?></p>
                </div>
            </div>
        </div>

        <br>

        <div class="atributos break-avoid">
            <div class="atributos-container">
                <p>2. Intencion didáctica.</p>
                <div class="atributos-info">
                    <p><?= utf8_decode($intencionDidactica); ?></p>
                </div>
            </div>
        </div>

        <br>

        <div class="atributos break-avoid">
            <div class="atributos-container">
                <p>3. Competencia de la asignatura.</p>
                <p>&nbsp;&nbsp;&nbsp;3.1. Competencias previas.</p>
                <div class="atributos-info">
                    <p><?= utf8_decode($competenciasPrevias); ?></p>
                </div>
            </div>
        </div>

        <div class="atributos break-avoid">
            <div class="atributos-container">
                <p>&nbsp;&nbsp;&nbsp;3.2. Competencias genéricas.</p>
                <div class="atributos-info">
                    <p><?= utf8_decode($competenciasGenericas); ?></p>
                </div>
            </div>
        </div>

        <div class="atributos break-avoid">
            <div class="atributos-container">
                <p>&nbsp;&nbsp;&nbsp;3.3. Competencias específicas de la asignatura.</p>
                <div class="atributos-info">
                    <p><?= utf8_decode($competenciasEspecificas); ?></p>
                </div>
            </div>
        </div>

    </div>

    <!---------------------------------------- TEMAS DE LA MATERIA ------------------------------------------------------->

    <?php

        if($resultTemas->num_rows > 0){  
            while($row = mysqli_fetch_array($resultTemas)){
    ?>

            <?php
                $idTemaLocal = $row["idTema"];
                //Query para la informacion complementaria de los temas
                $queryInfoTemas = "SELECT idInfo, actsEnsenanza, fechaInicial, fechaFinal, apOpUno, apOpDos FROM infotemas
                WHERE idTema = $idTemaLocal AND idUsuario = $idUsuario AND idPlaneacion = $idPlaneacion";
                $resultInfoTemas = mysqli_query($conn, $queryInfoTemas);
                $hayInfo = $resultInfoTemas->num_rows > 0 ? true : false ;

                if( $hayInfo ){
                    $rowInfoTema = mysqli_fetch_array($resultInfoTemas);
                    $fechaInicio = explode("-", $rowInfoTema["fechaInicial"]);
                    $fechaFin = explode("-", $rowInfoTema["fechaFinal"]);
                    $idInfo = $rowInfoTema["idInfo"];
                }

            ?>

            <div class="separator"></div>

            <p class = "table-info">
                <span class="tema-info">Tema No. </span> <?= $row["noTema"]?>. &nbsp;&nbsp; 
                <span class="tema-info">Nombre: </span> <?= utf8_decode($row["nombre"]);?> &nbsp;&nbsp; 

                <?php if($hayInfo) {?>

                    <a class='btn btn-secundario' href='../editForm/edit_info.php?idi=<?=base64_encode($idInfo);?>&id=<?=base64_encode($idUsuario);?>&idp=<?=base64_encode($idPlaneacion);?>' target="_blank">
					    <i class='fa fa-pen'></i>
				    </a>

                <?php } else {?>

                    <a class='btn btn-principal' href='info_tema.php?id=<?= base64_encode($idUsuario);?>&idt=<?= base64_encode($idTemaLocal);?>&idp=<?= base64_encode($idPlaneacion);?>' target="_blank">
					    <i class='fa fa-plus'></i>
				    </a>

                <?php }?>

            </p>

                <table class="table table-bordered">
                    <thead>
                        <th>Temas y subtemas para desarrollar la competencia especifica</th>
                        <th>Actividades de aprendizaje</th>
                        <th>Actividades de enseñanza</th> <!-- Columna de InfoTemas -->
                        <th>Desarrollo de competencias genericas</th>
                        <th>Horas teorico-practicas</th>
                        <th>F. Inicial</th> <!-- Columna de InfoTemas -->
                        <th>F. Final</th> <!-- Columna de InfoTemas -->
                        <th>PAP 1 OP</th> <!-- Columna de InfoTemas -->
                        <th>PAP 2 OP</th> <!-- Columna de InfoTemas -->
                    </thead>

                    <tbody>
                        <tr>
                            <td><?= utf8_decode($row["temasSubtemas"]); ?></td>
                            <td><?= utf8_decode($row["actsAprendizaje"]); ?></td>
                            <td><?= $hayInfo ? utf8_decode($rowInfoTema["actsEnsenanza"]) : "SIN DEFINIR"; ?></td> <!-- Columna de InfoTemas -->
                            <td><?= utf8_decode($row["desCompGenericas"]); ?></td>
                            <td><?= utf8_decode($satca); ?></td>
                            <td><?= $hayInfo ? $fechaInicio[2]."-".$fechaInicio[1]."-".$fechaInicio[0] : "SIN DEFINIR"; ?></td> <!-- Columna de InfoTemas -->
                            <td><?= $hayInfo ? $fechaFin[2]."-".$fechaFin[1]."-".$fechaFin[0] : "SIN DEFINIR"; ?></td> <!-- Columna de InfoTemas -->
                            <td><?= $hayInfo ? $rowInfoTema["apOpUno"] : "SIN DEFINIR"; ?></td> <!-- Columna de InfoTemas -->
                            <td><?= $hayInfo ? $rowInfoTema["apOpDos"] : "SIN DEFINIR"; ?></td> <!-- Columna de InfoTemas -->
                        </tr>
                    </tbody>
                </table>

                <br>

                <?php 

                //------------------------Query para la matriz de evaluacion------------------------
                $queryMatrizEval = "SELECT idCriterio, evidencia, porcentaje, a, b, c, d, e, f, instrumentos FROM matrizevaluacion
                WHERE idTema = $idTemaLocal AND idUsuario = $idUsuario";
                $resultMatriz = mysqli_query($conn, $queryMatrizEval);
                $hayInfoMatriz = $resultMatriz->num_rows > 0 ? true : false ;
                ?>
                <p class = "table-info">
                    <span class="tema-info">Matriz de evaluacion: &nbsp;&nbsp;

                    <a class='btn btn-principal' href='criterios_evaluacion.php?id=<?=base64_encode($idTemaLocal);?>&idu=<?=base64_encode($idUsuario);?>&idp=<?=base64_encode($idPlaneacion);?>' target="_blank">
					    <i class='fa fa-plus'></i>
				    </a>
                </p>

                <?php if($resultMatriz->num_rows > 0){ ?>
                <table class="table table-bordered">
                    <thead>
                        <th>Evidencias de aprendizaje</th>
                        <th>%</th>
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>D</th>
                        <th>E</th>
                        <th>F</th>
                        <th>Instrumentos de evaluacion</th>
                        <th>Acciones</th>
                    </thead>

                    <tbody>
                        <?php 
                        while($rowMatriz = mysqli_fetch_array($resultMatriz)){
                        ?>

                        <tr>
                            <td><?= utf8_decode($rowMatriz["evidencia"]); ?></td>
                            <td><?= $rowMatriz["porcentaje"]; ?></td>
                            <td><?= $rowMatriz["a"] == 1 ? "x" : ""; ?></td>
                            <td><?= $rowMatriz["b"] == 1 ? "x" : ""; ?></td>
                            <td><?= $rowMatriz["c"] == 1 ? "x" : ""; ?></td>
                            <td><?= $rowMatriz["d"] == 1 ? "x" : ""; ?></td>
                            <td><?= $rowMatriz["e"] == 1 ? "x" : ""; ?></td>
                            <td><?= $rowMatriz["f"] == 1 ? "x" : ""; ?></td>
                            <td><?= utf8_decode($rowMatriz["instrumentos"]);?></td>

                            <!-- Boton para editar el criterio -->
                            <td>
                                <a class='btn btn-secundario' href='../editForm/edit_criterio.php?id=<?=base64_encode($rowMatriz["idCriterio"]);?>&idu=<?=base64_encode($idUsuario);?>&idp=<?=base64_encode($idPlaneacion);?>' target="_blank">
                                    <i class='fa fa-pen'></i>
                                </a>

                                <a href='../controller/baja_criterio.php?id=<?=base64_encode($rowMatriz["idCriterio"]);?>&idu=<?=base64_encode($idUsuario);?>&idp=<?=base64_encode($idPlaneacion);?>'>
                                    <button class='btn btn-borrar' onclick='return confirmacion()'>
                                        <i class='fa fa-trash'></i>
                                    </button>
                                </a>

                            </td>

                        </tr>

                        <?php } ?>
                    </tbody>
                </table>

                <?php } else { ?>
                    <h3>Sin criterios de evaluacion.</h3>
                <?php }?>

        <?php
            } 
        } else {
        ?>

        <h3>Sin Temas Definidos</h3>

        <?php } ?>

    <!---------------------------------------- FIN TEMAS ---------------------------------------->
    <!---------------------------------------- FUENTES Y APOYOS DIDACTICOS ------------------------------------------------------->
    <div class="separator"></div>

    <div class="atributos break-avoid">
        <div class="atributos-container">
            <p>
                <span>4. Fuentes de información y apoyos didácticos.</span>
                
                <a class='btn btn-secundario' href='../editForm/edit_fuentes_apoyos.php?id=<?=base64_encode($idPlaneacion);?>&idu=<?=base64_encode($idUsuario);?>' target="_blank">
					<i class='fa fa-pen'></i>
				</a>

            </p>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <th>Fuentes de información</th>
            <th>Apoyos didácticos</th>
        </thead>

        <tbody>
            <tr>
                <td>
                    <?= utf8_decode($fuentes);?>
                    <br>
                    <?= utf8_decode($fuentesUsuario);?>
                </td>
                <td>
                    <?= utf8_decode($apoyosDidacticos);?>
                    <br>
                    <?= utf8_decode($apoyosDidacticosUsuario);?>
                </td>
            </tr>
        </tbody>
    </table>
    <!---------------------------------------- FIN FUENTES Y APOYOS DIDACTICOS ------------------------------------------------------->
    <!---------------------------------------- CALENDARIZACION ---------------------------------------->
    <div class="separator"></div>

    <div class="atributos break-avoid">
        <div class="atributos-container">
            <p>
                <span>5. Calendarización de evaluación en semanas.</span>
                
                <a class='btn btn-principal' href='calendarizacion_producto.php?id=<?=base64_encode($idPlaneacion);?>&idu=<?=base64_encode($idUsuario);?>&n=<?=base64_encode($noSemanas);?>' target="_blank">
					<i class='fa fa-plus'></i>
				</a>

            </p>
            <h6>Selecciona uno de los registros para eliminarlo de la tabla de calendarización.</h6>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <th>Semana</th>
            <?php
                for($i = 1 ; $i <= 16 ; $i++){
            ?>

            <th><?=$i?></th>

            <?php } ?>
        </thead>
        <tbody>
            <tr>
                <td>TP</td>
                <!-- Ciclo for para analizar cada celda y ver si le corresponde la semana -->
                <?php
                    for($i = 1 ; $i <= 16 ; $i++){
                ?>

                <td>

                <?php 
                    //------------------------Query para el contenido de las semanas------------------------
                    $querySemanaN = "SELECT idCalendarizacion, producto FROM calendarizaciones WHERE idPlaneacion = $idPlaneacion AND idUsuario = $idUsuario AND tipo = 'TP' AND semana = $i";
                    $resultSemanaN = mysqli_query($conn, $querySemanaN);
                ?>

                <!-- Verifico que existan resultadon -->
                <?php if($resultSemanaN->num_rows > 0){ 
                        //si existen, se usara un while para imprimirlos
                        while($rowSemanaN = mysqli_fetch_array($resultSemanaN)){
                            $idCalendarizacion = $rowSemanaN["idCalendarizacion"];
                ?>

                <a href="../controller/baja_calendarizacion.php?id=<?=base64_encode($idCalendarizacion);?>&idu=<?=base64_encode($idUsuario);?>&idp=<?=base64_encode($idPlaneacion);?>"><?=$rowSemanaN["producto"];?></a> <br />

                <?php } } ?>
                </td>

                <?php } ?>
            </tr>
            <tr>
                <td>TR</td>
                <!-- Ciclo for para analizar cada celda y ver si le corresponde la semana -->
                <?php
                    for($i = 1 ; $i <= 16 ; $i++){
                ?>

                <td>

                <?php 
                    //------------------------Query para el contenido de las semanas------------------------
                    $querySemanaN = "SELECT idCalendarizacion, producto FROM calendarizaciones WHERE idPlaneacion = $idPlaneacion AND idUsuario = $idUsuario AND tipo = 'TR' AND semana = $i";
                    $resultSemanaN = mysqli_query($conn, $querySemanaN);
                ?>

                <!-- Verifico que existan resultadon -->
                <?php if($resultSemanaN->num_rows > 0){ 
                        //si existen, se usara un while para imprimirlos
                        while($rowSemanaN = mysqli_fetch_array($resultSemanaN)){
                            $idCalendarizacion = $rowSemanaN["idCalendarizacion"];
                ?>

                <a href="../controller/baja_calendarizacion.php?id=<?=base64_encode($idCalendarizacion);?>&idu=<?=base64_encode($idUsuario);?>&idp=<?=base64_encode($idPlaneacion);?>"><?=$rowSemanaN["producto"];?></a> <br />

                <?php } } ?>
                </td>

                <?php } ?>
            </tr>
            <tr>
                <td>SD</td>
                <!-- Ciclo for para analizar cada celda y ver si le corresponde la semana -->
                <?php
                    for($i = 1 ; $i <= 16 ; $i++){
                ?>

                <td>

                <?php 
                if($i == $semanaSeguimientoDepartamental) { echo "<p>SD</p>"; }
                    //------------------------Query para el contenido de las semanas------------------------
                    $querySemanaN = "SELECT idCalendarizacion, producto FROM calendarizaciones WHERE idPlaneacion = $idPlaneacion AND idUsuario = $idUsuario AND tipo = 'SD' AND semana = $i";
                    $resultSemanaN = mysqli_query($conn, $querySemanaN);
                ?>

                <!-- Verifico que existan resultadon -->
                <?php if($resultSemanaN->num_rows > 0){ 

                        //si existen, se usara un while para imprimirlos
                        while($rowSemanaN = mysqli_fetch_array($resultSemanaN)){
                            $idCalendarizacion = $rowSemanaN["idCalendarizacion"];
                ?>

                <a href="../controller/baja_calendarizacion.php?id=<?=base64_encode($idCalendarizacion);?>&idu=<?=base64_encode($idUsuario);?>&idp=<?=base64_encode($idPlaneacion);?>"><?=$rowSemanaN["producto"];?></a> <br />

                <?php } } ?>
                </td>

                <?php } ?>
            </tr>
        </tbody>
    </table>

</div>

</body>

<script>
  function confirmacion(){   
      let respuesta = confirm("SEGURO(A) QUE QUIERES ELIMINAR EL CRITERIO?");
      return respuesta;
  }
</script>

</html>