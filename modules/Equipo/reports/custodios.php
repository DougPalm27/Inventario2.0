<?php
include_once "../../../config/Connection.php";
include_once '../Models/reporte.php';
include_once '../../../assets/vendor/phpexcel/PHPExcel.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

} else {
    echo "No se recibieron los parámetros necesarios.";
}




$asignacion= new mdlReportes();
$asignaciones = $asignacion->custodio($id);

// Cargar la hoja de excel 
$excel = PHPExcel_IOFactory::load('./Custodio.xlsx');
$excel->SetActiveSheetIndex(0);

// Establecer valores en las celdas
$excel->getActiveSheet()->setCellValue('B12', utf8_decode("'".$asignaciones[0]['codigoEmpleado']));
$excel->getActiveSheet()->setCellValue('E12',utf8_decode($asignaciones[0]['Asignado']));
$excel->getActiveSheet()->setCellValue('H12',$asignaciones[0]['fechaAsignacion']);
$excel->getActiveSheet()->setCellValue('B16',utf8_decode($asignaciones[0]['ingreso']));
$excel->getActiveSheet()->setCellValue('E16',$asignaciones[0]['cargo']);
$excel->getActiveSheet()->setCellValue('H16',$asignaciones[0]['proyectoEmpleado']);
$excel->getActiveSheet()->setCellValue('C4',utf8_decode($asignaciones[0]['serie']));
$excel->getActiveSheet()->setCellValue('G24',utf8_decode($asignaciones[0]['nombreMarca']));
$excel->getActiveSheet()->setCellValue('C26',utf8_decode($asignaciones[0]['nombreModelo']));
$excel->getActiveSheet()->setCellValue('G26',utf8_decode($asignaciones[0]['codigoSAP']));
$excel->getActiveSheet()->setCellValue('G28',utf8_decode($asignaciones[0]['precioAdquisicion']));
$excel->getActiveSheet()->setCellValue('C28',utf8_decode($asignaciones[0]['proyectoEquipo']));
$excel->getActiveSheet()->setCellValue('C30',utf8_decode($asignaciones[0]['descripcionGeneral']));
$excel->getActiveSheet()->setCellValue('C33',utf8_decode($asignaciones[0]['observaciones']));





// Propiedades del documento
$excel->getProperties()->setCreator("Inventario")
    ->setLastModifiedBy("IT")
    ->setSubject("Custodios de Equipo")
    ->setDescription("Custodio de equipo asignado");

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=custodio.xlsx');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
