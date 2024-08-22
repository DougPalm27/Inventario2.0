<?php
// Importaciones (BD y modelo)
include_once "../../../config/Connection.php";
include_once "../models/mdl_Lineas.php";

$registro = isset($_POST['id']) ? $_POST['id'] : null;

// var_dump($registro);
// Instanciamos el modelo y llamamos al método correspondiente
$conexion = new mdlLineas();
$elRegistro = $conexion->quitarAsignacion($registro);
echo json_encode($elRegistro);