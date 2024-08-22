<?php
    include_once "../../../../config/Connection.php";
    include_once "../models/mdlCat.php";
    // Instanciamos el modelo y llamamos al método correspondiente
    // con este controlador cargo las marcas en el data table
    $registro = isset($_POST['filtro']) ? $_POST['filtro'] : null;
    $conexion = new mdlCat();
    $proyecto = $conexion->listarCat($registro);
    echo json_encode($proyecto);
?>