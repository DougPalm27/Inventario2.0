<?php
    include_once "../../../config/Connection.php";
    include_once "../mdlGenerales.php";

    $listarProveedores = new mdlGenerales();
    $losDatos = $listarProveedores->listarProveedores();
    echo json_encode($losDatos);
?>

