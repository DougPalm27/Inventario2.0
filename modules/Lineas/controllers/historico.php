<?php
// Importaciones (BD y modelo)
include_once "../../../config/Connection.php";
include_once "../models/mdl_Lineas.php";

// Instanciamos el modelo y llamamos al método correspondiente
$conexion = new mdlLineas();
$elRegistro = $conexion->historico();
echo json_encode($elRegistro);
