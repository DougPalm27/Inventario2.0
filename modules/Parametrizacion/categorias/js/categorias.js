$(document).ready(function () {
  // evento click del botón guardar

  listarCategorias(1);

  $("#btnGuardarCat").on("click", function () {
    // Obtener el valor del campo nombreMarca
    let cat = $("#Cat").val().trim(); // Eliminar espacios en blanco
    let losDatos = {
        cat: cat,
    };
    // Validar que el valor no esté vacío
    if (cat.length <= 0) {
        swal.fire("Ups", "El nombre no puede estar vacío", "warning");
        return; // Detener la ejecución si está vacío
    } else {
        // Si todos los campos son válidos, continuar con la lógica de guardar los datos
        console.log(losDatos);
        guardarDatos(losDatos);
    }
});

});

function guardarDatos(losDatos) {
  $.ajax({
    type: "POST",
    url: "./modules/Parametrizacion/categorias/controllers/ctrGuardarCategorias.php",
    data: {
      losDatos: losDatos,
    },
    error: function (error) {
      console.log(error);
    },
    success: function (respuesta) {
      console.log(respuesta);
      const resp = JSON.parse(respuesta);
      console.log(resp);

      if (resp[0].status == "200") {
        swal.fire(
          "Seccion de Marca",
          "Categoria registrada Correctamente",
          "success"
        );
      }
    },
  });
}

function listarCategorias(filtro) {
  // Petición
  $.ajax({
    type: "POST",
    url: "./modules/Parametrizacion/categorias/controllers/cargarCategorias.php",
    data: {
      filtro: filtro,
    },
    dataType: "json",
    error: function (error) {
      console.log(error);
      Swal.fire({
        title: "Ups",
        icon: "warning",
        text: `${error}`,
        confirmButtonColor: "#3085d6",
      });
    },
    success: function (respuesta) {
      // Creamos las columnas de nuestra tabla
      console.log(respuesta);
      if (filtro == 1) {
        var columns = [
          {
            mDataProp: "descripcion",
            width: 5,
          },
          {
            mDataProp: "cantidad",
            width: 5,
          },
          {
            className: "text-left",
            width: 50,
            render: function (data, types, full, meta) {
              // let btnEliminar = `<button name="registro-eliminar" class="btn btn-outline-danger" onclick="prueba('${full.marcaID}');" type="button" data-toggle="tooltip" data-placement="top" title="Eliminar productor">
              //                           <i class="fas fa-trash"></i>
              //                         </button>`;

              let btnEliminar = `<div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" onchange="boton('${
                full.categoriaID
              }',this)" ${full.estadoID == 1 ? "checked" : ""}>
              </div>`;
              return ` ${btnEliminar}`;
            },
          },
        ];
        // Llamado a la función para crear la tabla con los datos
        cargarTabla("#tablaCategorias", respuesta, columns);
      } else {
        categorias = respuesta;
      }
    },
  });
}

function boton(id, estado) {
  let activado;
  if (estado.checked) {
    activado = 1;
  } else {
    activado = 2;
  }

  $.ajax({
    type: "POST",
    url: "./modules/Parametrizacion/marcas/controllers/eliminarMarca.php",
    data: {
      id: id,
      estado: parseInt(activado),
    },
    error: function (error) {
      console.log(error);
    },
    success: function (respusta) {
      console.log(respusta);
      // listarMarcas(1);
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

function capitalizeText(text) {
  return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
}
