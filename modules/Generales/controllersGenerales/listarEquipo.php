<?php
    include_once "../../../config/Connection.php";
    include_once "../mdlGenerales.php";

    $listar = new mdlGenerales();
    $losDatos = $listar->listarEquipo();
    echo json_encode($losDatos);
?>

