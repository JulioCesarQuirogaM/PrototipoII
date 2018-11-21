function unidads(){    
    //////////////////////////// Generar Tabla de Consulta 
    var dt = $("#tablaUnidad").DataTable({
            "ajax": "./Controlador/controladorUnidad.php?accion=listar",
            "columns": [
                { "data": "unidadres_ID"},
                { "data": "ciudad_Nomb"},
                { "data": "unidadres_Nomb"},
                { "data": "unidadres_Dir"},
                { "data": "unidadres_Tel"},
                { "data": "estado"},
                { "data": "unidadres_ID",
                
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
        $(".box-title").html("Listado de unidades");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })  

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear Unidad");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/unidades/nuevaUnidadResidencial.php', function(){
            $.ajax({
               type:"get",
               url:"./Controlador/controladorCiudad.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #ciudad_ID").append("<option value='" + value.ciudad_ID + "'>" + value.ciudad_Nomb + "</option>")
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
      var datos=$("#funidad").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorUnidad.php",
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
                    $(".box-title").html("Listado de Unidades");
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
         var datos=$("#funidad").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorUnidad.php",
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
                $(".box-title").html("Listado de Unidades");
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
                        url: "./Controlador/controladorUnidad.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })
                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'La Unidad con codigo ' + codigo + ' fue borrado',
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
       var ciudad_Uni;
       $(".box-title").html("Actualizar Unidad")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/unidades/editarUnidadResidencial.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorUnidad.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( unidad ) {        
                    if(unidad.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'unidad no existe!'                         
                        })
                    } else {
                        $("#unidadres_ID").val(unidad.codigo);
                        ciudad_Uni = unidad.ciudad_Uni;                   
                        $("#unidadres_Nomb").val(unidad.unidad_Nom);
                        $("#unidadres_Dir").val(unidad.unidad_Dire);
                        $("#unidadres_Tel").val(unidad.unidadres_Tele);
                        estados = unidad.estados;

                        
                    }
            });
 
            $.ajax({
                type:"get",
                url:"./Controlador/controladorCiudad.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(ciudad_Uni === value.ciudad_ID){
                    $("#editar #ciudad_ID").append("<option selected value='" + value.ciudad_ID + "'>" + value.ciudad_Nomb + "</option>")
                }else {
                    $("#editar #ciudad_ID").append("<option value='" + value.ciudad_ID + "'>" + value.ciudad_Nomb + "</option>")
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
