<?php
// Importaciones (BD y modelo)
include_once "../../../config/Connection.php";
include_once "../Models/mdlEquipos.php";

$registro = isset($_POST['id']) ? $_POST['id'] : null;


// Instanciamos el modelo y llamamos al método correspondiente
$conexion = new mdlEquipos();
$elRegistro = $conexion->cargarEquipo($registro);
echo json_encode($elRegistro);