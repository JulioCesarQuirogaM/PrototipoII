function inquilinoAparts(){    
    //////////////////////////// Generar Tabla de Consulta 
    var dt = $("#tablaInquilinoApart").DataTable({
            "ajax": "./Controlador/controladorInquilinoApart.php?accion=listar",
            "columns": [
                { "data": "inquilinoApart_ID"},
                { "data": "unidadres_Nomb"},
                { "data": "apart_Sigla"},
                { "data": "persona_Nomb"},
               // { "data": "propietarioApart_ID"},                
                { "data": "inquilinoApart_ID",
                
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
        $(".box-title").html("Listado de Inquilinos");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })  

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear Inquilinos");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/inquilinoApart/nuevoInquilinoApart.php', function(){
            $.ajax({
               type:"get",
               url:"./Controlador/controladorUnidad.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #unidadres_ID").append("<option value='" + value.unidadres_ID + "'>" + value.unidadres_Nomb + "</option>")
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

            /*$.ajax({
               type:"get",
               url:"./Controlador/controladorPropietarioApart.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #propietarioApart_ID").append("<option value='" + value.propietarioApart_ID + "'>" + value.persona_ID + "</option>")
                });
            });*/

        });
        
    })

    $("#editar").on("click","button#grabar",function(){
      var datos=$("#finquilinoApart").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorInquilinoApart.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'El Inquilino fue grabado con éxito',
                    showConfirmButton: false,
                    timer: 1200
                })     
                    $(".box-title").html("Listado de Inquilino");
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
                    title: 'Ocurrió un error al grabar',
                    showConfirmButton: false,
                    timer: 1500
                });
               
            }
        });
    });

    $("#editar").on("click","button#actualizar",function(){
         var datos=$("#finquilinoApart").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorInquilinoApart.php",
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
                $(".box-title").html("Listado Inquilinos");
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
              text: "¿Realmente desea borrar Inquilino con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {
                    var request = $.ajax({
                        method: "get",                  
                        url: "./Controlador/controladorInquilinoApart.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })
                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'El Inquilino con codigo ' + codigo + ' fue borrado',
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
       var unidades ; //= $(this).data("vehiculos");
       var apartamento ;//= $(this).data("placaVehi");
       var persona; // = $(this).data("personas");
      // var propietario; // = $(this).data("bloques");
              
       $(".box-title").html("Actualizar Inquilino")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/inquilinoApart/editarInquilinoApart.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorInquilinoApart.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( inquilinoApart ) {        
                    if(inquilinoApart.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Zona no existe!'                         
                        })
                    } else {
                        $("#inquilinoApart_ID").val(inquilinoApart.codigo); 
                        unidades = inquilinoApart.unidades;                        
                        apartamento = inquilinoApart.apartamento;                
                        persona = inquilinoApart.persona;
                      //  propietario = inquilinoApart.propietario;
                        
                    }
            });
 
            $.ajax({
                type:"get",
                url:"./Controlador/controladorUnidad.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(unidades === value.unidad_ID){
                    $("#editar #unidadres_ID").append("<option selected value='" + value.unidadres_ID + "'>" + value.unidadres_Nomb + "</option>")
                }else {
                    $("#editar #unidadres_ID").append("<option value='" + value.unidadres_ID + "'>" + value.unidadres_Nomb + "</option>")
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
                if(apartamento === value.apart_ID){
                    $("#editar #apart_ID").append("<option selected value='" + value.apart_ID + "'>" + value.apart_Sigla + "</option>")
                }else {
                    $("#editar #apart_ID").append("<option value='" + value.apart_ID + "'>" + value.apart_Sigla + "</option>")
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
                if(persona === value.persona_ID){
                    $("#editar #persona_ID").append("<option selected value='" + value.persona_ID + "'>" + value.persona_Nomb + "</option>")
                }else {
                    $("#editar #persona_ID").append("<option value='" + value.persona_ID + "'>" + value.persona_Nomb + "</option>")
                }
                });
            });

            /*$.ajax({
                type:"get",
                url:"./Controlador/controladorApart.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(propietario === value.propietarioApart_ID){
                    $("#editar #propietarioApart_ID").append("<option selected value='" + value.propietarioApart_ID + "'>" + value.persona_ID + "</option>")
                }else {
                    $("#editar #propietarioApart_ID").append("<option value='" + value.propietarioApart_ID + "'>" + value.persona_ID + "</option>")
                }
                });
            })*/;
        });
    })
  

    ///////////////////////////////////////

}