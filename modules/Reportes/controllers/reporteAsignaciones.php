<?php
    include_once "../../../config/Connection.php";
    include_once "../models/reportes.php";
    // Instanciamos el modelo y llamamos al método correspondiente
    $conexion = new mdlReportes();
    $proyecto = $conexion->listarreporteAsignaciones();
    echo json_encode($proyecto);
?>