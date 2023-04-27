<?php

include("../../includes/db.php");
require_once("../../tcpdf/examples/tcpdf_include.php");
include("plantilla_tcpdf.php");
include("../../includes/utilidades.php");

$util = new Utilidades();

date_default_timezone_set('America/Los_Angeles');

$idPlaneacion = base64_decode($_GET['id']);
$idUsuario = base64_decode($_GET['idu']);

$fechaHoy = date("d") . "/" . date("m") . "/" . date("Y");

//-------------------------Query para la firma-------------------------

$queryFirma = "SELECT firma FROM usuarios WHERE idUsuario = $idUsuario";
$resultFirma = mysqli_query($conn, $queryFirma);
$rowFirma = mysqli_fetch_array($resultFirma);

//-------------------------Query para jefe de depto-------------------------
$query = "SELECT jefeDivisionEstudiosProf, jefeDeptoIngInd FROM encargados";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_array($result);
$jefeDepto = $row['jefeDeptoIngInd'];

//-------------------------Query para la planeacion-------------------------
$queryPlaneacion = "SELECT idMateria, carreras.nombre as 'carrera', nombreDocente, grupo, periodo, aula, fuentes, apoyosDidacticos, noSemanas FROM planeaciondidactica, carreras 
WHERE planeaciondidactica.idCarrera = carreras.idCarrera AND idPlaneacion = $idPlaneacion";
$resultPlaneacion = mysqli_query($conn, $queryPlaneacion);
$rowPlaneacion = mysqli_fetch_array($resultPlaneacion);

$nombreCarrera = $rowPlaneacion['carrera'];
$nombreDocente = mb_strtoupper($rowPlaneacion['nombreDocente']);
$datosDocente = explode(" ", $nombreDocente);
$grupo = $rowPlaneacion['grupo'] == null? "SIN ASIGNAR" : strtoupper($rowPlaneacion['grupo']);
$aula = $rowPlaneacion['aula'] == null? "SIN ASIGNAR" : strtoupper($rowPlaneacion['aula']);
$periodo = strtoupper($rowPlaneacion['periodo']);

$fuentesUsuario = $rowPlaneacion['fuentes'] == null? "" : utf8_decode($rowPlaneacion['fuentes']);

$apoyosDidacticosUsuario = $rowPlaneacion['apoyosDidacticos'] == null? "" : utf8_decode($rowPlaneacion['apoyosDidacticos']);

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

$apoyosDidacticos = $rowMateria['apoyosDidacticos'] == null? "" : utf8_decode($rowMateria['apoyosDidacticos']);

//-------------------------Query para los temas-------------------------
$queryTemas = "SELECT idTema, noTema, nombre, temasSubtemas, actsAprendizaje, desCompGenericas FROM temas 
WHERE idMateria = $idMateria ORDER BY noTema ASC";
$resultTemas = mysqli_query($conn, $queryTemas);


// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetTitle(mb_strtoupper($nombreMateria,'utf-8'));

// set document information
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

$pdf->SetFont('helvetica', 'b', 12);

// add a page
$pdf->AddPage();
$pdf->SetMargins(25, 40, 25);

$leftMargin = 25;

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

//texto del header
$pdf->SetXY(95,40);
$pdf->Cell(100, 10, 'INSTITUTO TECNOLÓGICO DE HERMOSILLO', 0, 1, 'C', 0);
$pdf->SetXY(95,45);
$pdf->Cell(100, 10, 'SUBDIRECCION ACADEMICA', 0, 1, 'C', 0);
$pdf->SetXY(95,50);
$pdf->Cell(100, 10, 'DEPARTAMENTO DE INGENIERÍA INDUSTRIAL', 0, 1, 'C', 0);
$pdf->SetXY(95,55);
$pdf->Cell(100, 10, 'PLANEACIÓN E INSTRUMENTACIÓN DIDÁCTICA', 0, 1, 'C', 0);
$pdf->SetXY(95,60);
$pdf->Cell(100, 10, 'PARA LA FORMACIÓN Y DESARROLLO DE COMPETENCIAS DE '. strtoupper($periodo), 0, 1, 'C', 0);

$tamanioFuente = 12;

