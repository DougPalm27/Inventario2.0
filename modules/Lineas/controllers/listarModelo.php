<?php
include_once "../../../config/Connection.php";
include_once "../models/mdl_Lineas.php";


$registro = isset($_POST['id']) ? $_POST['id'] : null;

// obtenemos parámetros de la vista si los hay
// Instaciamientos
$listar = new mdlLineas;
$losDatos = $listar->listarModelo($registro);
echo json_encode($losDatos);
