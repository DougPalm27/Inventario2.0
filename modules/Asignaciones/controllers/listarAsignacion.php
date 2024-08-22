<?php
    include_once "../../../config/Connection.php";
    include_once "../models/mdl_asignaciones.php";
    // obtenemos parámetros de la vista si los hay
    // Instaciamientos
    $listarCategorias = new mdlAsignacion();
    $losDatos = $listarCategorias->listarAsignaciones();
    echo json_encode($losDatos);
?>