function vehiculoAparts(){    
    //////////////////////////// Generar Tabla de Consulta 
    var dt = $("#tablaVehiculoApart").DataTable({
            "ajax": "./Controlador/controladorVehiculoApart.php?accion=listar",
            "columns": [
                { "data": "vehiculoApart_ID"},
                { "data": "vehiculo_Descrip"},
                { "data": "placa"},
                { "data": "persona_Nomb"},
                { "data": "bloque_Descrip"},
                { "data": "apart_Sigla"},                
                { "data": "vehiculoApart_ID",
                
                    render: function (data) {
                              return '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                              +      '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>'
                    }
                }
            ]
      });

    $("#editar").on("click",".btncerrar", function(){
        $(".box-title").html("Listado de Vehiculos por Apartamento");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })  

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear Vehiculos por Apartamento");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/vehiculoApartamento/nuevoVehiculoApart.php', function(){
            $.ajax({
               type:"get",
               url:"./Controlador/controladorVehiculo.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #vehiculo_ID").append("<option value='" + value.vehiculo_ID + "'>" + value.vehiculo_Descrip + "</option>")
                });
            });

            $.ajax({
               type:"get",
               url:"./Controlador/controladorPersona.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #persona_ID").append("<option value='" + value.persona_ID + "'>" + value.persona_Nomb + "</option>")
                });
            });

            $.ajax({
               type:"get",
               url:"./Controlador/controladorBloque.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #bloque_ID").append("<option value='" + value.bloque_ID + "'>" + value.bloque_Descrip + "</option>")
                });
            });

            $.ajax({
               type:"get",
               url:"./Controlador/controladorApart.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #apart_ID").append("<option value='" + value.apart_ID + "'>" + value.apart_Sigla + "</option>")
                });
            });

        });
        
    })

    $("#editar").on("click","button#grabar",function(){
      var datos=$("#fvehiculoApart").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorVehiculoApart.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'El Apartamento fue grabado con éxito',
                    showConfirmButton: false,
                    timer: 1200
                })     
                    $(".box-title").html("Listado de Vehiculos por Apartamento");
                    $(".box #nuevo").show();
                    $("#editar").html('');
                    $("#editar").addClass('hide');
                    $("#editar").removeClass('show');
                    $("#listado").addClass('show');
                    $("#listado").removeClass('hide');
                    dt.page( 'last' ).draw( 'page' );
                    dt.ajax.reload(null, false);                   
             } else {
                swal({
                    position: 'center',
                    type: 'error',
                    title: 'Ocurrió un erro al grabar',
                    showConfirmButton: false,
                    timer: 1500
                });
               
            }
        });
    });

    $("#editar").on("click","button#actualizar",function(){
         var datos=$("#fvehiculoApart").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorVehiculoApart.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
   
              if(resultado.respuesta){    
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'Se actaulizaron los datos correctamente',
                    showConfirmButton: false,
                    timer: 1500
                }) 
                $(".box-title").html("Listado de Vehiculos por Apartamentos");
                $("#editar").html('');
                $("#editar").addClass('hide');
                $("#editar").removeClass('show');
                $("#listado").addClass('show');
                $("#listado").removeClass('hide');
                dt.ajax.reload(null, false);       
             } else {
                swal({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Something went wrong!'                         
                })
            }
        });
    })

    $(".box-body").on("click","a.borrar",function(){
        //Recupera datos del formulario
        var codigo = $(this).data("codigo");
        
        swal({
              title: '¿Está seguro?',
              text: "¿Realmente desea borrar el Vehiculo del Apartamento con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {
                    var request = $.ajax({
                        method: "get",                  
                        url: "./Controlador/controladorVehiculoApart.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })
                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'El Apartamento con codigo ' + codigo + ' fue borrado',
                              showConfirmButton: false,
                              timer: 1500
                            })       
                            var info = dt.page.info();   
                            if((info.end-1) == info.length)
                                dt.page( info.page-1 ).draw( 'page' );
                            dt.ajax.reload(null, false);
                            
                        } else {
                            swal({
                              type: 'error',
                              title: 'Oops...',
                              text: 'Something went wrong!'                         
                            })
                        }
                    });
                     
                    request.fail(function( jqXHR, textStatus ) {
                        swal({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Something went wrong!' + textStatus                          
                        })
                    });
                }
        })

    });
    
    $(".box-body").on("click","a.editar",function(){       
       var codigo = $(this).data("codigo");
       var vehiculos ; //= $(this).data("vehiculos");
       var placaVehi = $(this).data("placaVehi");
       var personas; // = $(this).data("personas");
       var bloques; // = $(this).data("bloques");
       var apartamentos ; //= $(this).data("apartamentos");

       
       $(".box-title").html("Actualizar Vehiculo por Apartamento")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/vehiculoApartamento/editarVehiculoApart.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorVehiculoApart.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( vehiculoApart ) {        
                    if(vehiculoApart.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Zona no existe!'                         
                        })
                    } else {
                        $("#vehiculoApart_ID").val(vehiculoApart.codigo); 
                        vehiculos = vehiculoApart.vehiculos;
                        $("#placa").val(vehiculoApart.placaVehi);
                        personas = vehiculoApart.personas;                
                        bloques = vehiculoApart.bloques;
                        apartamentos = vehiculoApart.apartamentos;
                        
                    }
            });
 
            $.ajax({
                type:"get",
                url:"./Controlador/controladorVehiculo.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(vehiculos === value.vehiculo_ID){
                    $("#editar #vehiculo_ID").append("<option selected value='" + value.vehiculo_ID + "'>" + value.vehiculo_Descrip + "</option>")
                }else {
                    $("#editar #vehiculo_ID").append("<option value='" + value.vehiculo_ID + "'>" + value.vehiculo_Descrip + "</option>")
                }
                });
            });

            $.ajax({
                type:"get",
                url:"./Controlador/controladorPersona.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(personas === value.persona_ID){
                    $("#editar #persona_ID").append("<option selected value='" + value.persona_ID + "'>" + value.persona_Nomb + "</option>")
                }else {
                    $("#editar #persona_ID").append("<option value='" + value.persona_ID + "'>" + value.persona_Nomb + "</option>")
                }
                });
            });

            $.ajax({
                type:"get",
                url:"./Controlador/controladorBloque.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(bloques === value.bloque_ID){
                    $("#editar #bloque_ID").append("<option selected value='" + value.bloque_ID + "'>" + value.bloque_Descrip + "</option>")
                }else {
                    $("#editar #bloque_ID").append("<option value='" + value.bloque_ID + "'>" + value.bloque_Descrip + "</option>")
                }
                });
            });

            $.ajax({
                type:"get",
                url:"./Controlador/controladorApart.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(apartamentos === value.apart_ID){
                    $("#editar #apart_ID").append("<option selected value='" + value.apart_ID + "'>" + value.apart_Sigla + "</option>")
                }else {
                    $("#editar #apart_ID").append("<option value='" + value.apart_ID + "'>" + value.apart_Sigla + "</option>")
                }
                });
            });
        });
    })
  

    ///////////////////////////////////////

}