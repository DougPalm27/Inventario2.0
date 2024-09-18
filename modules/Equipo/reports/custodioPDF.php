<?php
    include '../../Reporteria/pdf/plantilla.php';
    include_once '../../../config/Connection.php';
    include_once '../Models/reporte.php';   

    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
    } else {
        echo "No se recibieron los parámetros necesarios.";
    }
    
    
    // Creamos el objeto
    $pdf = new PDF();

   

    # caputa e instanciamientos
    $reportes = new mdlReportes();
    $datosReportes = $reportes->custodio($id);

    // Verificar si se obtuvo un resultado
if (!$datosReportes || count($datosReportes) == 0) {
    echo "No se encontraron datos para el ID proporcionado.";
    exit();
}

// Accedemos directamente al primer y único registro
$fila = $datosReportes[0];

     // Adicionamos una página en blanco
     $pdf->AddPage();

    // Contenido del documento (Título)
    $pdf->Ln(4);
    $pdf->SetXY(58,40);
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(90,10,'HOJA DE RESPONSABILIDAD DE EQUIPO',0,1);
    #línea divisora
    $pdf->SetLineWidth(0.5);
    $pdf->SetDrawColor(150,152,154);



// Establecer fuente Arial, negrita, tamaño 16
$pdf->SetFont('Arial', 'B', 12);


     /* DATOS GENERALES */
     $pdf->Ln(4);
     $pdf->SetXY(20,48);
     $pdf->SetFont('Arial','B',9);
     $pdf->Cell(100,6,iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'I.   Datos del Responsable'));

