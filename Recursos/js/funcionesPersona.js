function personas(){

      var dt = $("#tablaPersona").DataTable({
            "ajax": "./Controlador/controladorPersona.php?accion=listar",
            "columns": [
                { "data": "persona_ID"} ,
                { "data": "ciudad_Nomb"},
                { "data": "persona_Nomb" },
                { "data": "persona_Apel" },
                { "data": "sexo"} ,
                { "data": "persona_Cel" },
                { "data": "persona_Mail" },
                { "data": "apart_Sigla" },
                { "data": "rol_Descripcion" },
                { "data": "persona_ID",

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
        $(".box-title").html("Listado de Personas");
        $("#editar").addClass('hide');
        $("#editar").removeClass('show');
        $("#listado").addClass('show');
        $("#listado").removeClass('hide');  
        $(".box #nuevo").show(); 
    })  

    $(".box").on("click","#nuevo", function(){
        $(this).hide();
        $(".box-title").html("Crear Persona");
        $("#editar").addClass('show');
        $("#editar").removeClass('hide');
        $("#listado").addClass('hide');
        $("#listado").removeClass('show');
        $("#editar").load('./Vistas/Personas/nuevaPersona.php', function(){
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
               url:"./Controlador/controladorRol.php",
               data: {accion:'listar'},
               dataType:"json"
            }).done(function( resultado ) {                    ;
                $.each(resultado.data, function (index, value) { 
                  $("#editar #rol_ID").append("<option value='" + value.rol_ID + "'>" + value.rol_Descripcion + "</option>")
                });
            });


        });
        
    })

    $("#editar").on("click","button#grabar",function(){
      var datos=$("#fpersona").serialize();
      //console.log(datos);
      $.ajax({
            type:"get",
            url:"./Controlador/controladorPersona.php",
            data: datos,
            dataType:"json"
          }).done(function( resultado ) {
              if(resultado.respuesta){
                swal({
                    position: 'center',
                    type: 'success',
                    title: 'La Persona fue Guardada con éxito',
                    showConfirmButton: false,
                    timer: 1200
                })     
                    $(".box-title").html("Listado de Personas");
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
         var datos=$("#fpersona").serialize();
         console.log(datos);
         $.ajax({
            type:"get",
            url:"./Controlador/controladorPersona.php",
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
                $(".box-title").html("Listado de Personas");
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
              text: "¿Realmente desea borrar La Persona con codigo : " + codigo + " ?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Borrarlo!'
        }).then((decision) => {
                if (decision.value) {
                    var request = $.ajax({
                        method: "get",                  
                        url: "./Controlador/controladorPersona.php",
                        data: {codigo: codigo, accion:'borrar'},
                        dataType: "json"
                    })
                    request.done(function( resultado ) {
                        if(resultado.respuesta == 'correcto'){
                            swal({
                              position: 'center',
                              type: 'success',
                              title: 'La Persona con codigo ' + codigo + ' fue borrado',
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
       var ciudads;
       /*var nombres;
       var apellidos;
       var Sexo;
       var Contacto;
       var Mail;*/
       var apartamentos;
       var rols;
       
       $(".box-title").html("Actualizar Persona")
       $("#editar").addClass('show');
       $("#editar").removeClass('hide');
       $("#listado").addClass('hide');
       $("#listado").removeClass('show');
       $("#editar").load("./Vistas/Personas/editarPersona.php",function(){
            $.ajax({
                type:"get",
                url:"./Controlador/controladorPersona.php",
                data: {codigo: codigo, accion:'consultar'},
                dataType:"json"
                }).done(function( persona ) {        
                    if(persona.respuesta === "no existe"){
                        swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Zona no existe!'                         
                        })
                    } else {
                        $("#persona_ID").val(persona.codigo);
                        ciudads = persona.ciudads;                   
                        $("#persona_Nomb").val(persona.nombres);
                        $("#persona_Apel").val(persona.apellidos);
                        $("#sexo").val(persona.Sexo);                   
                        $("#persona_Cel").val(persona.Contacto);                   
                        $("#persona_Mail").val(persona.Mail);
                        apartamentos = persona.apartamentos;
                        rols = persona.rols;
                        
                    }
            });
 
            $.ajax({
                type:"get",
                url:"./Controlador/controladorCiudad.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(ciudads === value.ciudad_ID){
                    $("#editar #ciudad_ID").append("<option selected value='" + value.ciudad_ID + "'>" + value.ciudad_Nomb + "</option>")
                }else {
                    $("#editar #ciudad_ID").append("<option value='" + value.ciudad_ID + "'>" + value.ciudad_Nomb + "</option>")
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

            $.ajax({
                type:"get",
                url:"./Controlador/controladorRol.php",
                data: {accion:'listar'},
                dataType:"json"
            }).done(function( resultado ) {                      
                $.each(resultado.data, function (index, value) { 
                if(rols === value.rol_ID){
                    $("#editar #rol_ID").append("<option selected value='" + value.rol_ID + "'>" + value.rol_Descripcion + "</option>")
                }else {
                    $("#editar #rol_ID").append("<option value='" + value.rol_ID + "'>" + value.rol_Descripcion + "</option>")
                }
                });
            });
        });
    })
  

    ///////////////////////////////////////

}