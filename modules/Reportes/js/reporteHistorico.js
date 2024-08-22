$(document).ready(function () {

      // Cargar tabla
      listarInventarioHistorico();
    
      // -------------------------- TABLA --------------------------
      $("#r2").on("click", "button", function () {
        // Obtener el id que trae el botón
        let id = $(this).attr("data-marco");
        idRegistro = id;
    
        // Obtener la acción a realizar
        let accion = $(this).attr("name");
    
        // Dependiendo del botón al que se le hace click
        // se realizará una acción transmitida por el atributo name
          if (accion == "registro-eliminar") {
          // Llamamos a la alerta para eliminar
          eliminarRegistro(id);
        }
      });
      
      $("#btnPrint").on("click", function(){
          window.open("./modules/Reportes/reportes/reporteGeneral.php", "_blank");
      });
  
    });
    
    // Función para cargar las categorias y estado
    function listarInventarioHistorico() {
      // Petición
      $.ajax({
        type: "GET",
        url: "./modules/Reportes/controllers/reporteInventarioHistorico.php",
        dataType: "json",
        error: function (error) {
          console.log(error);
          Swal.fire({
            title: "Reporte",
            icon: "warning",
            text: `${error}`,
            confirmButtonColor: "#3085d6",
          });
        },
        success: function (respuesta) {
          // Creamos las columnas de nuestra tabla
          console.log(respuesta);
          var columns = [
            {
              mDataProp: "EquipoID",width:30,
            },
            {
              mDataProp: "Categoria", width:10,
            },
            {
              mDataProp: "Precio de Compra",width:10,
            },
            {
              mDataProp: "Fecha de Compra", width:10,
            },
            {
              mDataProp: "Fecha de Baja", width:10,
            },
            {
                mDataProp: "Motivo de Baja", width:10,
            },
          ];
          // Llamado a la función para crear la tabla con los datos
          cargarTabla("#r2", respuesta, columns);
        },
      });
    }
    function cargarTabla(tableID, data, columns) {
      $(tableID).dataTable().fnClearTable();
      $(tableID).dataTable().fnDestroy();
      var params = {
        aaData: data,
        aoColumns: columns,
        bSortable: false,
        ordering: true,
        language: {
          sProcessing: "Procesando...",
          sLengthMenu: "Mostrar _MENU_ registros",
          sZeroRecords: "No se encontraron resultados",
          sEmptyTable: "Ningún dato disponible en esta tabla",
          sInfo:
            "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
          sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
          sInfoPostFix: "",
          sSearch: "Buscar:",
          sUrl: "",
          sInfoThousands: ",",
          sLoadingRecords: "Cargando...",
          oPaginate: {
            sFirst: "Primero",
            sLast: "Último",
            sNext: "Siguiente",
            sPrevious: "Anterior",
          },
          oAria: {
            sSortAscending:
              ": Activar para ordenar la columna de manera ascendente",
            sSortDescending:
              ": Activar para ordenar la columna de manera descendente",
          },
          buttons: {
            copy: "Copiar",
            colvis: "Visibilidad",
          },
        },
      };
    
      $(tableID).DataTable(params);
    }
    function eliminarRegistro(id) {
      console.log(id);
      Swal.fire({
        title: "¿Está seguro de eliminar?",
        text: "No podrá utilizarlo si lo elimina",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085D6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "./modules/Reportes/controllers/reportesGeneralEliminar.php",
            data: {
              recio: id,
            },
            // Error en la petición
            error: function (error) {
              console.log(error);
              Swal.fire({
                title: "Equipo",
                icon: "error",
                text: `${error.responseText}`,
                confirmButtonColor: "#3085d6",
              });
            },
            // Petición exitosa
            success: function (respuesta) {
              console.log(respuesta);
              const datos = JSON.parse(respuesta);
    
              // Eliminado correctamente
              if (datos[0].status == 200) {
                Swal.fire({
                  title: "Equipo",
                  icon: "success",
                  text: `${datos[0].mensaje}`,
                  confirmButtonColor: "#3085d6",
                });
    
                // Actualizar los datos en tabla
                listarInventarioGeneral();
              }
              // Error
              else {
                Swal.fire({
                  title: "Productor",
                  icon: "error",
                  text: `Ocurrió un error al intentar eliminar el registro.`,
                  confirmButtonColor: "#3085d6",
                });
              }
            },
          });
        }
      });
    }