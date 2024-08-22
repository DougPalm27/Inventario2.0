<?php
include_once "../../../config/Connection.php";
include_once '../models/reporte.php';
include_once '../../../assets/vendor/phpexcel/PHPExcel.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

} else {
    echo "No se recibieron los parámetros necesarios.";
}




$asignacion= new mdlReportesLinea();
$asignaciones = $asignacion->custodioL($id);


 
// Cargar la hoja de excel 
$excel = PHPExcel_IOFactory::load('./CustodioLineas.xlsx');
$excel->SetActiveSheetIndex(0);

// Establecer valores en las celdas
$excel->getActiveSheet()->setCellValue('B12', "'".$asignaciones[0]['codigoEmpleado']);
$excel->getActiveSheet()->setCellValue('E12',$asignaciones[0]['nombreCompleto']);
$excel->getActiveSheet()->setCellValue('H12',$asignaciones[0]['FechaAsignacion']);
$excel->getActiveSheet()->setCellValue('B16',$asignaciones[0]['ingreso']);
$excel->getActiveSheet()->setCellValue('E16',$asignaciones[0]['cargo']);
$excel->getActiveSheet()->setCellValue('H16',$asignaciones[0]['proyecto']);
$excel->getActiveSheet()->setCellValue('C24',"'".$asignaciones[0]['IMEI']);
// $excel->getActiveSheet()->setCellValue('C25','a'.$asignaciones[0]['IMEI']);
$excel->getActiveSheet()->setCellValue('G24',$asignaciones[0]['nombreMarca']);
$excel->getActiveSheet()->setCellValue('C26',$asignaciones[0]['nombreModelo']);
$excel->getActiveSheet()->setCellValue('G26',$asignaciones[0]['valorEquipo']);
$excel->getActiveSheet()->setCellValue('C28',$asignaciones[0]['numeroLinea']);
$excel->getActiveSheet()->setCellValue('C31',$asignaciones[0]['observaciones']);



// Propiedades del documento
$excel->getProperties()->setCreator("Inventario")
    ->setLastModifiedBy("IT")
    ->setSubject("Custodios de Equipo")
    ->setDescription("Custodio de equipo asignado");

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=custodioL.xlsx');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
 