<?php
// Importaciones (BD y modelo)
    include_once "../../../config/Connection.php";
    include_once "../models/mdl_Lineas.php";

    $registro = isset($_POST['losDatos']) ? $_POST['losDatos'] : null;
    $losDatos = (object) $registro;

    // Instanciamos el modelo y llamamos al método correspondiente
    $conexion = new mdlLineas();
    $elRegistro = $conexion->ingresarLinea($losDatos);