//nombre asignatura
$pdf->SetFont('helvetica', '', $tamanioFuente);
$pdf->SetXY($leftMargin,70);
$pdf->Cell(63, 10, 'NOMBRE DE LA ASIGNATURA: ', 0, 0, 'L', 0);
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->Cell(100, 10, mb_strtoupper($nombreMateria,'utf-8'), 0, 1, 'L', 0);

//carrera
$pdf->SetFont('helvetica', '', $tamanioFuente);
$pdf->SetXY($leftMargin,76);
$pdf->Cell(23, 10, 'CARRERA:', 0, 0, 'L', 0);
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->Cell(100, 10, mb_strtoupper($nombreCarrera,'utf-8'), 0, 1, 'L', 0);

//clave
$pdf->SetFont('helvetica', '', $tamanioFuente);
$pdf->SetXY($leftMargin,82);
$pdf->Cell(17, 10, 'CLAVE: ', 0, 0, 'L', 0);
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->Cell(85, 10, strtoupper($claveMateria), 0, 0, 'L', 0);

//Grupo
$pdf->SetFont('helvetica', '', $tamanioFuente);
$pdf->Cell(17, 10, 'GRUPO: ', 0, 0, 'L', 0);
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->Cell(40, 10, strtoupper($grupo), 0, 0, 'L', 0);

//Aula
$pdf->SetFont('helvetica', '', $tamanioFuente);
$pdf->Cell(14, 10, 'AULA: ', 0, 0, 'L', 0);
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->Cell(35, 10, strtoupper($aula), 0, 1, 'L', 0);

//docente
$pdf->SetFont('helvetica', '', $tamanioFuente);
$pdf->SetXY($leftMargin,87);
$pdf->Cell(27, 10, 'PROFESOR: ', 0, 0, 'L', 0);
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->Cell(85, 10, mb_strtoupper($nombreDocente), 0, 0, 'L', 0);

//satca
$pdf->SetFont('helvetica', '', $tamanioFuente);
$pdf->SetXY($leftMargin,93);
$pdf->Cell(106, 10, utf8_decode('HORAS TEORICAS-HORAS PRACTICAS-CREDITOS: '), 0, 0, 'L', 0);
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->Cell(85, 10, strtoupper($satca), 0, 1, 'L', 0);

$tamanioFuente = 14;

//Caracterizacion
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->SetXY($leftMargin,103);
$pdf->Cell(97, 10, '1. Caracterización de la asignatura.', 0, 1, 'L', 0);

$pdf->SetFont('helvetica', '', 12);
$pdf->SetX($leftMargin);
$pdf->MultiCell(245, 7, $caracterizacion, 1, 'L', 0);

//Intención didáctica.
$pdf->SetX(25);
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->Cell(97, 10, '2. Intención didáctica.', 0, 1, 'L', 0);

$pdf->SetFont('helvetica', '', 12);
$pdf->SetX(25);
$pdf->MultiCell(245, 7, $intencionDidactica, 1, 'L', 0);

//Competencias de la asignatura.
//Competencias previas.
$pdf->SetX(25);
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->Cell(97, 10, '3. Competencias de la asignatura', 0, 1, 'L', 0);
$pdf->SetX(28);
$pdf->Cell(97, 10, '3.1 Competencias previas.', 0, 1, 'L', 0);

$pdf->SetFont('helvetica', '', 12);
$pdf->SetX(25);
$pdf->MultiCell(245, 7, $competenciasPrevias, 1, 'L', 0);

//Competencias genericas.
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->SetX(28);
$pdf->Cell(97, 10, '3.2 Competencias genéricas.', 0, 1, 'L', 0);

$pdf->SetFont('helvetica', '', 12);
$pdf->SetX(25);
$pdf->MultiCell(245, 7, $competenciasGenericas, 1, 'L', 0);

//Competencias especificas.
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->SetX(28);
$pdf->Cell(97, 10, '3.3 Competencias específicas de la asignatura.', 0, 1, 'L', 0);

$pdf->SetFont('helvetica', '', 12);
$pdf->SetX(25);
$pdf->MultiCell(245, 7, $competenciasEspecificas, 1, 'L', 0);



//----------------------------------------------- TEMAS ----------------------------------------------
//Analisis por competencias especificas
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->SetX(28);
$pdf->Cell(97, 10, '3.4 Análisis por competencias específicas (Tema).', 0, 1, 'L', 0);

