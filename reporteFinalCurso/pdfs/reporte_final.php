<?php

include 'plantilla.php';
require '../../includes/db.php';

$idReporte = base64_decode($_GET['id']);
$idUsuario = base64_decode($_GET['idUs']);
$meses = array(
    "01" => "enero",
    "02" => "febrero",
    "03" => "marzo",
    "04" => "abril",
    "05" => "mayo",
    "06" => "junio",
    "07" => "julio",
    "08" => "agosto",
    "09" => "septiembre",
    "10" => "octubre",
    "11" => "noviembre",
    "12" => "diciembre",
);

//-------------------------Query para la firma-------------------------

$queryFirma = "SELECT firma FROM usuarios WHERE idUsuario = $idUsuario";
$resultFirma = mysqli_query($conn, $queryFirma);
$rowFirma = mysqli_fetch_array($resultFirma);

//-------------------------Query para jefe de depto-------------------------
$query = "SELECT jefeDivisionEstudiosProf, jefeDeptoIngInd FROM encargados";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_array($result);
$jefeDepto = $row['jefeDeptoIngInd'];

//-------------------------------------------------

$queryReporte = "SELECT idReporte, departamento, inicioSemestre, finalSemestre, nombreDocente, gruposAtendidos, asignaturasDiferentes
     FROM reportefinal WHERE idReporte = $idReporte AND idUsuario = $idUsuario";
$resultReporte = mysqli_query($conn, $queryReporte);
$rowReporte = mysqli_fetch_array($resultReporte);

$fechaInicial = explode("-", $rowReporte['inicioSemestre']); //Primero anio, luego mes y a lo ultimo el dia
$fechaFinal = explode("-", $rowReporte['finalSemestre']); //Primero anio, luego mes y a lo ultimo el dia

$queryAsignProgs = "SELECT idAsignPrograma, asignatura, carrera, totalEstudiantes, primeraOp, segundaOp, totalAcreditados, 
    porcentajeAcreditados, estudiantesNoAcreditados, porcentajeNoAcreditados, desertores, porcentajeDesertores FROM asignprogramas WHERE idReporte = $idReporte";
$resultAsignaturas = mysqli_query($conn, $queryAsignProgs);

$queryTotal = "SELECT SUM(totalEstudiantes) as 'totalEst', SUM(primeraOp) as 'primeraOp', SUM(segundaOp) as 'segundaOp', SUM(totalAcreditados) as 'totalAcr', 
SUM(estudiantesNoAcreditados) as 'noAcr', SUM(desertores) as 'desertores' FROM asignprogramas WHERE idReporte = $idReporte";
$resultTotal = mysqli_query($conn, $queryTotal);
$rowTotal = mysqli_fetch_array($resultTotal);


$totalEst = $rowTotal["totalEst"] == 0 ? 1 : $rowTotal["totalEst"];

$porcentajeAcreditados = round(($rowTotal['totalAcr']*100)/$totalEst, 2);
$porcentajeNoAcreditados = 100-$porcentajeAcreditados;
$porcentajeDesertores = round(($rowTotal['desertores']*100)/$totalEst, 2);

$pdf = new PDF('P', 'mm');
$pdf->SetTitle("Reporte final del curso");

