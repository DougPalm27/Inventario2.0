<?php
    include_once "../../../config/Connection.php";
    include_once "../models/ejercicio.php";

    // obtenemos parámetes de la vista si los hay

    // Instaciamientos
    $ejercio = new mdlEjercicio();
    $losDatos = $ejercio->listarCorreos();
    echo json_encode($losDatos);


?>