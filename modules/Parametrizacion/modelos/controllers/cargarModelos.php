
<?php
    include_once "../../../../config/Connection.php";
    include_once "../models/mdlModelos.php";
    // Instanciamos el modelo y llamamos al método correspondiente
    // con este controlador cargo las marcas en el data table
    $registro = isset($_POST['filtro']) ? $_POST['filtro'] : null;
    $conexion = new mdlModelos();
    $proyecto = $conexion->listarModelo($registro);
    echo json_encode($proyecto);
?>