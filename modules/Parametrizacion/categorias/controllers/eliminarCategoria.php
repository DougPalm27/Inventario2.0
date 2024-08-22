<?php
// Importaciones (BD y modelo)
    include_once "../../../../config/Connection.php";
    include_once "../models/mdlMarcas.php";

    $registro = isset($_POST['id']) ? $_POST['id'] : null;
    $registro1 = isset($_POST['estado']) ? $_POST['estado'] : null;
    //conrolador para eliminar una marca de la tabla (se cambia el estado)
    // Instanciamos el modelo y llamamos al método correspondiente
    $conexion = new mdlMarcas();
    $elRegistro = $conexion->eliminarMarca($registro, $registro1);
    echo $registro1;