if($resultTemas->num_rows > 0){ 

	while($row = mysqli_fetch_array($resultTemas)){

		$idTemaLocal = $row["idTema"];
        $noTema = $row["noTema"];
        $nombre = utf8_decode($row["nombre"]);
        $temasSubtemas = utf8_decode($row["temasSubtemas"]);

        $actsAprendizaje = utf8_decode($row["actsAprendizaje"]);

        $desCompGenericas = utf8_decode($row["desCompGenericas"]);

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

            $actsEnsenanza = $hayInfo ? utf8_decode($rowInfoTema["actsEnsenanza"]) : "S.D";

            $apOpUno = $rowInfoTema["apOpUno"] == null ? "Sin definir" : utf8_decode($rowInfoTema["apOpUno"]);
            $apOpDos = utf8_decode($rowInfoTema["apOpDos"]);

            $F_inicial = $hayInfo ?  $fechaInicio[2]."-".$fechaInicio[1] : "";
            $F_fin = $hayInfo ?  $fechaFin[2]."-".$fechaFin[1] : "";
            
        } else {
            $fechaInicio = "";
            $fechaFin = "";

            $actsEnsenanza = "";

            $apOpUno = "";
            $apOpDos = "";

            $F_inicial = "";
            $F_fin = "";
        }

			$pdf->SetX(25);
			//numero del tema
			$pdf->SetFont('helvetica', '', 11);
			$pdf->Cell(20, 10, "Tema No. :", 0, 0, 'L', 0);

			$pdf->SetFont('helvetica', 'b', 11);
			$pdf->Cell(15, 10, $noTema . ".", 0, 0, 'L', 0);
			$pdf->SetFont('helvetica', 'b', 11);

			//nombre del tema
			$pdf->SetFont('helvetica', '', 11);
			$pdf->Cell(17, 10, "Nombre:", 0, 0, 'L', 0);

			$pdf->SetFont('helvetica', 'b', 11);
			$pdf->Cell(10, 10, $nombre . ".", 0, 1, 'L', 0);

            $temasHTML =  '<table border="1" cellpadding="2">
                    <tr style="font-size:9px; text-align:center;">
                        <th style = "width:130px; background-color: #ded9c3;">Temas y subtemas para desarrollar la competencia espeífica</th>
                        <th style = "width:130px; background-color: #ded9c3;">Actividades de aprendizaje</th>
                        <th style = "width:130px; background-color: #ded9c3;">Actividades de enseñanza</th>
                        <th style = "width:120px; background-color: #ded9c3;">Desarrollo de competencias genéricas</th>
                        <th style = "width:45px; background-color: #ded9c3;">Horas teórico-prácticas</th>
                        <th style = "width:40px; background-color: #ded9c3;">F. Inicial (dd/mm)</th>
                        <th style = "width:40px; background-color: #ded9c3;">F. Final (dd/mm)</th>
                        <th style = "width:30px; background-color: #ded9c3;" >PAP 1 OP (%)</th>
                        <th style = "width:30px; background-color: #ded9c3;">PAP 2 OP (%)</th>
                    </tr>

                <tbody>
                    <tr style="font-size:9px; text-align:justify; font-weight: 0;">
                        <td style = "width:130px; font-weight: normal;">'. $temasSubtemas .'</td>
                        <td style = "width:130px; font-weight: normal;">'. $actsAprendizaje .'</td>
                        <td style = "width:130px; font-weight: normal;">'. $actsEnsenanza .'</td>
                        <td style = "width:120px; font-weight: normal;">'. $desCompGenericas .'</td>
                        <td style = "width:45px; font-weight: normal;">'. $satca .'</td>
                        <td style = "width:40px; font-weight: normal;">'. $F_inicial.'</td>
                        <td style = "width:40px; font-weight: normal;">'. $F_fin.'</td>
                        <td style = "width:30px; font-weight: normal;" >'. $apOpUno .'</td>
                        <td style = "width:30px; font-weight: normal;">'. $apOpDos .'</td>
                    </tr>
                </tbody>

            </table>';

            // Print text using writeHTMLCell()
            $pdf->writeHTMLCell(0, 0, '', '', $temasHTML, 0, 1, 0, true, '', true);
            $pdf->AddPage();

            //Query para la matriz de evaluacion
        $queryMatrizEval = "SELECT idCriterio, evidencia, porcentaje, a, b, c, d, e, f, instrumentos FROM matrizevaluacion
        WHERE idTema = $idTemaLocal AND idUsuario = $idUsuario";
        $resultMatriz = mysqli_query($conn, $queryMatrizEval);

        $pdf->SetX(125);
        $pdf->Cell(10, 10, "Matriz de evaluación.", 0, 1, 'L', 0);

        if($resultMatriz->num_rows > 0){

            $pdf->SetX(50);
            $matrizHTML =  '<table border="1" cellpadding="2">
                    <tr style="font-size:9px; text-align:center;">
                        <th rowspan = "2" style = "width:150px; background-color: #ded9c3;">Evidencia de aprendizaje</th>
                        <th rowspan = "2" style = "width:50px; background-color: #ded9c3;">%</th>
                        <th style = "width:200px; background-color: #ded9c3;">Indicador de alcance</th>
                        <th rowspan = "2" style = "width:150px; background-color: #ded9c3;">Instrumentos de evaluación.</th>
                    </tr>

                    <tr>
                        <th width = "33px" align="center" style = "background-color: #ded9c3;">A</th>
                        <th width = "33px" align="center" style = "background-color: #ded9c3;">B</th>
                        <th width = "33px" align="center" style = "background-color: #ded9c3;">C</th>
                        <th width = "33px" align="center" style = "background-color: #ded9c3;">D</th>
                        <th width = "34px" align="center" style = "background-color: #ded9c3;">E</th>
                        <th width = "34px" align="center" style = "background-color: #ded9c3;">F</th>
                    </tr>';

            while($rowMatriz = mysqli_fetch_array($resultMatriz)){
                $matrizHTML.=
                '
                <tbody>
                        <tr style="font-size:9px; text-align:justify; font-weight: 0;">
                        <td width = "150px" align="center" style = "font-weight: normal;">'. utf8_decode($rowMatriz["evidencia"]) .'</td>
                        <td width = "50px" align="center" style = "font-weight: normal;">'. $rowMatriz["porcentaje"] .'</td>
                            <td width = "33px" align="center" style = "font-weight: normal;">'. ($rowMatriz["a"] == 1? "X" : "") .'</td>
                            <td width = "33px" align="center" style = "font-weight: normal;">'. ($rowMatriz["b"] == 1? "X" : "") .'</td>
                            <td width = "33px" align="center" style = "font-weight: normal;">'. ($rowMatriz["c"] == 1? "X" : "") .'</td>
                            <td width = "33px" align="center" style = "font-weight: normal;">'. ($rowMatriz["d"] == 1? "X" : "") .'</td>
                            <td width = "34px" align="center" style = "font-weight: normal;">'. ($rowMatriz["e"] == 1? "X" : "") .'</td>
                            <td width = "34px" align="center" style = "font-weight: normal;">'. ($rowMatriz["f"] == 1? "X" : "") .'</td>
                            <td width = "150px" align="center" style = "font-weight: normal;">'. utf8_decode($rowMatriz["instrumentos"]) .'</td>
                        </tr>
                    </tbody>
                ';
            }

            $matrizHTML.='</table>';

            // Print text using writeHTMLCell()
            $pdf->writeHTMLCell(0, 0, '', '', $matrizHTML, 0, 1, 0, true, '', true);
        } else {
            $pdf->SetX(115);
            $pdf->Cell(10, 10, "Tema sin matriz de evaluación.", 0, 1, 'L', 0);
        }//fin if matriz evaluacion

        $pdf->AddPage();

	}//fin while temas

}//fin if temas

