<?php

/**
 * Descripction....: direcciones para el control de las rutas del sistema
 * Autor : Marcos 
 */
$valor = 1;
if ($valor != 1) {
    echo "<meta http-equiv='refresh' content='0; url=https://simfcoh.com/'>";
} else {
    if (empty($_GET['module'])) {
        include "./modules/dasboard/views/dash.php";
    } else {
        /**
         * Módulo: prueba
         * Description : rutas para el control de productores
         */
        $_GET['module'] == 'ejercicio' ? include "./modules/ejercicio/views/agregar.php" : false;
        $_GET['module'] == 'r1' ? include "./modules/Reportes/views/r1.php" : false;
        $_GET['module'] == 'r2' ? include "./modules/Reportes/views/r2.php" : false;
        $_GET['module'] == 'r3' ? include "./modules/Reportes/views/r3.php" : false;
        $_GET['module'] == 'r4' ? include "./modules/Reportes/views/r4.php" : false;
        $_GET['module'] == 'r5' ? include "./modules/Reportes/views/r5.php" : false;
        $_GET['module'] == 'equipo' ? include "./modules/Equipo/views/vw_equipo.php" : false;
        //  $_GET['module'] == 'listadoProductores' ? include "./modules/productores/views/listaProductores.php" :false;

        $_GET['module'] == 'asignacion' ? include "./modules/Asignaciones/view/asignacion.php" : false ;
        $_GET['module'] == 'categorias' ? include "./modules/Parametrizacion/categorias/views/categorias.php" : false ;
        $_GET['module'] == 'usuario' ? include "./modules/usuarios/views/formularioUsuario.php" : false ;
        $_GET['module'] == 'lineaClaro' ? include "./modules/Lineas/views/lineas.php" : false ;
        $_GET['module'] == 'marcas' ? include "./modules/Parametrizacion/marcas/views/marcas.php" : false ;
        $_GET['module'] == 'modelos' ? include "./modules/Parametrizacion/modelos/views/modelos.php" : false ;   
        $_GET['module'] == 'kit' ? include "./modules/Kit/views/vw_Kit.php" : false ; 
        $_GET['module'] == 'dasboard' ? include "./modules/dasboard/views/dash.php" : false ; 
        $_GET['module'] == 'dni' ? include "./modules/identidades_temp/vw_identidades.php" : false ; 
    }
}
