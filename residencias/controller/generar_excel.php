<?php

if(!isset($_SESSION['user'])){
    header('Location: login.php');
}

require 'excel/vendor/autoload.php';
require 'includes/db.php';

use PhpOffice\PhpSpreadsheet\{Spreadsheet, IOFactory};

$query = 'SELECT idFormulario, noControl, paternoAlumno, maternoAlumno, nombresAlumno, carrera, producto, nombreProyecto, fecha FROM formularios';
$result = mysqli_query($conn, $query);

$excel = new Spreadsheet();
$hojaActiva = $excel->getActiveSheet();
$hojaActiva->setTitle('Reporte Formatos');

$hojaActiva->setCellValue('A1', 'ID del Formulario');
$hojaActiva->setCellValue('B1', 'No. Control');
$hojaActiva->setCellValue('C1', 'Ap. Paterno');
$hojaActiva->setCellValue('D1', 'Ap. Materno');
$hojaActiva->setCellValue('E1', 'Nombre(s)');
$hojaActiva->setCellValue('F1', 'Carrera');
$hojaActiva->setCellValue('G1', 'Producto');
$hojaActiva->setCellValue('H1', 'nombreProyecto');
$hojaActiva->setCellValue('I1', 'Fecha');

$fila = 2;

while($rows = $result->fetch_assoc()){
    $hojaActiva->setCellValue('A'.$fila, $rows['idFormulario']);
    $hojaActiva->setCellValue('B'.$fila, $rows['noControl']);
    $hojaActiva->setCellValue('C'.$fila, $rows['paternoAlumno']);
    $hojaActiva->setCellValue('D'.$fila, $rows['maternoAlumno']);
    $hojaActiva->setCellValue('E'.$fila, $rows['nombresAlumno']);
    $hojaActiva->setCellValue('F'.$fila, $rows['carrera']);
    $hojaActiva->setCellValue('G'.$fila, $rows['producto']);
    $hojaActiva->setCellValue('H'.$fila, $rows['nombreProyecto']);
    $hojaActiva->setCellValue('I'.$fila, $rows['fecha']);
    $fila++;
}

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="ReporteFormatos.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;

header("Location: ../../redirection.php?op=index");
?>