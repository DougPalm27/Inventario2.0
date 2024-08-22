<?php
include_once "../../../config/Connection.php";
include_once "../Models/mdlEquipos.php";
// obtenemos parámetros de la vista si los hay
// Instaciamientos
$datosObtenidos = $_POST['losDatos']; 


$losDatos = (object) $datosObtenidos;

$asignarEquipo = new mdlEquipos();
$losDatos = $asignarEquipo->guardarAsignacionEquipo($losDatos);
?>
