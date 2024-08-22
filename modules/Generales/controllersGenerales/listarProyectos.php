<?php
    include_once "../../../config/Connection.php";
    include_once "../mdlGenerales.php";

    $listarPro = new mdlGenerales();
    $losDatos = $listarPro->listarProyectos();
    echo json_encode($losDatos);
?>

