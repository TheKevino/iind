<?php
    require_once("../../tcpdf/examples/tcpdf_include.php");

    class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = '../img/header_planeacion.jpg';
        $this->Image($image_file, 25, 10, 245, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetFont('helvetica', 'b', 11);

        $this->SetXY(177, 24.5);
        $this->Cell(0, 10, $this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    // Page footer
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'b', 12);
        
        $this->SetX(13);
        $this->Cell(50, 4, 'ITH-AC-PO-004-01', 0, 0, 'C', 0);
        $this->Cell(210, 4, 'Rev. 5', 0, 0, 'R', 0);
    }

}