//-----------------------------------------------FUENTES Y APOYOS ----------------------------------------------

$pdf->SetX(25);
    $pdf->SetFont('helvetica', 'B', $tamanioFuente);
    $pdf->Cell(97, 10, '4. Fuentes de información y apoyos didácticos.', 0, 1, 'L', 0);

    $pdf->SetX(100);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(97, 10, 'Fuentes de información.', 0, 0, 'L', 0);

    $pdf->SetX(220);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(97, 10, 'Apoyos didácticos.', 0, 1, 'L', 0);

    $fuentesHTML =  
    '<table border="1" cellpadding="2">
        <tr style="font-size:9px; text-align:justify;">
            <th style = "width:500px; font-weight: normal; font-size:12px;">'. $fuentes .'<br />'. $fuentesUsuario .'</th>
            <th style = "width:200px; font-weight: normal;">'. $apoyosDidacticos .'<br />'. $apoyosDidacticosUsuario.'</th>
        </tr>
    </table>';

        // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $fuentesHTML, 0, 1, 0, true, '', true);

    $pdf->AddPage();

//----------------------------------------------- CALENDARIZACION ----------------------------------------------
$pdf->SetX(25);
$pdf->SetFont('helvetica', 'B', $tamanioFuente);
$pdf->Cell(97, 10, '5. Calendarización de evaluación en semanas.', 0, 1, 'L', 0);
$pdf->SetFont('helvetica', '', 11);

