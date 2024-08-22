<?php
    include_once "../../../../config/Connection.php";
    include_once "../models/mdlMarcas.php";
    // Instanciamos el modelo y llamamos al método correspondiente
    // con este controlador cargo las marcas en el data table
    $registro = isset($_POST['filtro']) ? $_POST['filtro'] : null;
    $conexion = new mdlMarcas();
    $proyecto = $conexion->listarMarca($registro);
    echo json_encode($proyecto);
?>