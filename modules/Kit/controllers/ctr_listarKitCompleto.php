<?php
    include_once "../../../config/Connection.php";
    include_once "../Models/mdl_kit.php";
    // Instanciamos el modelo y llamamos al método correspondiente
    $conexion = new mdlKit();
    $datos = $conexion->listarKitTodo();
    echo json_encode($datos);
?>

