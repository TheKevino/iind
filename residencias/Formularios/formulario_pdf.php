<?php

    include 'plantilla.php';
    include '../../includes/responsable.php';
    require '../../includes/db.php';
    date_default_timezone_set('America/Los_Angeles');
    $meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio",
        "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];

    if(isset($_GET['id'])){
    $id = base64_decode($_GET['id']);
    
        $query = "SELECT * FROM formularios, usuarios WHERE (idFormulario = '$id') AND (idAsesorInterno = idUsuario 
        OR idRevisor1 = idUsuario AND idFormulario = '$id'
        OR idRevisor2 = idUsuario AND idFormulario = '$id')";
        
        $result = mysqli_query($conn, $query);
    
        while($row = mysqli_fetch_array($result)){
            $nombreEstudiante = $row[1] ." ".$row[2]." ".$row[3];
            $nc = $row[5];
            $nombreProyecto = $row[6];
            $producto = $row[7];
        
            if($row[9] == $row[15]){
                if($row[10]==NULL) $row[10] = "img/image.jpg";
                $asesorInterno = new Responsable($row[9], $row[16]." ".$row[17]." ".$row[18] , $row[10]);
            } else if($row[11] == $row[15]){
                if($row[12]==NULL) $row[12] = "img/image.jpg";
                $revisor1 = new Responsable($row[11],$row[16]." ".$row[17]." ".$row[18] , $row[12]);
            }  else if($row[13] == $row[15]){
                if($row[14]==NULL) $row[14] = "img/image.jpg";
                $revisor2 = new Responsable($row[13], $row[16]." ".$row[17]." ".$row[18] , $row[14]);
            }
              
        }//fin while

        //Si se escogio solo un encargado o un numero menor a 3
        if(!isset($asesorInterno)) $asesorInterno = new Responsable(1, "" , "img/image.jpg");
        if(!isset($revisor1)) $revisor1 = new Responsable(1, "" , "img/image.jpg");
        if(!isset($revisor2)) $revisor2 = new Responsable(1, "" , "img/image.jpg");

        if($asesorInterno->getIdUsuario()==1) $asesorInterno->setNombre("");
        if($revisor1->getIdUsuario()==1) $revisor1->setNombre("");
        if($revisor2->getIdUsuario()==1) $revisor2->setNombre("");
        
        $nombreEstudiante = mb_strtoupper($nombreEstudiante);

        //Query para los encargados
        $jefeDivEstudiosProf;
        $jefeDeptoIngIndustrial;

        $query = "SELECT jefeDivisionEstudiosProf, jefeDeptoIngInd FROM encargados";
        $result = mysqli_query($conn, $query);
  
        $row = mysqli_fetch_array($result);
        $jefeDivEstudiosProf = $row['jefeDivisionEstudiosProf'];
        $jefeDeptoIngIndustrial = $row['jefeDeptoIngInd'];
        
    } //fin if

    $pdf = new PDF('P', 'mm');
    $pdf->SetTitle(utf8_decode($nombreEstudiante));
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetXY(95, 45);
    $pdf->Cell(100, 10, 'Hermosillo, Sonora, a '. date("d")." de ". $meses[date("n")-1]." de ". date("Y"), 0, 1, 'R', 0);
    $pdf->SetXY(9, 58);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->Cell(50, 5, utf8_decode($jefeDivEstudiosProf), 0, 1, 'l'); //JEFE
    $pdf->SetX(9);
    $pdf->Cell(102, 5, 'JEFE DE LA DIVISION DE ESTUDIOS PROFESIONALES', 0, 1, 'L');
    $pdf->SetX(9);
    $pdf->Cell(50, 5, 'P R E S E N T E.', 0, 1, 'L');
    $pdf->Setxy(9,75);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 5, utf8_decode('Por este medio le informo que ha sido liberado el siguiente proyecto para la Titulación integral:'), 0, 1, 'L');
    $pdf->SetY(81);
    $pdf->Cell(55, 10, 'a) Nombre del estudiante:', 1, 0, 'L');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(130, 10, utf8_decode($nombreEstudiante), 1, 1, 'L');

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(55, 10, 'b) Carrera', 1, 0, 'L');
    $pdf->Cell(130, 10, utf8_decode('Ingeniería Industrial'), 1, 1, 'L');

    $pdf->Cell(55, 10, 'c) No. de control', 1, 0, 'L');
    $pdf->Cell(130, 10, $nc, 1, 1, 'L', 0);

    $pdf->SetWidths(array(55,130));
    $pdf->SetAligns(array('L','L'));
    $pdf->Row(array('d) Nombre del proyecto:', utf8_decode($nombreProyecto)));

    /*
    $pdf->Cell(55, 20, 'd) Nombre del proyecto:', 1, 0, 'L');
    $pdf->Cell(130, 20, '', 1, 0, 'L');
    $pdf->SetX(65);
    $pdf->MultiCell(130, 5, utf8_decode($nombreProyecto), 0, 'L', 0);
    */
    $pdf->Cell(55, 10, 'e) Producto:', 1, 0, 'L');
    $pdf->Cell(130, 10, utf8_decode($producto), 1, 1, 'L');
    $pdf->SetY(142);
    $pdf->MultiCell(185, 5, utf8_decode('Agradezco de antemano su valioso apoyo en esta importante actividad para la formación profesional de nuestros egresados.'), 0, 'L', 0);
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetY(155);
    $pdf->Cell(55, 5, 'A T E N T A M E N T E', 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(55, 5, utf8_decode('Excelencia en Educación Tecnológica.'), 0, 1, 'L');
    $pdf->Cell(55, 5, utf8_decode('"En el Esfuerzo Común, la Grandeza de Todos"'), 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 11);
    $pdf->SetY(195);
    $pdf->Cell(55, 5, utf8_decode($jefeDeptoIngIndustrial), 0, 1, 'L'); //JEFE DE DPTO
    $pdf->Cell(55, 5, 'JEFE DEL DEPTO. DE ING. INDUSTRIAL', 0, 1, 'L');
    $pdf->SetY(208);

    $pdf->MultiCell(60, 5, 'NOMBRE Y FIRMA DEL ASESOR INTERNO', 1, 'C', 0);
    $pdf->SetXY(70,208);
    $pdf->MultiCell(60, 5, 'NOMBRE Y FIRMA DEL REVISOR', 1, 'C', 0);
    $pdf->SetXY(130,208);
    $pdf->MultiCell(60, 5, 'NOMBRE Y FIRMA DEL REVISOR', 1, 'C', 0);

    $pdf->SetWidths(array(60, 60, 60));
    $pdf->SetAligns(array('C', 'C', 'C'));
    $pdf->Row(array(
        utf8_decode(mb_strtoupper($asesorInterno->getNombre())),
        utf8_decode(mb_strtoupper($revisor1->getNombre())),
        utf8_decode(mb_strtoupper($revisor2->getNombre()))
    ));

    /*
    $pdf->Cell(60, 10, '', 1, 0, 'C');
    $pdf->SetX(10);
    $pdf->MultiCell(60, 5, utf8_decode(strtoupper($asesorInterno->getNombre())), 0, 'C', 0);
    $pdf->SetXY(70,218);
    $pdf->Cell(60, 10, '', 1, 0, 'C');
    $pdf->SetX(70);
    $pdf->MultiCell(60, 5, utf8_decode(strtoupper($revisor1->getNombre())), 0, 'C', 0);
    $pdf->SetXY(130,218);
    $pdf->Cell(60, 10, '', 1, 0, 'C');
    $pdf->SetX(130);
    $pdf->MultiCell(60, 5, utf8_decode(strtoupper($revisor2->getNombre())), 0, 'C', 0);
    $pdf->SetY(228);
    */
    if($asesorInterno->getFirma()!="img/image.jpg") {
        $pdf->Cell(60, 30, $pdf->Image('../'.$asesorInterno->getFirma(), 15, 230, 50, 25), 1, 0, 'C');
    } else{
        $pdf->Cell(60, 30, "", 1, 0, 'L', 0);
    }

    if($revisor1->getFirma()!="img/image.jpg") {
        $pdf->Cell(60, 30, $pdf->Image('../'.$revisor1->getFirma(), 15, 225, 50, 25), 1, 0, 'C');
    } else{
        $pdf->Cell(60, 30, "", 1, 0, 'L', 0);
    }

    if($revisor2->getFirma()!="img/image.jpg") {
        $pdf->Cell(60, 30, $pdf->Image('../'.$revisor2->getFirma(), 15, 225, 50, 25), 1, 0, 'C');
    } else{
        $pdf->Cell(60, 30, "", 1, 0, 'L', 0);
    }


    $pdf->Output();

?>