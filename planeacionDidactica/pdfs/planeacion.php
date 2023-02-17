<?php

include("../../includes/db.php");
include 'plantilla.php';

date_default_timezone_set('America/Los_Angeles');

$idPlaneacion = base64_decode($_GET['id']);
$idUsuario = base64_decode($_GET['idu']);

$fechaHoy = date("d") . "/" . date("m") . "/" . date("Y");

//-------------------------Query para la planeacion-------------------------
$queryPlaneacion = "SELECT idMateria, carreras.nombre as 'carrera', nombreDocente, grupo, periodo, aula, fuentes, apoyosDidacticos, noSemanas FROM planeaciondidactica, carreras 
WHERE planeaciondidactica.idCarrera = carreras.idCarrera AND idPlaneacion = $idPlaneacion";
$resultPlaneacion = mysqli_query($conn, $queryPlaneacion);
$rowPlaneacion = mysqli_fetch_array($resultPlaneacion);

$nombreCarrera = $rowPlaneacion['carrera'];
$nombreDocente = strtoupper($rowPlaneacion['nombreDocente']);
$datosDocente = explode(" ", $nombreDocente);
$grupo = $rowPlaneacion['grupo'] == null? "SIN ASIGNAR" : strtoupper($rowPlaneacion['grupo']);
$aula = $rowPlaneacion['aula'] == null? "SIN ASIGNAR" : strtoupper($rowPlaneacion['aula']);
$periodo = strtoupper($rowPlaneacion['periodo']);

$fuentesUsuario = $rowPlaneacion['fuentes'] == null? "" : utf8_decode($rowPlaneacion['fuentes']);
$fuentesUsuario = str_replace("<br />", "", $fuentesUsuario);

$apoyosDidacticosUsuario = $rowPlaneacion['apoyosDidacticos'] == null? "" : utf8_decode($rowPlaneacion['apoyosDidacticos']);
$apoyosDidacticosUsuario = str_replace("<br />", "", $apoyosDidacticosUsuario);

$noSemanas = $rowPlaneacion['noSemanas'];
$semanaSeguimientoDepartamental = ceil($noSemanas/2);

//-------------------------Query para la materia-------------------------
$idMateria = $rowPlaneacion['idMateria'];
$queryMateria = "SELECT clave, nombre, satca, caracterizacion, intencionDidactica, competenciasPrevias, 
    competenciasGenericas, competenciasEspecificas, fuentes, apoyosDidacticos FROM materias WHERE idMateria=$idMateria";
$resultMateria = mysqli_query($conn, $queryMateria);
$rowMateria = mysqli_fetch_array($resultMateria);

$claveMateria = strtoupper($rowMateria['clave']);
$nombreMateria = utf8_decode($rowMateria['nombre']);
$satca = $rowMateria['satca'] == null? "SIN DEFINIR" : strtoupper($rowMateria['satca']);

$caracterizacion = $rowMateria['caracterizacion'] == null? "" : utf8_decode($rowMateria['caracterizacion']);
$caracterizacion = str_replace("<br />", "", $caracterizacion);

$intencionDidactica = $rowMateria['intencionDidactica'] == null? "" : utf8_decode($rowMateria['intencionDidactica']);
$intencionDidactica = str_replace("<br />", "", $intencionDidactica);

$competenciasPrevias = $rowMateria['competenciasPrevias'] == null? "" : utf8_decode($rowMateria['competenciasPrevias']);
$competenciasPrevias = str_replace("<br />", "", $competenciasPrevias);

$competenciasGenericas = $rowMateria['competenciasGenericas'] == null? "" : utf8_decode($rowMateria['competenciasGenericas']);
$competenciasGenericas = str_replace("<br />", "", $competenciasGenericas);

$competenciasEspecificas = $rowMateria['competenciasEspecificas'] == null? "" : utf8_decode($rowMateria['competenciasEspecificas']);
$competenciasEspecificas = str_replace("<br />", "", $competenciasEspecificas);

$fuentes = $rowMateria['fuentes'] == null? "" : utf8_decode($rowMateria['fuentes']);
$fuentes = str_replace("<br />", "", $fuentes);

$apoyosDidacticos = $rowMateria['apoyosDidacticos'] == null? "" : utf8_decode($rowMateria['apoyosDidacticos']);
$apoyosDidacticos = str_replace("<br />", "", $apoyosDidacticos);

