<?php
// Importaciones (BD y modelo)
    include_once "../../../../config/Connection.php";
    include_once "../models/mdlMarcas.php";

    $registro = isset($_POST['losDatos']) ? $_POST['losDatos'] : null;
    $losDatos = (object) $registro;
    //Controlador para registrar la informacion en la base de datos
    // Instanciamos el modelo y llamamos al método correspondiente
    $conexion = new mdlMarcas();
    $elRegistro = $conexion->guardarNuevaMarca($losDatos);


