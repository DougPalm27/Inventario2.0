<?php
include_once "../../../config/Connection.php";
include_once "../mdlGenerales.php";

$listarCat = new mdlGenerales();
$losDatos = $listarCat->listarCategorias();
echo json_encode($losDatos);
