<?php
include_once "../../../config/Connection.php";
include_once "../models/mdl_asignaciones.php";
// obtenemos parámetros de la vista si los hay
// Instaciamientos
$datosObtenidos = $_POST['losDatos'];  // [{"correo","passowrd"}]
$losDatos = (object) $datosObtenidos;  
$listarCategorias = new mdlAsignacion();
$losDatos = $listarCategorias->asignarEquipo($losDatos);
?>