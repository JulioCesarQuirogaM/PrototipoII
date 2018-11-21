function vigilante
      var dt = $("#tabla").DataTable({
            "ajax": "./Controlador/controladorVigilante.php?accion=listar",
            "columns": [
                { "data": "vigilante_ID"} ,
                { "data": "vigilante_Nomb" },
                { "data": "unidadres_ID" },
                { "data": "objeto_ID" },
                { "data": "fecha_Entrada" },
                { "data": "fecha_Salida" },
                { "data": "vigilante_ID",
                    render: function (data) {
                              return '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                              +      '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>'
                    }
                }
            ]
      });
///////////////////
    $("#editar").on("click",".btncerrar", function(){
        $(".box-title").html("Listado de Vigilantes");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })  
/////////////////
    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear Vigilante");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/vigilante/nuevoVigilante.php', function(){
            $.ajax({
               type:"get",
               url:"./Controlador/controladorVigilante.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #vigilante_ID").append("<option value='" + value.vigilante_ID + "'>" + value.muni_nomb + "</option>")
                });
            });
        });
        
    })

    $("#editar").on("click","button#grabar",function(){
      var datos=$("#fvigilante").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorVigilante.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'El vigilante fue grabado con éxito',
                    showConfirmButton: false,
                    timer: 1200
                })     
                    $(".box-title").html("Listado de Vigilante");
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
         var datos=$("#fvigilante").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorVigilante.php",
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
                $(".box-title").html("Listado de Vigilantes");
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
              text: "¿Realmente desea borrar el vigilante con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {
                    var request = $.ajax({
                        method: "get",                  
                        url: "./Controlador/controladorVigilante.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })
                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'El vigilante con codigo ' + codigo + ' fue borrado',
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
       //$("#titulo").html("Editar Vigilante");
       //Recupera datos del formulario
       var codigo = $(this).data("codigo");
       var vigilante;
       $(".box-title").html("Actualizar Vigilante")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/vigilante/editarVigilante.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorVigilante.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( vigilante ) {        
                    if(vigilante.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Vigilante no existe!'                         
                        })
                    } else {
                        $("#vigilante_ID").val(vigilante_ID);                   
                        $("#vigilante_Nomb").val(vigilante.vigilante);
                          unidad = vigilante.unidad;
                    }
            });
 
            $.ajax({
                type:"get",
                url:"./Controlador/controladorVigilante.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(vigilante === value.vigilante_ID){
                    $("#editar #vigilante_ID").append("<option selected value='" + value.vigilante_ID + "'>" + value.muni_nomb + "</option>")
                }else {
                    $("#editar #vigilante_ID").append("<option value='" + value.vigilante_ID + "'>" + value.muni_nomb + "</option>")
                }
                });
            });
        });
    })
}
