$(document).ready(function () {

    listarCategorias();
    listarUsuarios();
    listarEquipo();

    $("#categoriaID").on("change",function(){
        let cod =$("#categoriaID option:selected").attr("data-codigo");

        $("#codCategoria").val(cod);
    });
    $("#usuarioID").on("change",function(){
        let cod =$("#usuarioID option:selected").attr("data-codigo");

        $("#codUsuario").val(cod);
    });
    $("#equipoID").on("change",function(){
      let cod =$("#equipoID option:selected").attr("data-codigo");

      $("#codEquipo").val(cod);
    });
    // evento click del botón guardar
    $("#btnGuardarAsignacion").on("click", function () {
      let losDatos = {
        categoriaID :  $("#categoriaID").val(),
        categoriaID1 :  $("#categoriaID option:selected").text(),
        equipoID: $("#equipoID").val(),
        equipoID1:  $("#equipoID option:selected").text(),
        usuarioID: $("#usuarioID").val(),
        usuarioID1:  $("#usuarioID option:selected").text(),
      };
      let errores = [];
      // Verificar si hay errores
    // Validar precioAdquisicion
   
    // Validar ubicacionID
    if (losDatos.equipoID1 == "Selecciona un equipo") {
      errores.push("Debe seleccionar un equipo.");
    }
    if (losDatos.usuarioID1 == "Selecciona un usuario") {
      errores.push("Debe seleccionar un equipo.");
    }
    if (losDatos.categoriaID1 == "Selecciona una categoria") {
      errores.push("Debe seleccionar un equipo.");
    }
  
  // Puedes agregar más validaciones para otros campos según tus necesidades
  
  // Verificar si hay errores
  if (errores.length > 0) {
    let mensajeError = "Error en los siguientes campos:\n" + errores.join("\n");
    swal.fire(
      "Seccion de Equipo",
      mensajeError,
      "warning"
    );
  } else {
    console.log(losDatos);
    guardarDatos(losDatos);
  }
    });
    // evento change del select
    $("#usuarioID").on("change", function () {
      const valor = $("#usuarioID").val();
      console.log(valor);
    });
    $("#categoriaID").on("change", function () {
      const valor = $("#categoriaID").val();
      console.log(valor);
    });
    $("#equipoID").on("change", function () {
      const valor = $("#equipoID").val();
      console.log(valor);
    });
  
  });
  
  function guardarDatos(losDatos) {
    $.ajax({
      type: "POST", // POST  // GET   POST -Envia Recibe   | GET RECEPCIÓN
      url: "./modules/Asignaciones/controllers/agregarAsignacion.php",
      data: {
        losDatos: losDatos,
      },
      // Error en la petición
      error: function (error) {
        console.log(error);
      },
      // Petición exitosa
      success: function (respuesta) {
        console.log(respuesta);
        const resp = JSON.parse(respuesta);
        console.log(resp);
  
        if (resp[0].status == "200") {
          swal.fire("Seccion asignaciones", "Asignacion registrado Correctamente", "success");
        }else{
          swal.fire("Seccion asignaciones", respuesta, "warning");
        }
      },
    });
  }
  
  function listarUsuarios() {
    // POST  // GET   POST -Envia Recibe   | GET RECEPCIÓ
    $.ajax({
      type: "GET",
      url: "./modules/Asignaciones/controllers/listarUsuariosM.php",
      data: {},
      // Error en la petición
      error: function (error) {
        console.log(error);
      },
      // Petición exitosa
      success: function (respuesta) {
         
        let datos = JSON.parse(respuesta);
        datos.forEach((e) => {
          $("#usuarioID").append(
            `<option value="${e.usuarioID}" data-codigo="${e.codigoUsuario}">${e.nombre}</option>`
          );
        });
      },
    });
  }
  
  function listarCategorias() {
      // POST  // GET   POST -Envia Recibe   | GET RECEPCIÓ
      $.ajax({
        type: "GET",
        url: "./modules/Equipo/controllers/ctrl_listarcategorias.php",
        data: {},
        // Error en la petición
        error: function (error) {
          console.log(error);
        },
        // Petición exitosa
        success: function (respuesta) {
           
          let datos = JSON.parse(respuesta);
          datos.forEach((e) => {
            $("#categoriaID").append(
              `<option value="${e.categoriaID}" data-codigo ="${e.codigoCategoria}">${e.descripcion}</option>`
            );
          });
        },
      });
  }
  function listarEquipo() {
    // POST  // GET   POST -Envia Recibe   | GET RECEPCIÓ
    $.ajax({
      type: "GET",
      url: "./modules/Asignaciones/controllers/listarEquipoM.php",
      data: {},
      // Error en la petición
      error: function (error) {
        console.log(error);
      },
      // Petición exitosa
      success: function (respuesta) {
         
        let datos = JSON.parse(respuesta);
        datos.forEach((e) => {
          $("#equipoID").append(
            `<option value="${e.equipoID}" data-codigo ="${e.codigoEquipo}">${e.descripcionGeneral}</option>`
          );
        });
      },
    });
}