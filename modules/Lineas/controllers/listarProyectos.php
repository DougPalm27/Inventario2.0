<?php
    include_once "../../../config/Connection.php";
    include_once "../models/mdl_Lineas.php";
    // obtenemos parámetros de la vista si los hay
    // Instaciamientos
    $listar = new mdlLineas;
    $losDatos = $listar->listarProyecto();
    echo json_encode($losDatos);
?>