$pdf->AddPage();
$pdf->SetXY(55, 40);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(100, 10, utf8_decode('INSTITUTO TECNOLÓGICO DE HERMOSILLO'), 0, 1, 'C', 0);
$pdf->SetXY(55, 50);
$pdf->Cell(100, 10, utf8_decode('SUBDIRECCIÓN ACADÉMICA'), 0, 1, 'C', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->SetXY(12, 63);
$pdf->Cell(150, 10, utf8_decode('DEPARTAMENTO DE: '. strtoupper($rowReporte['departamento'])), 0, 1, 'L', 0);
$pdf->SetXY(7, 68);
$pdf->Cell(70, 10, utf8_decode('REPORTE FINAL DEL SEMESTRE: '), 0, 1, 'C', 0);
$pdf->SetXY(71, 68);
$pdf->Cell(130, 10, utf8_decode(strtoupper($fechaInicial[2]." de ". $meses[$fechaInicial[1]]." del ".$fechaInicial[0]. " al " . $fechaFinal[2]." de ". $meses[$fechaFinal[1]]." del ".$fechaFinal[0])), 0, 1, 'L', 0);
$pdf->SetXY(12, 75);
$pdf->Cell(30, 10, utf8_decode('PROFESOR(A): '. strtoupper($rowReporte["nombreDocente"])), 0, 1, 'L', 0);
$pdf->SetXY(12, 82);
$pdf->Cell(70, 10, utf8_decode('No. DE GRUPOS ATENDIDOS: '. $rowReporte['gruposAtendidos']), 0, 1, 'L', 0);
$pdf->SetXY(100, 82);
$pdf->Cell(80, 10, utf8_decode('No. DE ASIGNATURAS DIFERENTES: '. $rowReporte['asignaturasDiferentes']), 0, 1, 'L', 0);
$pdf->SetXY(12, 100);
$pdf->Cell(80, 10, utf8_decode('Asignaturas programas 2009-2010'), 0, 1, 'L', 0);
$pdf->SetXY(12, 110);
$pdf->SetFillColor(222, 217, 195);
$pdf->Cell(60, 12, 'ASIGNATURA', 1, 0, 'C', true);
$pdf->Cell(40, 12, 'CARRERA', 1, 0, 'C', true);
$pdf->Cell(10, 12, 'A', 1, 0, 'C', true);
$pdf->Cell(20, 6, 'B1', 1, 1, 'C', true);
$pdf->SetX(122);
$pdf->Cell(10, 6, 'E1O', 1, 0, 'C', true);
$pdf->Cell(10, 6, 'E2O', 1, 0, 'C', true);
$pdf->SetXY(142,110);
$pdf->Cell(10, 12, 'C', 1, 0, 'C', true);
$pdf->Cell(10, 12, 'D', 1, 0, 'C', true);
$pdf->Cell(10, 12, 'E', 1, 0, 'C', true);
$pdf->Cell(10, 12, 'F', 1, 0, 'C', true);
$pdf->Cell(10, 12, 'G', 1, 1, 'C', true);
$pdf->SetFont('Arial', '', 8);

$posicionX = 12;
$posicionY = 122;

$pdf->SetWidths(array(60, 40, 10, 10, 10, 10, 10, 10, 10, 10));
$pdf->SetAligns(array('L', 'L', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
$pdf->SetX(12);

while( $rowAsign = mysqli_fetch_array($resultAsignaturas) ){
    $pdf->SetX(12);
    $pdf->Row(array(
        utf8_decode(utf8_decode($rowAsign['asignatura'])),
        utf8_decode($rowAsign['carrera']),
        $rowAsign['totalEstudiantes'],
        $rowAsign['primeraOp'],
        $rowAsign['segundaOp'],
        $rowAsign['porcentajeAcreditados'],
        $rowAsign['estudiantesNoAcreditados'],
        $rowAsign['porcentajeNoAcreditados'],
        $rowAsign['desertores'],
        $rowAsign['porcentajeDesertores']
    ));

    $posicionY = $posicionY + 12;

}//fin while

    $pdf->SetX(12);
    $pdf->SetWidths(array(60, 40, 10, 10, 10, 10, 10, 10, 10, 10));
    $pdf->SetAligns(array('L', 'R', 'C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));
    $pdf->Row(array(
        '',
        'TOTALES',
        $rowTotal['totalEst'],
        $rowTotal['primeraOp'],
        $rowTotal['segundaOp'],
        $porcentajeAcreditados,
        $rowTotal['noAcr'],
        $porcentajeNoAcreditados,
        $rowTotal['desertores'],
        $porcentajeDesertores
    ));

    $posicionY = $posicionY + 6;

    $pdf->Image('../img/columnas.jpg', 13, $posicionY, 130);

    $pdf->SetFont('helvetica', '', 11);

    //Firma docente
    $pdf->Line(15, 260, 95, 260);
    $pdf->SetXY(25, 260);
    $pdf->Cell(70, 10, "Nombre y firma del (de la) docente.", 0, 1, 'L', 0);

    //firma del docente
    if($rowFirma["firma"] != null){
        $rutaFirma = "../../residencias/".$rowFirma["firma"];
        $pdf->Image($rutaFirma, 25, 240, 40, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    } else {
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->SetXY(15, 253);
        $pdf->MultiCell(80, 5, utf8_decode(mb_strtoupper($rowReporte["nombreDocente"])), 0, 'C', 0);
    }

    $pdf->SetFont('helvetica', '', 11);

    //Firma del jefe de depto
    $pdf->Line(115, 260, 195, 260);
    $pdf->SetXY(115, 262);
    $pdf->MultiCell(80, 5, utf8_decode("Nombre y firma del (de la) Jefe(a) de\n Departamento Académico."), 0, 'C', 0);

    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(115, 255);
    $pdf->MultiCell(80, 5, utf8_decode(mb_strtoupper($jefeDepto)), 0, 'C', 0);


$pdf->Output('I','reportefinal'.$rowReporte['idReporte'].'.pdf');

?>