//-------------------------Query para los temas-------------------------
$queryTemas = "SELECT idTema, noTema, nombre, temasSubtemas, actsAprendizaje, desCompGenericas FROM temas 
WHERE idMateria = $idMateria ORDER BY noTema ASC";
$resultTemas = mysqli_query($conn, $queryTemas);


//-------------------------PDF-------------------------
$pdf = new PDF('L', 'mm');
$pdf->SetTitle(utf8_decode($nombreMateria));
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 16);
$pdf->SetLeftMargin(20);

$tamanioFuente = 11;

//texto del header
$pdf->SetXY(95,38);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(100, 10, utf8_decode('INSTITUTO TECNOLÓGICO DE HERMOSILLO'), 0, 1, 'C', 0);
$pdf->SetXY(95,43);
$pdf->Cell(100, 10, utf8_decode('SUBDIRECCION ACADEMICA'), 0, 1, 'C', 0);
$pdf->SetXY(95,48);
$pdf->Cell(100, 10, utf8_decode('DEPARTAMENTO DE INGENIERÍA INDUSTRIAL'), 0, 1, 'C', 0);
$pdf->SetXY(95,53);
$pdf->Cell(100, 10, utf8_decode('PLANEACIÓN E INSTRUMENTACIÓN DIDÁCTICA'), 0, 1, 'C', 0);
$pdf->SetXY(95,58);
$pdf->Cell(100, 10, utf8_decode('PARA LA FORMACIÓN Y DESARROLLO DE COMPETENCIAS DE '. strtoupper($periodo)), 0, 1, 'C', 0);

