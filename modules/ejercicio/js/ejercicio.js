$(document).ready(function() {

    listarCorreos();


 // evento click del botón guardar
 $("#btnGuardar").on("click",function(){
   
    let losDatos ={
        email : $("#email").val(),
        passowrd: $("#password").val(),
        id : $("#listaCorreo").val()
    }

    if(losDatos.email =="" || losDatos.passowrd ==""){
        swal.fire("Ejercicio","Error debe ingresar los datos","warning");
    }else{
        console.log(losDatos);
        guardarDatos(losDatos);
    }

 });

 // evento change del select
 $("#listaCorreo").on("change",function(){
    const valor = $("#listaCorreo").val();
    console.log(valor);
 });


});

function guardarDatos(losDatos){
    $.ajax({
        type: "POST",  // POST  // GET   POST -Envia Recibe   | GET RECEPCIÓN
        url: "./modules/ejercicio/controllers/agregar.php",
        data: {
          losDatos:losDatos
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

            if(resp[0].status =="200"){
                swal.fire("Ejercicio","Correo registrado Correctamente","success");
            }
        },
      });
}

function listarCorreos(){ // POST  // GET   POST -Envia Recibe   | GET RECEPCIÓ
    $.ajax({
        type: "GET",  
        url: "./modules/ejercicio/controllers/listarCorreo.php",
        data: {},
        // Error en la petición
        error: function (error) {
            console.log(error);
        },
        // Petición exitosa
        success: function (respuesta) {
            
            let datos = JSON.parse(respuesta);       
            datos.forEach(e => {
                $("#listaCorreo").append(`<option value="${e.id}">${e.correo}</option>`)
            });
        },
      });
}