$pdf->Ln();
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,54);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(45, 6, iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Código de Empleado' ), 0, 0, 'C', 1);
// Columna en blanco
$pdf->Cell(5, 6, '', 0, 0, 'L'); // Columna en blanco con ancho de 5 mm

$pdf->Cell(70, 6,iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Nombre Completo' ),0, 0, 'C', 1);
$pdf->Cell(5, 6, '', 0, 0, 'L'); // Columna en blanco con ancho de 5 mm
$pdf->Cell(45, 6,iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Fecha de Solicitud' ),0, 0, 'C', 1);


$pdf->Ln(); 
$pdf->SetFillColor(209,209,209);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',9);
$pdf->SetX(20);
$pdf->Cell(45, 10, iconv("UTF-8", "ISO-8859-1//TRANSLIT",$fila['codigoEmpleado'] ), 0, 0, 'C', 1);
$pdf->Cell(5, 10, '', 0, 0, 'L'); // Columna en blanco con ancho de 5 mm
$pdf->Cell(70, 10,iconv("UTF-8", "ISO-8859-1//TRANSLIT",$fila['Asignado']),0, 0, 'C', 1);
$pdf->Cell(5, 10, '', 0, 0, 'L'); // Columna en blanco con ancho de 5 mm
$pdf->Cell(45, 10,iconv("UTF-8", "ISO-8859-1//TRANSLIT",($fila['fechaAsignacion'])),0, 0, 'C', 1);



$pdf->Ln();
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,70);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(45, 6, iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Fecha de ingreso' ), 0, 0, 'C', 1);
$pdf->Cell(5, 10, '', 0, 0, 'L'); // Columna en blanco con ancho de 5 mm
$pdf->Cell(70, 6,iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Cargo' ),0, 0, 'C', 1);
$pdf->Cell(5, 10, '', 0, 0, 'L'); // Columna en blanco con ancho de 5 mm
$pdf->Cell(45, 6,iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Proyecto' ),0, 0, 'C', 1);

$pdf->Ln(); 
$pdf->SetFillColor(209,209,209);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',9);
$pdf->SetX(20);
$pdf->Cell(45, 10, iconv("UTF-8", "ISO-8859-1//TRANSLIT",$fila['ingreso'] ), 0, 0, 'C', 1);
$pdf->Cell(5, 10, '', 0, 0, 'L'); // Columna en blanco con ancho de 5 mm
$pdf->Cell(70, 10,iconv("UTF-8", "ISO-8859-1//TRANSLIT",$fila['cargo']),0, 0, 'C', 1);
$pdf->Cell(5, 10, '', 0, 0, 'L'); // Columna en blanco con ancho de 5 mm
$pdf->Cell(45, 10,iconv("UTF-8", "ISO-8859-1//TRANSLIT",($fila['proyectoEmpleado'])),0, 0, 'C', 1);


/* DATOS DEL EQUIPO - Sección II con una columna en blanco después de la segunda columna */
$pdf->Ln(4);
$pdf->SetXY(20,90);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(100,6,iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'II.   Datos del equipo'));

// Encabezado de la tabla
$pdf->Ln();
$pdf->SetFillColor(209, 209, 209); // Color de fondo para las columnas 2 y 4
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(20,96);
$pdf->SetFont('Arial','',9);  // Sin negrita

// Columna 1 (Encabezado) y Columna 2 (Datos, sombreada)
$pdf->Cell(25, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Marca:' ), 0, 0, 'L');
$pdf->SetFillColor(230, 230, 230); // Sombra gris
$pdf->Cell(58, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT",$fila['nombreMarca']), 0, 0, 'L', 1); // Sin borde, con sombreado

// Columna en blanco
$pdf->Cell(5, 9, '', 0, 0, 'L'); // Columna en blanco con ancho de 5 mm

// Columna 3 (Encabezado) y Columna 4 (Datos, sombreada)
$pdf->SetFillColor(255, 255, 255); // Volver al color blanco para el encabezado
$pdf->Cell(23, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Modelo:'), 0, 0, 'R');
$pdf->SetFillColor(230, 230, 230); // Sombra gris para la celda de datos
$pdf->Cell(60, 7, iconv("UTF-8", "ISO-8859-1//TRANSLIT",$fila['nombreModelo']), 0, 0, 'L', 1); // Sin borde, con sombreado

$pdf->Ln(); 
$pdf->Ln(); // Fila en blanco para separación

// Segunda fila de datos
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',9);

// Columna 1 (Encabezado) y Columna 2 (Datos, sombreada)
$pdf->SetX(20);
$pdf->Cell(25, 10, iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Serie:' ), 0, 0, 'R');
$pdf->SetFillColor(230, 230, 230); // Sombra gris para los datos
$pdf->Cell(58, 10,iconv("UTF-8", "ISO-8859-1//TRANSLIT",$fila['serie']),0, 0, 'L', 1); // Sin borde, con sombreado

// Columna en blanco
$pdf->Cell(5, 10, '', 0, 0, 'L'); // Columna en blanco con ancho de 5 mm

// Columna 3 (Encabezado) y Columna 4 (Datos, sombreada)
$pdf->SetFillColor(255, 255, 255); // Volver al color blanco para el encabezado
$pdf->Cell(25, 10,iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Código SAP'),0, 0, 'L');
$pdf->SetFillColor(230, 230, 230); // Sombra gris para los datos
$pdf->Cell(58, 10,iconv("UTF-8", "ISO-8859-1//TRANSLIT",$fila['codigoSAP']),0, 0, 'L', 1); // Sin borde, con sombreado

$pdf->Ln(); 
$pdf->Ln(); // Fila en blanco para separación

// Tercera fila de datos
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);

// Columna 1 (Encabezado) y Columna 2 (Datos, sombreada)
$pdf->SetX(20);
$pdf->Cell(45, 10, iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Valor del Equipo' ), 0, 0, 'L');

// Sombrear datos de la columna 2
$pdf->SetFillColor(230, 230, 230); 
$pdf->Cell(45, 10, iconv("UTF-8", "ISO-8859-1//TRANSLIT", number_format($fila['precioAdquisicion'], 2) . ' L'), 0, 0, 'L', 1); // Sin borde, con sombreado

// Columna en blanco
$pdf->Cell(5, 10, '', 0, 0, 'L'); // Columna en blanco con ancho de 5 mm

// Columna 3 (Encabezado) y Columna 4 (Datos, sombreada)
$pdf->SetFillColor(255, 255, 255); // Volver al color blanco para el encabezado
$pdf->Cell(45, 10,iconv("UTF-8", "ISO-8859-1//TRANSLIT",'Pertenece al Proyecto'),0, 0, 'L');
$pdf->SetFillColor(230, 230, 230); // Sombra gris para los datos
$pdf->Cell(45, 10,iconv("UTF-8", "ISO-8859-1//TRANSLIT",$fila['proyectoEquipo']),0, 0, 'L', 1); // Sin borde, con sombreado

$pdf->Ln(); 
$pdf->Ln(); // Fila en blanco para separación




$pdf->Ln(); // Salto de línea para separar las tablas

// Segunda tabla de ancho completo para "Observaciones"
$pdf->SetFillColor(209, 209, 209);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetX(20); // Ajusta la posición X si es necesario
$pdf->Cell(170, 6, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Observaciones'), 1, 0, 'C', 1);

$pdf->Ln(); // Salto de línea para la fila de contenido
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->SetX(20);

// Fila para el contenido de las observaciones
$pdf->MultiCell(170, 10, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $fila['observaciones']), 1, 'L', 1);

// Segunda tabla de ancho completo para "Observaciones"
$pdf->SetFillColor(209, 209, 209);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 9);
$pdf->SetX(20); // Ajusta la posición X si es necesario
$pdf->Cell(170, 6, iconv("UTF-8", "ISO-8859-1//TRANSLIT", 'Descripcion General'), 1, 0, 'C', 1);

$pdf->Ln(); // Salto de línea para la fila de contenido
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->SetX(20);

// Fila para el contenido de las observaciones
$pdf->MultiCell(170, 10, iconv("UTF-8", "ISO-8859-1//TRANSLIT", $fila['descripcionGeneral']), 1, 'L', 1);


$pdf->Ln();



$pdf->Cell(50, 10, 'Observaciones:', 0);
$pdf->MultiCell(0, 10, $fila['observaciones'], 0, 1);

    $pdf->Output('Custodio.pdf','I');

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