<?php

// obtenemos los modelos de la conexión y ejercicio
include_once "../../../config/Connection.php";
include_once "../models/ejercicio.php";

// obtenemos los datos de la vista
$datosObtenidos = $_POST['losDatos'];  // [{"correo","passowrd"}]
$losDatos = (object) $datosObtenidos;  //[correo:'marcoselisorto', password:'recio123'] cuando es mas de 1 parámetros



// Instanciamos la clase y llamos a la función guardar
$ejercicio = new mdlEjercicio();
$guardarEjercicio = $ejercicio->guardarCorreo($losDatos);

?>