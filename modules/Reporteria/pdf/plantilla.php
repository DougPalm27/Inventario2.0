<?php
/*    require '../../../../assets/vendor/fpdf/fpdf.php'; */
   require '../../../assets/vendor/fpdf/fpdf.php';
    // Instanciamos de la clase padre
    class PDF extends FPDF {
        // Definimos el encabezado de los reportes correspondientes
        function Header() {
	        $this->SetFillColor(255); 
	        $this->SetTextColor(0); 
	        $this->SetXY(0, 0);
	        $this->Cell(300, 30, "", 0, 1, 'R', true);

            // coordenadas(x,y para posicionamiento)
            $this->SetXY(68,7);
            $this->SetFillColor(232,232,232);
            $this->SetFont('Arial','B',14);
            $this->Cell(50,10, utf8_decode('Fundación COHONDUCAFE'));
            
            $this->Ln(4);
            $this->SetXY(58,12);
            $this->SetFont('Arial','B',11.5);
            $this->Cell(195,10,'Departamento de Tecnologia de Informacion');
            
        
            $this->SetXY(84,17);
            $this->SetFont('Arial','B',10);
            $this->Cell(195,10,utf8_decode('REPIT-001'));   
            $this->Ln();

            // Fecha y hora generada por el reporte
	        // $this->SetFont('Arial','B',10);
	        // $this->SetXY(160,25);
	        // $this->MultiCell(125,8,'Fecha:');
	        // $this->SetFont('Arial','',10);
	        // $this->SetXY(172,25);
	        // $this->MultiCell(60,8,utf8_decode(date("d") . " del " . date("m") . " de " . date("Y")));

 	        // $this->SetFont('Arial','B',10);
	        // $this->SetXY(170,30);
	        // $this->MultiCell(235,8,'Hora:');
	        // $this->SetFont('Arial','',10);
	        // $this->SetXY(180,30);
	        // $fecha = new DateTime(null, new DateTimeZone('America/Tegucigalpa'));
	        // $hora = $fecha->format("h:i:s a");
	        // $this->MultiCell(60,8,utf8_decode($hora)); 
            
	        // Logotipo (espacio esquina izquierda, superior, ancho, alto)
			$this->Image('../../../assets/img/logo.png', 10, 10, 30,10 );
   /*          $this->Image('../../../assets/img/usuario.png', 160, 3, 45,25 ); */
            $this->Ln();
        }
		
        function Footer() {
            $this->SetFont('Arial','',9);
			$this->SetXY(10,250);
			$this->MultiCell(250,75,'Administrador');
			
			$this->SetFont('Arial','B',10);
			$this->SetXY(10,245);
            $this->MultiCell(250,75,'Impreso por');
			$this->setxy(143,230);
			
			$this->SetFont('Arial','I',9);
			$this->setxy(15,275);
			$this->Cell(0,10,utf8_decode('Página').$this->PageNo(),0,0,'C');
        }

		var $widths;
		var $aligns;

		function SetWidths($w) {
    		// Set the array of column widths
    		$this->widths=$w;
		}

		function SetAligns($a) {
			// Set the array of column alignments
    		$this->aligns=$a;
		}

		function Row($data) {
    		// Calculate the height of the row
    		$nb=0;
    		for($i=0;$i<count($data);$i++)
    		    $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    		$h=5*$nb;
    		// Issue a page break first if needed
    		$this->CheckPageBreak($h);
    		// Draw the cells of the row
    		for($i=0;$i<count($data);$i++)
    		{
    		    $w=$this->widths[$i];
    		    $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
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
		}

		function CheckPageBreak($h) {
    		//If the height h would cause an overflow, add a new page immediately
    		if($this->GetY()+$h>$this->PageBreakTrigger)
        		$this->AddPage($this->CurOrientation);
		}

		function NbLines($w,$txt) {
			// Computes the number of lines a MultiCell of width w will take
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
		}
    }
?>