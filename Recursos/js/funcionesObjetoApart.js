function ObjetoApart(){    
    //////////////////////////// Generar Tabla de Consulta 
    var dt = $("#tablaObjApart").DataTable({
            "ajax": "./Controlador/controladorObjetoApart.php?accion=listar",
            "columns": [
                { "data": "objetoxapto_ID"},
                { "data": "objeto_ID"},
                { "data": "persona_ID"},
                { "data": "Fecha_Entrada"},
                { "data": "Fecha_salida"},
                
                { "data": "bloque_ID",
                
                    render: function (data) {
                              return '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                              +      '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>'
                    }
                }
            ]
      });
  

    ///////////////////////////////////////

}