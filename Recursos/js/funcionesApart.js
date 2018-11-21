function apartamentos(){    
    //////////////////////////// Generar Tabla de Consulta 
    var dt = $("#tablaApart").DataTable({
            "ajax": "./Controlador/controladorApart.php?accion=listar",
            "columns": [
                { "data": "apart_ID"},
                { "data": "unidadres_Nomb"},
                { "data": "bloque_Descrip"},
                { "data": "apart_Sigla"},
                { "data": "estado"},           
                { "data": "apart_ID",
                
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
        $(".box-title").html("Listado de Apartamentos");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })  

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear Apartamento");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/apartamento/nuevoApartamento.php', function(){
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
               url:"./Controlador/controladorEstado.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #estado_ID").append("<option value='" + value.estado_ID + "'>" + value.estado + "</option>")
                });
            });


        });
        
    })

    $("#editar").on("click","button#grabar",function(){
      var datos=$("#fapart").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorApart.php",
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
                    $(".box-title").html("Listado de Apartamentos");
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
         var datos=$("#fapart").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorApart.php",
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
                $(".box-title").html("Listado de Apartamentos");
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
              text: "¿Realmente desea borrar el Apartamento con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {
                    var request = $.ajax({
                        method: "get",                  
                        url: "./Controlador/controladorApart.php",
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
       var unidades;
       var bloques;
       var estados;
       
       $(".box-title").html("Actualizar Apartamento")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/apartamento/editarApartamento.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorApart.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( apartamento ) {        
                    if(apartamento.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Zona no existe!'                         
                        })
                    } else {
                        $("#apart_ID").val(apartamento.codigo); 
                        unidades = apartamento.unidades;
                        bloques = apartamento.bloques;                
                        $("#apart_Sigla").val(apartamento.apartSigla);
                        estados = apartamento.estados;
                        
                    }
            });
 
            $.ajax({
                type:"get",
                url:"./Controlador/controladorUnidad.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(unidades === value.unidadres_ID){
                    $("#editar #unidadres_ID").append("<option selected value='" + value.unidadres_ID + "'>" + value.unidadres_Nomb + "</option>")
                }else {
                    $("#editar #unidadres_ID").append("<option value='" + value.unidadres_ID + "'>" + value.unidadres_Nomb + "</option>")
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
                url:"./Controlador/controladorEstado.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(estados === value.estado_ID){
                    $("#editar #estado_ID").append("<option selected value='" + value.estado_ID + "'>" + value.estado + "</option>")
                }else {
                    $("#editar #estado_ID").append("<option value='" + value.estado_ID + "'>" + value.estado + "</option>")
                }
                });
            });
        });
    })
  

    ///////////////////////////////////////

}