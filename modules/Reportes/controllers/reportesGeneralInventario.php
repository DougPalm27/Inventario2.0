<?php

    include_once "../../../config/Connection.php";
    include_once "../models/reportes.php";



    // Instanciamos el modelo y llamamos al método correspondiente
    $conexion = new mdlReportes();
    $proyecto = $conexion->listarreporteGeneral();

    echo json_encode($proyecto);
?>