//nombre asignatura
$pdf->SetFont('Arial', '', $tamanioFuente);
$pdf->SetXY(25,66);
$pdf->Cell(58, 10, utf8_decode('NOMBRE DE LA ASIGNATURA: '), 0, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(100, 10, utf8_decode(mb_strtoupper($nombreMateria,'utf-8')), 0, 1, 'L', 0);

//carrera
$pdf->SetFont('Arial', '', $tamanioFuente);
$pdf->SetXY(25,71);
$pdf->Cell(23, 10, utf8_decode('CARRERA:'), 0, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(100, 10, utf8_decode(mb_strtoupper($nombreCarrera,'utf-8')), 0, 1, 'L', 0);

//clave
$pdf->SetFont('Arial', '', $tamanioFuente);
$pdf->SetXY(25,76);
$pdf->Cell(17, 10, utf8_decode('CLAVE: '), 0, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(85, 10, strtoupper($claveMateria), 0, 0, 'L', 0);

//Grupo
$pdf->SetFont('Arial', '', $tamanioFuente);
$pdf->Cell(17, 10, utf8_decode('GRUPO: '), 0, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(40, 10, utf8_decode(strtoupper($grupo)), 0, 0, 'L', 0);

//Aula
$pdf->SetFont('Arial', '', $tamanioFuente);
$pdf->Cell(14, 10, 'AULA: ', 0, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(35, 10, strtoupper($aula), 0, 1, 'L', 0);

//Profesor
$pdf->SetFont('Arial', '', $tamanioFuente);
$pdf->SetXY(25,81);
$pdf->Cell(25, 10, utf8_decode('PROFESOR: '), 0, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(85, 10, utf8_decode(mb_strtoupper($nombreDocente)), 0, 0, 'L', 0);

//satca
$pdf->SetFont('Arial', '', $tamanioFuente);
$pdf->SetXY(25,86);
$pdf->Cell(97, 10, utf8_decode('HORAS TEORICAS-HORAS PRACTICAS-CREDITOS: '), 0, 0, 'L', 0);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(85, 10, utf8_decode(strtoupper($satca)), 0, 1, 'L', 0);

$tamanioFuente = 14;

//Caracterizacion
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->SetXY(25,95);
$pdf->Cell(97, 10, utf8_decode('1. Caracterización de la asignatura.'), 0, 1, 'L', 0);

$pdf->SetFont('Arial', '', 11);
$pdf->SetX(25);
$pdf->MultiCell(245, 7, utf8_decode($caracterizacion), 1, 'J', 0);

//Intención didáctica.
$pdf->SetX(25);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(97, 10, utf8_decode('2. Intención didáctica.'), 0, 1, 'L', 0);

$pdf->SetFont('Arial', '', 11);
$pdf->SetX(25);
$pdf->MultiCell(245, 7, utf8_decode($intencionDidactica), 1, 'J', 0);

//Competencias de la asignatura.
//Competencias previas.
$pdf->SetX(25);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(97, 10, utf8_decode('3. Competencias de la asignatura'), 0, 1, 'L', 0);
$pdf->SetX(28);
$pdf->Cell(97, 10, utf8_decode('3.1 Competencias previas.'), 0, 1, 'L', 0);

$pdf->SetFont('Arial', '', 11);
$pdf->SetX(25);
$pdf->MultiCell(245, 7, utf8_decode($competenciasPrevias), 1, 'J', 0);

//Competencias genericas.
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->SetX(28);
$pdf->Cell(97, 10, utf8_decode('3.2 Competencias genéricas.'), 0, 1, 'L', 0);

$pdf->SetFont('Arial', '', 11);
$pdf->SetX(25);
$pdf->MultiCell(245, 7, utf8_decode($competenciasGenericas), 1, 'J', 0);

//Competencias especificas.
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->SetX(28);
$pdf->Cell(97, 10, utf8_decode('3.3 Competencias específicas de la asignatura.'), 0, 1, 'L', 0);

$pdf->SetFont('Arial', '', 11);
$pdf->SetX(25);
$pdf->MultiCell(245, 7, utf8_decode($competenciasEspecificas), 1, 'J', 0);

//Analisis por competencias especificas
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->SetX(28);
$pdf->Cell(97, 10, utf8_decode('3.4 Análisis por competencias específicas (Tema).'), 0, 1, 'L', 0);


if($resultTemas->num_rows > 0){  
    while($row = mysqli_fetch_array($resultTemas)){

        $idTemaLocal = $row["idTema"];
        $noTema = $row["noTema"];
        $nombre = utf8_decode($row["nombre"]);
        $temasSubtemas = utf8_decode($row["temasSubtemas"]);
        $temasSubtemas = str_replace("<br />", "", $temasSubtemas);

        $actsAprendizaje = utf8_decode($row["actsAprendizaje"]);
        $actsAprendizaje = str_replace("<br />", "", $actsAprendizaje);

        $desCompGenericas = utf8_decode($row["desCompGenericas"]);
        $desCompGenericas = str_replace("<br />", "", $desCompGenericas);

        //Informacion complementaria
        //Query para la informacion complementaria de los temas
        $queryInfoTemas = "SELECT idInfo, actsEnsenanza, fechaInicial, fechaFinal, apOpUno, apOpDos FROM infotemas
        WHERE idTema = $idTemaLocal AND idUsuario = $idUsuario";

        $resultInfoTemas = mysqli_query($conn, $queryInfoTemas);
        $hayInfo = $resultInfoTemas->num_rows > 0 ? true : false ;

        if( $hayInfo ){
            $rowInfoTema = mysqli_fetch_array($resultInfoTemas);
            $fechaInicio = explode("-", $rowInfoTema["fechaInicial"]);
            $fechaFin = explode("-", $rowInfoTema["fechaFinal"]);

            $actsEnsenanza = utf8_decode($rowInfoTema["actsEnsenanza"]);
            $actsEnsenanza = str_replace("<br />", "", $actsEnsenanza);

            $apOpUno = utf8_decode($rowInfoTema["apOpUno"]);
            $apOpDos = utf8_decode($rowInfoTema["apOpDos"]);
            
        }

        $pdf->SetX(25);
        //numero del tema
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 10, "Tema No. :", 0, 0, 'L', 0);

        $pdf->SetFont('Arial', 'b', 11);
        $pdf->Cell(15, 10, $noTema . ".", 0, 0, 'L', 0);

        //nombre del tema
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(17, 10, "Nombre:", 0, 0, 'L', 0);

        $pdf->SetFont('Arial', 'b', 11);
        $pdf->Cell(10, 10, utf8_decode($nombre) . ".", 0, 1, 'L', 0);

        //tabla
        $pdf->SetWidths(array(50, 55, 45, 40, 16, 15, 15, 10, 10));

        //cabeceras
        $pdf->SetFont('Arial', 'b', 9);
        $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));

        $pdf->Row(array(
            utf8_decode("Temas y subtemas para desarrollar la competencia específica."),
            "Actividades de aprendizaje",
            utf8_decode("Actividades de enseñanza"),
            utf8_decode("Desarrollo de competencias genéricas."),
            utf8_decode("Horas teórico - prácticas"),
            "F. inicial (dd/mm)",
            "F. Final (dd/mm)",
            "PAP 1 OP (%)",
            "PAP 2 OP (%)"
        ));


        $maxlineas = 0;
        $lineasactsEnsenanza = 1;

        if($hayInfo){
            $lineastemasSubtemas = $pdf->NbLines(50, $temasSubtemas);
            $lineasactsAprendizaje = $pdf->NbLines(55, $actsAprendizaje);
            $lineasactsEnsenanza = $pdf->NbLines(45, $actsEnsenanza);
            $lineasdesCompGenericas = $pdf->NbLines(40, $desCompGenericas);

            $maxlineas = max($lineastemasSubtemas, $lineasactsAprendizaje, $lineasactsEnsenanza, $lineasdesCompGenericas);
        } else{
            $lineastemasSubtemas = $pdf->NbLines(50, $temasSubtemas);
            $lineasactsAprendizaje = $pdf->NbLines(70, $actsAprendizaje);
            $lineasdesCompGenericas = $pdf->NbLines(40, $desCompGenericas);

            $maxlineas = max($lineastemasSubtemas, $lineasactsAprendizaje, $lineasdesCompGenericas);
        }

        $startPos = $pdf->GetVerticalPosition();
        $furthestPos = $pdf->GetVerticalPosition();
        $borde = 1;

        $pdf->SetFont('Arial', '', 8);
        
        $posY = $pdf->GetY();
        $pdf->MultiCell(50, 5, utf8_decode($temasSubtemas), $borde, 'J', 0);

        // Returns the furthest of the two possibilites
        $furthestPos = $pdf->FurthestVerticalPosition($pdf->GetVerticalPosition(), $furthestPos );
        $pdf->SetVerticalPosition( $startPos );

        $pdf->SetXY(70, $posY);
        $pdf->MultiCell(55, 6, utf8_decode($actsAprendizaje), $borde, 'J', 0);

        // Returns the furthest of the two possibilites
        $furthestPos = $pdf->FurthestVerticalPosition( $pdf->GetVerticalPosition(), $furthestPos );
        $pdf->SetVerticalPosition( $startPos );

        $pdf->SetXY(125, $posY);
        $pdf->MultiCell(45, 7, $hayInfo ? utf8_decode($actsEnsenanza) : "", $borde, 'J', 0);

        // Returns the furthest of the two possibilites
        $furthestPos = $pdf->FurthestVerticalPosition( $pdf->GetVerticalPosition(), $furthestPos );
        $pdf->SetVerticalPosition( $startPos );

        $pdf->SetXY(170, $posY);
        $pdf->MultiCell(40, 5, utf8_decode($desCompGenericas), $borde, 'J', 0);

        // Returns the furthest of the two possibilites
        $furthestPos = $pdf->FurthestVerticalPosition( $pdf->GetVerticalPosition(), $furthestPos );
        $pdf->SetVerticalPosition( $startPos );

        $pdf->SetXY(210, $posY);
        $pdf->MultiCell(16, 6, $satca, $borde, 'C', 0);

        // Returns the furthest of the two possibilites
        $furthestPos = $pdf->FurthestVerticalPosition( $pdf->GetVerticalPosition(), $furthestPos );
        $pdf->SetVerticalPosition( $startPos );

        $pdf->SetXY(226, $posY);
        $pdf->MultiCell(15, 7, $hayInfo ?  utf8_decode($fechaInicio[2]."-".$fechaInicio[1]) : "", $borde, 'C', 0);

        // Returns the furthest of the two possibilites
        $furthestPos = $pdf->FurthestVerticalPosition( $pdf->GetVerticalPosition(), $furthestPos );
        $pdf->SetVerticalPosition( $startPos );

        $pdf->SetXY(241, $posY);
        $pdf->MultiCell(15, 6, $hayInfo ?  utf8_decode($fechaFin[2]."-".$fechaFin[1]) : "", $borde, 'C', 0);

        // Returns the furthest of the two possibilites
        $furthestPos = $pdf->FurthestVerticalPosition( $pdf->GetVerticalPosition(), $furthestPos );
        $pdf->SetVerticalPosition( $startPos );

        $pdf->SetXY(256, $posY);
        $pdf->MultiCell(10, 7, $hayInfo ?  utf8_decode($apOpUno) : "", $borde, 'C', 0);

        // Returns the furthest of the two possibilites
        $furthestPos = $pdf->FurthestVerticalPosition( $pdf->GetVerticalPosition(), $furthestPos );
        $pdf->SetVerticalPosition( $startPos );

        $pdf->SetXY(266, $posY);
        $pdf->MultiCell(10, 6, $hayInfo ?  utf8_decode($apOpDos) : "", $borde, 'C', 0);

        // Returns the furthest of the two possibilites
        $furthestPos = $pdf->FurthestVerticalPosition( $pdf->GetVerticalPosition(), $furthestPos );
        $pdf->SetVerticalPosition( $startPos );

        $pdf->SetVerticalPosition( $furthestPos );
        
        
        /*
        $pdf->SetAligns(array('J', 'J', 'J', 'J', 'C', 'C', 'C', 'C', 'C'));
        $pdf->Row(array(
            utf8_decode($temasSubtemas),
            utf8_decode($actsAprendizaje),
            $hayInfo ? utf8_decode($actsEnsenanza) : "SIN DEFINIR", //info complementaria
            utf8_decode($desCompGenericas),
            utf8_decode($satca),
            $hayInfo ? $fechaInicio[2]."-".$fechaInicio[1] : "SIN DEFINIR", //info complementaria
            $hayInfo ? $fechaFin[2]."-".$fechaFin[1] : "SIN DEFINIR", //info complementaria
            $hayInfo ? $apOpUno : "SIN DEFINIR", //info complementaria
            $hayInfo ? $apOpDos : "SIN DEFINIR" //info complementaria
        ));
    
        */
        $pdf->AddPage();

        //Query para la matriz de evaluacion
        $queryMatrizEval = "SELECT idCriterio, evidencia, porcentaje, a, b, c, d, e, f, instrumentos FROM matrizevaluacion
                WHERE idTema = $idTemaLocal AND idUsuario = $idUsuario";
        $resultMatriz = mysqli_query($conn, $queryMatrizEval);

        if($resultMatriz->num_rows > 0){

            $pdf->SetFont('Arial', 'b', 12);
            $pdf->SetX(125);
            $pdf->Cell(10, 10, utf8_decode("Matriz de evaluación."), 0, 1, 'L', 0);

            $pdf->SetFont('Arial', 'b', 9);
            $pdf->SetX(50);
            $pdf->Cell(60, 10, "Evidencia de aprendizaje", 1, 0, 'C', 0);
            $pdf->Cell(13, 10, "%", 1, 0, 'C', 0);
            $pdf->Cell(60, 5, "Indicador de alcance", 1, 0, 'C', 0);
            $pdf->Cell(60, 10, utf8_decode("Instrumentos de evaluación"), 1, 1, 'C', 0);
            $pdf->SetXY(123, 49);
            $pdf->Cell(10, 5, "A", 1, 0, 'C', 0);
            $pdf->Cell(10, 5, "B", 1, 0, 'C', 0);
            $pdf->Cell(10, 5, "C", 1, 0, 'C', 0);
            $pdf->Cell(10, 5, "D", 1, 0, 'C', 0);
            $pdf->Cell(10, 5, "E", 1, 0, 'C', 0);
            $pdf->Cell(10, 5, "F", 1, 1, 'C', 0);

            $pdf->SetWidths(array(60, 13, 10, 10, 10, 10, 10, 10, 60));
            $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));

            while($rowMatriz = mysqli_fetch_array($resultMatriz)){
                $pdf->SetX(50);
                $pdf->Row(array(
                    utf8_decode(utf8_decode($rowMatriz["evidencia"])),
                    $rowMatriz["porcentaje"],
                    $rowMatriz["a"] == 1 ? "X" : "",
                    $rowMatriz["b"] == 1 ? "X" : "",
                    $rowMatriz["c"] == 1 ? "X" : "",
                    $rowMatriz["d"] == 1 ? "X" : "",
                    $rowMatriz["e"] == 1 ? "X" : "",
                    $rowMatriz["f"] == 1 ? "X" : "",
                    utf8_decode(utf8_decode($rowMatriz["instrumentos"])),
                ));

            }//fin while matriz evaluacion
            $pdf->AddPage();
        }//fin if matriz evaluacion


    }//fin while
}//fin if

// ------------------------------------------------------------------ Fuentes de información y apoyos didácticos ------------------------------------------------------------------
$pdf->SetX(25);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(97, 10, utf8_decode('4. Fuentes de información y apoyos didácticos.'), 0, 1, 'L', 0);

$pdf->SetX(100);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(97, 10, utf8_decode('Fuentes de información.'), 0, 0, 'L', 0);

$pdf->SetX(220);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(97, 10, utf8_decode('Apoyos didácticos.'), 0, 1, 'L', 0);

$pdf->SetWidths(array(200, 45));
$pdf->SetAligns(array('L', 'L'));

$pdf->SetFont('Arial', '', 9);
$pdf->Row(array(
    utf8_decode($fuentes)."\n".utf8_decode($fuentesUsuario),
    utf8_decode($apoyosDidacticos)."\n".utf8_decode($apoyosDidacticosUsuario)
));

$pdf->AddPage();
// ------------------------------------------------------------------ Fuentes de información y apoyos didácticos ------------------------------------------------------------------
$pdf->SetX(25);
$pdf->SetFont('Arial', 'B', $tamanioFuente);
$pdf->Cell(97, 10, utf8_decode('5. Calendarización de evaluación en semanas.'), 0, 1, 'L', 0);

//tabla calendarizacion
$pdf->SetWidths(array(20, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15));
$pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
//header
$pdf->SetFont('Arial', '', 11);
$pdf->Row(array(
    "Semana",
    '1',
    '2',
    '3',
    '4',
    '5',
    '6',
    '7',
    '8',
    '9',
    '10',
    '11',
    '12',
    '13',
    '14',
    '15',
    '16'
));

//For que se repetira 3 veces, esto debido a que son 3 renglones (TP, TR, SD)
for($i = 0 ; $i < 3 ; $i++){

    
    $semanas = ["", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""];

    $tipo = "";

    if($i == 0){
        $tipo = "TP";
    } else if($i == 1){
        $tipo = "TR";
    } else if($i == 2){
        $tipo = "SD";
    }

    for($numSemana = 1 ; $numSemana <= $noSemanas ; $numSemana ++){

        //------------------------Query para el contenido de las semanas------------------------
        $querySemanaN = "SELECT producto FROM calendarizaciones WHERE idPlaneacion = $idPlaneacion AND idUsuario = $idUsuario AND tipo = '$tipo' AND semana = $numSemana";
        $resultSemanaN = mysqli_query($conn, $querySemanaN);

        if($numSemana == $semanaSeguimientoDepartamental && $i == 2){
            $semanas[$numSemana] .= "SD\n";
        }

        //Para leer los registros correspondientes a tal numero de la semana
        while($rowSemanaN = mysqli_fetch_array($resultSemanaN)){
            $semanas[$numSemana] .= $rowSemanaN["producto"]."\n";
        }//fin while

    }//fin for

    $semanas[0] = $tipo;

    $pdf->Row($semanas);

}//fin for

$pdf->SetX(70);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(97, 10, "TP = Tiempo Planeado.  TR = Tiempo Real   SD = Seguimiento Departamental", 0, 1, 'L', 0);

$pdf->SetX(40);
$pdf->Cell(97, 10, utf8_decode("ED = Evaluación diagnóstica.  EFn = Evaluación formativa (competencia específica n).  ES = Evaluación sumativa"), 0, 1, 'L', 0);

$pdf->SetX(190);
$pdf->Cell(97, 20, utf8_decode("Fecha de elaboración: ". $fechaHoy), 0, 1, 'L', 0);

//Firma docente
$pdf->Line(35, 160, 130, 160);
$pdf->SetXY(50, 155);
$pdf->Cell(97, 20, "Nombre y firma del (de la) docente.", 0, 1, 'L', 0);

//Firma jefe de depto
$pdf->Line(165, 160, 260, 160);
$pdf->SetXY(175, 162);
$pdf->MultiCell(80, 5, utf8_decode("Nombre y firma del (de la) Jefe(a) de\n Departamento Académico."), 0, 'C', 0);

$pdf->AliasNbPages();
$pdf->Output('I',''.$datosDocente[0].'_'.$nombreMateria.'_'.$periodo.'.pdf');

?>