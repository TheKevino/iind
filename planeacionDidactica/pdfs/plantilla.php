<?php

    require '../../fpdf/fpdf.php';

    class PDF extends FPDF{

        var $widths;
        var $aligns;

        function Header(){
            $this->Image('../img/header_planeacion.jpg', 25, 10, 245, 20);
            $this->SetFont('Arial','B', 9);
            $this->SetXY(215, 24);
            $this->Cell(5,5,$this->PageNo(), 0,0,'C');
            $this->SetX(226);
            $this->Cell(5,5,'{nb}', 0,0,'C');
            
            $this->Ln(10);
        }

        function Footer(){
            $this->SetY(-15);
            $this->SetFont('Arial', 'B', 8);
            $this->SetX(13);
            $this->Cell(50, 4, 'ITH-AC-PO-004-01', 0, 0, 'C', 0);
            $this->Cell(210, 4, 'Rev. 5', 0, 0, 'R', 0);
        }

        function SetWidths($w)
        {
            //Set the array of column widths
            $this->widths=$w;
        }

        function SetAligns($a)
        {
            //Set the array of column alignments
            $this->aligns=$a;
        }

        function Row($data)
        {
            //Calculate the height of the row
            $nb=0;
            $countData = count($data);
            for($i=0;$i<$countData;$i++)
                $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
            $h=5*$nb;
            //Issue a page break first if needed
            //$this->CheckPageBreak($h);
            //Draw the cells of the row
            for($i=0;$i<count($data);$i++)
            {
                $w=$this->widths[$i];
                $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
                //Save the current position
                $x=$this->GetX();
                $y=$this->GetY();
                //Draw the border
                $this->Rect($x,$y,$w,$h);
                //Print the text
                $this->MultiCell($w,5,$data[$i],0,$a);
                //Put the position to the right of the cell
                $this->SetXY($x+$w,$y);
            }
            //Go to the next line
            $this->Ln($h);
        }//fin metodo

        function CheckPageBreak($h)
        {
            //If the height h would cause an overflow, add a new page immediately
            if($this->GetY()+$h>$this->PageBreakTrigger)
                $this->AddPage($this->CurOrientation);
        }

        function NbLines($w,$txt)
        {
            //Computes the number of lines a MultiCell of width w will take
            $cw=&$this->CurrentFont['cw'];
            if($w==0)
                $w=$this->w-$this->rMargin-$this->x;
            $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
            $s=str_replace("\r",'',$txt);
            $nb=strlen($s);
            if($nb>0 and $s[$nb-1]=="\n")
                $nb--;
            $sep=-1;
            $i=0;
            $j=0;
            $l=0;
            $nl=1;
            while($i<$nb)
            {
                $c=$s[$i];
                if($c=="\n")
                {
                    $i++;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                    continue;
                }
                if($c==' ')
                    $sep=$i;
                $l+=$cw[$c];
                if($l>$wmax)
                {
                    if($sep==-1)
                    {
                        if($i==$j)
                            $i++;
                    }
                    else
                        $i=$sep+1;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                }
                else
                    $i++;
            }
            return $nl;
        }//fin metodo

        
        public function GetVerticalPosition() {
            // Include page and Y position of the document
            return array(
              'page' => $this->PageNo(),
              'y' => $this->GetY(),
            );
          }
          
          public function SetVerticalPosition( $pos ) {
            // Set the page and Y position of the document
            $this->page = $pos['page'];
            $this->SetY( $pos['y'] );
            $this->SetFont('Arial', '', 8);
          }
          
          public function FurthestVerticalPosition( $aPos, $bPos = null ) {
            if ( $bPos === null ) $bPos = $this->GetVerticalPosition();
          
            // Returns the "furthest" vertical position between two points, based on page and Y position
            if ( 
              ($aPos['page'] > $bPos['page']) // Furthest position is located on another page
              ||
              ($aPos['page'] == $bPos['page'] && $aPos['y'] > $bPos['y'] ) // Furthest position is within the same page, but further down
            ) {
              return $aPos;
            }else{
              return $bPos;
            }
          }


// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

// Better table
function ImprovedTable($header, $data, $w)
{
    // Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}



    }

?>