
<?php
    include_once "../../../config/Connection.php";
    include_once "../mdlGenerales.php";

    $listarEstados = new mdlGenerales();
    $losDatos = $listarEstados->listarEstados();
    echo json_encode($losDatos);
?>

