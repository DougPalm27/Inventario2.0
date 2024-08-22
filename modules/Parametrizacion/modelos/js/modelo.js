let modelos;
$(document).ready(function () {
  listarMarcas();
  listarModelos(1);

  listarModelos(2);

  // evento click del botón guardar
  $("#btnGuardarModelo").on("click", function () {
    let modelo = $("#modelo").val(); // Obtener el valor del campo #modelo
    let modeloSinEspacios = eliminarEspacios(modelo); // Eliminar espacios en blanco usando replace

    let losDatos = {
      modelo: modeloSinEspacios, // Asignar el valor sin espacios al objeto losDatos
      marcaID: $("#marcaID").val(),
    };
    losDatos.modelo = capitalizeText(losDatos.modelo);

    // Comprobar si la marca ya existe en la base de datos
    for (var i = 0; i < modelos.length; i++) {
      if (losDatos.modelo === modelos[i].nombreModelo) {
        swal.fire("Modelos", "Este modelo ya existe", "warning");
        return;
      }
    }

    if (contieneCaracteresEspeciales(losDatos.modelo)) {
      swal.fire(
        "Seccion de Modelos",
        "No se permiten caracteres especiales",
        "warning"
      );
      return;
    } else if (losDatos.modelo.trim() === "") {
      swal.fire(
        "Seccion de modelo",
        "El nombre del modelo no puede estar vacio",
        "warning"
      );
      return;
    } else if (parseInt(losDatos.marcaID) === -1) {
      swal.fire(
        "Seccion de modelo",
        "Debe seleccionar una marca valida",
        "warning"
      );
      return;
    } else {
      console.log(losDatos);
      guardarDatos(losDatos);
      limpiarTodo();
    }
  });

  // evento change del selector de marcas
  $("#marcaID").on("change", function () {
    const valor = $("#marcaID").val();
  });
});

function guardarDatos(losDatos) {
  $.ajax({
    type: "POST",
    url: "./modules/Parametrizacion/modelos/controllers/guardarModelo.php",
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
          "Seccion de Modelos",
          "Modelo registrado Correctamente",
          "success"
        );
      }
    },
  });
}
//controlador viene del modulo de lineas, por alguna extraña razon que no recuerdo.
function listarMarcas() {
  // POST  // GET   POST -Envia Recibe   | GET RECEPCIÓ
  $.ajax({
    type: "GET",
    url: "./modules/Lineas/controllers/listarMarca.php",
    data: {},
    // Error en la petición
    error: function (error) {
      console.log(error);
    },
    // Petición exitosa
    success: function (respuesta) {
      let datos = JSON.parse(respuesta);
      datos.forEach((e) => {
        $("#marcaID").append(
          `<option value="${e.marcaID}">${e.nombreMarca}</option>`
        );
      });
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

function eliminarEspacios(cadena) {
  return cadena ? cadena.replace(/\s/g, "") : "";
}
function listarModelos(filtro) {
  // Petición
  $.ajax({
    type: "POST",
    url: "./modules/Parametrizacion/modelos/controllers/cargarModelos.php",
    data: {
      filtro: filtro,
    },
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
      // Creamos las columnas de nuestra tabla modelos
      if (filtro == 1) {
        var columns = [
          {
            mDataProp: "nombreModelo",
            width: 5,
          },
          {
            mDataProp: "nombreMarca",
            width: 5,
          },
          {
            mDataProp: "Cantidad",
            width: 5,
          },
          {
            className: "text-left",
            width: 50,
            render: function (data, types, full, meta) {
              let btnEliminar = `<div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" onchange="boton(this)">
              </div>`;
              return `${btnEliminar}`;
            },

            
          },
        ];
        // Llamado a la función para crear la tabla con los datos
        cargarTabla("#tablaModelos", respuesta, columns);
      } else {
        modelos = respuesta;
        console.log(modelos);
      }
    },
  });
}
