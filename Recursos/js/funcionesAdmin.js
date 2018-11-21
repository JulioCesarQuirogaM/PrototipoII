function root(){

      var dt = $("#tabla").DataTable({
            "ajax": "./Controlador/controladorComuna.php?accion=listar",
            "columns": [
                { "data": "comu_codi"} ,
                { "data": "comu_nomb" },
                { "data": "muni_nomb" },
                { "data": "comu_codi",
                    render: function (data) {
                              return '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                              +      '<a href="#" data-codigo="'+ data + 
                                     '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>'
                    }
                }
            ]
      });