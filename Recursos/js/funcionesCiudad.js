function ciudads(){    
    //////////////////////////// Generar Tabla de Consulta 
    var dt = $("#tablaCiudad").DataTable({
            "ajax": "./Controlador/controladorCiudad.php?accion=listar",
            "columns": [
                { "data": "ciudad_ID"},
                { "data": "ciudad_Nomb"},
                { "data": "pais_Nomb"},
                { "data": "estado"},    
                { "data": "ciudad_ID",
                
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
        $(".box-title").html("Listado de Ciudades");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })  

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear Ciudad");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/ciudad/nuevaCiudad.php', function(){
            $.ajax({
               type:"get",
               url:"./Controlador/controladorPais.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #pais_ID").append("<option value='" + value.pais_ID + "'>" + value.pais_Nomb + "</option>")
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
      var datos=$("#fciudad").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorCiudad.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'La zona fue grabada con éxito',
                    showConfirmButton: false,
                    timer: 1200
                })     
                    $(".box-title").html("Listado de Ciudades");
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
         var datos=$("#fciudad").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorCiudad.php",
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
                $(".box-title").html("Listado de Ciudades");
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
              text: "¿Realmente desea borrar el registro con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {
                    var request = $.ajax({
                        method: "get",                  
                        url: "./Controlador/controladorCiudad.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })
                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'La Ciudad con codigo: ' + codigo + ' fue borrado',
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
                              text: 'Something !'                         
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
       //$("#titulo").html("Editar Comuna");
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       var estados;
       var paisCiudad;

       $(".box-title").html("Actualizar Ciudad")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/ciudad/editarCiudad.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorCiudad.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( ciudad ) {        
                    if(ciudad.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'ciudad no existe!'                         
                        })
                    } else {
                        $("#ciudad_ID").val(ciudad.codigo);                                          
                        $("#ciudad_Nomb").val(ciudad.nombre);
                        paisCiudad = ciudad.paisCiudad; 
                        estados = ciudad.estados;
                        
                    }
            });
 
            $.ajax({
                type:"get",
                url:"./Controlador/controladorPais.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(paisCiudad === value.pais_ID){
                    $("#editar #pais_ID").append("<option selected value='" + value.pais_ID + "'>" + value.pais_Nomb + "</option>")
                }else {
                    $("#editar #pais_ID").append("<option value='" + value.pais_ID + "'>" + value.pais_Nomb + "</option>")
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
                if(estados === value.pais_ID){
                    $("#editar #estado_ID").append("<option selected value='" + value.estado_ID + "'>" + value.estado + "</option>")
                }else {
                    $("#editar #estado_ID").append("<option value='" + value.estado_ID + "'>" + value.estado + "</option>")
                }
                });
            });
        });
    })

    //////////////////////////////////////////////

}