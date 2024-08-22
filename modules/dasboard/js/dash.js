let pro;
$(document).ready(function () {
     listarTarjetas();
     listarPorCategorias();
     listarPorProyecto();
     listarProyectos();
       
     $("#project").on("change", function() {
      pro = $(this).val();
      console.log("id:"+pro);
      if (pro != -1) {
          $("#btnReport").prop("disabled", false);
      } else {
          $("#btnReport").prop("disabled", true);
      }
  });

  $("#btnReport").on("click", function () {
        // Lógica para abrir el reporte
    console.log(pro);
      if(pro!=-1){
        const url = `./modules/dasboard/Reports/EquipoGeneralDash.php?ids=${pro}`;
        // Abre la URL en una nueva ventana/pestaña
        window.open(url, '_blank');
      }else{
        Swal.fire({
          title: 'Ups',
          text: 'Debe seleccionar un proyecto',
          icon: 'warning',
          confirmButtonText: 'Ok'
      });
      }
});





  });
  
  
  
  function listarTarjetas() {
    // POST  // GET   POST -Envia Recibe   | GET RECEPCIÓ
    $.ajax({
      type: "GET",
      url: "./modules/dasboard/controllers/listarEquipoPorGrupo.php",
      data: {},
      // Error en la petición
      error: function (error) {
        console.log(error);
      },
      // Petición exitosa
      success: function (respuesta) {
        let datos = JSON.parse(respuesta);
        datos.forEach((e) => {
          switch (e.descripcion) {
            case "lineas":
                    $("#cantidadLinea").text(e.disponible)
                break;
            case "equipo":
                    $("#cantidadEquipo").text(e.disponible)
                break;
            case "kit":
                    $("#cantidadKit").text(e.disponible)
                break;
            
          
            default:
                break;
          }
        });
      },
    });
  }
  
  function listarPorCategorias() {
    // POST  // GET   POST -Envia Recibe   | GET RECEPCIÓ
    let categoria =[];
    let cantidad =[];
    $.ajax({
      type: "GET",
      url: "./modules/dasboard/controllers/listarEquipoPorCategoria.php",
      data: {},
      // Error en la petición
      error: function (error) {
        console.log(error);
      },
      // Petición exitosa
      success: function (respuesta) {
        let datos = JSON.parse(respuesta);
        datos.forEach((e) => {
            cantidad.push(e.cantidad);
            categoria.push(e.nombreCategoria);
        });

        new ApexCharts(document.querySelector("#barChart"), {
            series: [{
                data:cantidad,
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: categoria,
            }
        }).render();
  
        
      },
    });
  }

  function listarPorProyecto() {
    // POST  // GET   POST -Envia Recibe   | GET RECEPCIÓ
    let categoria =[];
    let cantidad =[];
    $.ajax({
      type: "GET",
      url: "./modules/dasboard/controllers/listarEqipoPorProyecto.php",
      data: {},
      // Error en la petición
      error: function (error) {
        console.log(error);
      },
      // Petición exitosa
      success: function (respuesta) {
        let datos = JSON.parse(respuesta);
        datos.forEach((e) => {
            cantidad.push(parseInt(e.cantidad));
            categoria.push(e.proyecto);
        });
       

        new ApexCharts(document.querySelector("#donutChart"), {
            series:cantidad,
            chart: {
                height: 350,
                type: 'donut',
                toolbar: {
                    show: true
                }
            },
            labels: categoria,
        }).render();
  
        
      },
    });
  }

  function listarProyectos() {
  // POST  // GET   POST -Envia Recibe   | GET RECEPCIÓ
  $.ajax({
    type: "GET",
    url: "./modules//Generales/controllersGenerales/listarProyectos.php",
    data: {},
    // Error en la petición
    error: function (error) {
      console.log(error);
    },
    // Petición exitosa
    success: function (respuesta) {
      let datos = JSON.parse(respuesta);
      datos.forEach((e) => {
        $("#project").append(
          `<option value="${e.proyectoID}">${e.nombreProyecto}</option>`
        );
      });
    },
  });
}

  
  
  
  