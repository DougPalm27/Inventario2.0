<!-- Vendor JS Files -->
<script src="./assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/vendor/chart.js/chart.umd.js"></script>
<script src="./assets/vendor/echarts/echarts.min.js"></script>
<script src="./assets/vendor/quill/quill.min.js"></script>
<script src="./assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="./assets/vendor/tinymce/tinymce.min.js"></script>
<script src="./assets/vendor/php-email-form/validate.js"></script>
<script src="./assets/js/jquery.js"></script>
<!-- 
mar -->
<script src="./assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="./assets/vendor/chart.js/chart.umd.js"></script>
<script src="./assets/vendor/echarts/echarts.min.js"></script>
<script src="./assets/vendor/quill/quill.min.js"></script>
<script src="./assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="./assets/vendor/tinymce/tinymce.min.js"></script>
<script src="./assets/vendor/php-email-form/validate.js"></script>



<!-- DataTables -->
<script src="./assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="./assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="./assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="./assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="./assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="./assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="./assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="./assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>

<script>
  function capitalizeText(text) {
    return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();

  }

  function eliminarEspacios(cadena) {
    return cadena ? cadena.replace(/\s/g, '') : "";
  }

  function contieneCaracteresEspeciales(cadena) {
    // Expresión regular para buscar caracteres que no sean letras, números o guiones bajos (_)
    var expresionRegular = /[^a-zA-Z0-9_]/;
    return expresionRegular.test(cadena);
  }

  function limpiarTodo() {
    // Limpiar campos de texto y contraseñas
    $("input[type='text']").val("");
    $("input[type='password']").val("");
    $("textarea").val("");

    // Limpiar campos de selección
    $("select").val("-1");

    // Limpiar campos de casillas de verificación
    $("input[type='checkbox']").prop("checked", false);

    // Limpiar campos de radio
    $("input[type='radio']").prop("checked", false);
  }
</script>
<!-- Template Main JS File -->
<script src="./assets/js/main.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



<!-- Carga de  js según el módulo-->
<?php
echo '<script src="./modules/dasboard/js/dash.js"></script>';
if (!empty($_GET['module'])) {

  if ($_GET['module'] == 'listadoProductores') {
    echo '<script src="./modules/productores/js/listaProductor.js"></script>';
  }
  if ($_GET['module'] == 'ejercicio') {
    echo '<script src="./modules/ejercicio/js/ejercicio.js"></script>';
  }
  if ($_GET['module'] == 'r1') {
    echo '<script src="./modules/Reportes/js/reporteGeneral.js"></script>';
  }
  if ($_GET['module'] == 'r2') {
    echo '<script src="./modules/Reportes/js/reporteHistorico.js"></script>';
  }
  if ($_GET['module'] == 'r3') {
    echo '<script src="./modules/Reportes/js/reporteTotalCategoriaEstado.js"></script>';
  }
  if ($_GET['module'] == 'r4') {
    echo '<script src="./modules/Reportes/js/reporteAsignaciones.js"></script>';
  }
  if ($_GET['module'] == 'r5') {
    echo '<script src="./modules/Reportes/js/reporteMantenimiento.js"></script>';
  }
  if ($_GET['module'] == 'equipo') {
    echo '<script src="./modules/Equipo/Js/equipo.js"></script>';
  }

  if ($_GET['module'] == 'asignacion') {
    echo '<script src="./modules/Asignaciones/js/asignacion.js"></script>';
  }

  if ($_GET['module'] == 'categorias') {
    echo '<script src="./modules/Parametrizacion/categorias/js/categorias.js"></script>';
  }
  if ($_GET['module'] == 'usuario') {
    echo '<script src="./modules/usuarios/js/usuario.js"></script>';
  }
  if ($_GET['module'] == 'lineaClaro') {
    echo '<script src="./modules/Lineas/funciones/ingresarLinea.js"></script>';
  }
  if ($_GET['module'] == 'marcas') {
    echo '<script src="./modules/Parametrizacion/marcas/js/marcas.js"></script>';
  }
  if ($_GET['module'] == 'modelos') {
    echo '<script src="./modules/Parametrizacion/modelos/js/modelo.js"></script>';
  }
  if ($_GET['module'] == 'kit') {
    echo '<script src="./modules/Kit/js/kit.js"></script>';
  }
  if ($_GET['module'] == 'dni') {
    echo '<script src="./modules/identidades_temp/dni.js"></script>';
  }
} else {
  //echo '<script src="/modules/home/"></script>';
}
?>