$calendarizacionHTML =  
    '<table border="1" cellpadding="2">
        <tr style="font-size:12px;">
            <th width = "60"; style = "background-color: #ded9c3;" align = "center">Semana</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">1</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">2</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">3</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">4</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">5</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">6</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">7</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">8</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">9</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">10</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">11</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">12</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">13</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">14</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">15</th>
            <th width = "40"; style = "background-color: #ded9c3;" align = "center">16</th>
        </tr>';

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

        $calendarizacionHTML .= "<tr>";

        for($numSemana = 1 ; $numSemana <= $noSemanas ; $numSemana ++){

            //------------------------Query para el contenido de las semanas------------------------
            $querySemanaN = "SELECT producto FROM calendarizaciones WHERE idPlaneacion = $idPlaneacion AND idUsuario = $idUsuario AND tipo = '$tipo' AND semana = $numSemana";
            $resultSemanaN = mysqli_query($conn, $querySemanaN);

            if($numSemana == $semanaSeguimientoDepartamental && $i == 2){
                $semanas[$numSemana] .= "SD<br />";
            }

            //Para leer los registros correspondientes a tal numero de la semana
            while($rowSemanaN = mysqli_fetch_array($resultSemanaN)){
                $semanas[$numSemana] .= $rowSemanaN["producto"]."<br />";
            }//fin while

            $semanas[0] = $tipo;

        } //fin for

        $contador = 0;
        foreach($semanas as $semanaContenido){
            if($contador == 0){
                $calendarizacionHTML .= "<td width = '60' align = 'center'>" . $semanaContenido . "</td>";
                $contador++;
            }
             else {
                $calendarizacionHTML .= "<td width = '40' align = 'center'>" . $semanaContenido . "</td>";
                $contador++;
             }
        }

        $calendarizacionHTML .= "</tr>";

    }//fin for

    $calendarizacionHTML .= '</table>';

$pdf->SetX(23);
$pdf->writeHTMLCell(0, 0, '', '', $calendarizacionHTML, 0, 1, 0, true, '', true);

$pdf->SetX(70);
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(97, 10, "TP = Tiempo Planeado.  TR = Tiempo Real   SD = Seguimiento Departamental", 0, 1, 'L', 0);

$pdf->SetX(40);
$pdf->Cell(97, 10, "ED = Evaluación diagnóstica.  EFn = Evaluación formativa (competencia específica n).  ES = Evaluación sumativa", 0, 1, 'L', 0);

$pdf->SetX(190);
$pdf->Cell(97, 20, "Fecha de elaboración: ". $fechaHoy, 0, 1, 'L', 0);

$pdf->Line(35, 160, 130, 160);
$pdf->SetXY(50, 155);
$pdf->Cell(97, 20, "Nombre y firma del (de la) docente.", 0, 1, 'L', 0);

if($rowFirma["firma"] != null){
    $rutaFirma = "../../residencias/".$rowFirma["firma"];
    $pdf->Image($rutaFirma, 60, 138, 40, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
} else {
    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->SetXY(35, 153);
    $pdf->MultiCell(90, 5, $nombreDocente, 0, 'C', 0);
}

$pdf->SetFont('helvetica', '', 12);

//Firma jefe de depto
$pdf->Line(165, 160, 260, 160);
$pdf->SetXY(175, 162);
$pdf->MultiCell(80, 5, "Nombre y firma del (de la) Jefe(a) de\n Departamento Académico.", 0, 'C', 0);

$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetXY(175, 154);
$pdf->MultiCell(80, 5, utf8_decode(mb_strtoupper($jefeDepto)), 0, 'C', 0);

$pdf->Output($datosDocente[0].'_'.$nombreMateria.'_'.$periodo.'.pdf', 'I');

?>