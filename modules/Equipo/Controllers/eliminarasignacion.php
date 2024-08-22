<?php

    include_once "../../../config/Connection.php";
    include_once "../Models/mdlEquipos.php";

   // Obtener los datos para almacenar
   $registro = isset($_POST['recio']) ? $_POST['recio'] : null;
    // Instanciamos el modelo y llamamos al método correspondiente
    $conexion = new mdlEquipos();
    $proyecto = $conexion->EliminarAsignacion($registro);

?>

