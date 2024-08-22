<?php
    include '../../Reporteria/pdf/plantilla.php';
    include_once '../../../config/Connection.php';
    include_once '../models/reportes.php';   
  
    // Creamos el objeto
    $pdf = new PDF();

   

    # caputa e instanciamientos
    $reportes = new mdlReportes();
    $datosReportes = $reportes->listarreporteGeneral();

     // Adicionamos una página en blanco
     $pdf->AddPage();

    // Contenido del documento (Título)
    $pdf->Ln(4);
    $pdf->SetXY(65,30);
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(100,10,utf8_decode('Inventario General de Equipo'));
    #línea divisora
    $pdf->SetLineWidth(0.5);
    $pdf->SetDrawColor(150,152,154);

    #Impresión de la tabla de participantes
    # verificamos si hay participantes para imprimir
    if(count($datosReportes)>0){
        $pdf->SetTextColor(255); 
        $pdf->SetFillColor(1,64,109); 
        $pdf->SetXY(5,45);
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(20, 8, utf8_decode('EquipoID'), 1, 0, 'C', 1);
        $pdf->Cell(90, 8, utf8_decode('Descripcion'), 1, 0, 'C', 1);
        $pdf->Cell(30, 8, utf8_decode('Categoria'), 1, 0, 'C', 1);
        $pdf->Cell(25, 8, utf8_decode('Precio'), 1, 0, 'C', 1);
        $pdf->Cell(35, 8, utf8_decode('Estado'), 1, 0, 'C', 1);
        
        $pdf->Ln();
        $pdf->SetFillColor(255,255,255); 
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',8);
        $i=1;

         foreach ($datosReportes as $report) {
            $pdf->setX(5);
            $pdf->Cell(20, 8,utf8_decode($report['EquipoID']),1, 0, 'C', 1);
            $pdf->Cell(90,8,limitar_cadena(utf8_decode($report['Descripcion']),60,'...'),1, 0, 'L', 1);
            $pdf->Cell(30,8,utf8_decode($report['Categoria']),1, 0, 'C', 1);
            $pdf->Cell(25,8,utf8_decode($report['Precio de Compra']),1, 0, 'C', 1);
            $pdf->Cell(35,8,utf8_decode($report['Estado']),1, 0, 'C', 1);
            $pdf->Ln();
        } 
    
    }
    

    $pdf->Output('reporteGeneralInventario.pdf','I');

    function limitar_cadena($cadena, $limite, $sufijo){
        // Si la longitud es mayor que el límite...
        if(strlen($cadena) > $limite){
            // Entonces corta la cadena y ponle el sufijo
            return substr($cadena, 0, $limite) . $sufijo;
        }
        
        // Si no, entonces devuelve la cadena normal
        return $cadena;
    }
?>