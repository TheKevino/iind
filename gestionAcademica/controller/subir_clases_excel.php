<?php

require '../../excel/vendor/autoload.php';
require '../../includes/db.php';

use PhpOffice\PhpSpreadsheet\{ Spreadsheet, IOFactory };

$archivo = basename($_FILES["file"]["name"]);
$directorio = "../excels/";

if(move_uploaded_file($_FILES["file"]["tmp_name"], $directorio.$archivo)){
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $excel = $reader->load($directorio.$archivo);
    $excel->setActiveSheetIndex(0);
    $numRows = $excel->setActiveSheetIndex(0)->getHighestRow();
    
    for($i = 1; $i <= $numRows ; $i++){
        $clave = $excel->getActiveSheet()->getCell('A'.$i);
        $grupo = $excel->getActiveSheet()->getCell('B'.$i);
        $maestro = $excel->getActiveSheet()->getCell('C'.$i);
        $nombreCompleto = explode(" ", ucfirst($maestro));

        /*

        //-----------------------CONSULTAR MAESTRO ----------------------------
        if(count($nombreCompleto) == 4){
            $nombres = $nombreCompleto[2]." ".$nombreCompleto[3]
            $query = "SELECT idUsuario FROM usuarios WHERE paterno = $nombreCompleto[0] AND materno = $nombreCompleto[1] 
                AND nombres = $nombres";
        } else {
            $query = "SELECT idUsuario FROM usuarios WHERE paterno = $nombreCompleto[0] AND materno = $nombreCompleto[1] 
                AND nombres = $nombreCompleto[2]";
        }

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        $idMaestro = $row['idUsuario'];
        
        */

        //-----------------------CONSULTAR GRUPO ----------------------------
        $nuevaClave = substr_replace($clave, '-', 3, 0);
        /*$query = "SELECT idMateria FROM usuarios WHERE paterno = $nombreCompleto[0] AND materno = $nombreCompleto[1] 
                AND nombres = $nombres";
                */
        echo $nuevaClave . "\n";

    }//fin for

}

/*
echo '
<table border="1">
    <tr>
        <td>Clave</td>
        <td>Grupo</td>
        <td>Maestro</td>
    </tr>';

for( $i = 1; $i <= $numRows; $i++ ){
    $clave = $ocjPHPExcel->getActiveShet()->getCell('A'.$i)->getCalculatedValue();
    $grupo = $ocjPHPExcel->getActiveShet()->getCell('B'.$i)->getCalculatedValue();
    $maestro = $ocjPHPExcel->getActiveShet()->getCell('C'.$i)->getCalculatedValue();

    echo '
    <tr>
        <td>'. $clave .'</td>
        <td>'. $grupo .'</td>
        <td>'. $maestro .'</td>
    </tr>';
}
*/
?>