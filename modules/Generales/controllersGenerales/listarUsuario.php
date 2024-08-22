<?php
    include_once "../../../config/Connection.php";
    include_once "../mdlGenerales.php";

    $listarUsuario = new mdlGenerales();
    $losDatos = $listarUsuario->listarUsuario();
    echo json_encode($losDatos);
?>

