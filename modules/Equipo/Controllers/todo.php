<?php
    include_once "../../../config/Connection.php";
    include_once "../Models/mdlEquipos.php";
    // Instanciamos el modelo y llamamos al método correspondiente
    $conexion = new mdlEquipos();
    $proyecto = $conexion->listarTodo();
    echo json_encode($proyecto);
?>