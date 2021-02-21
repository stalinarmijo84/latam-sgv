$(document).ready(function() {
    tablaOperaciones = $("#tablaOperaciones").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='Editar btn btn-primary btnEditar' id='btnEditar' data-toggle='modal' data-target='#modalUpdate'>Editar</button><button id='btnBorrar' class='eliminar btn btn-danger btnBorrar' data-toggle='modal' data-target='#modalEliminar'>Borrar</button></div></div>"
        }],

        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }
    });
    

    $("#btnNuevo").click(function() {
        $("#formAgregar").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Registrar Nuevo ");
        $("#modalCRUD").modal("show");
        //IdOperario = null;
    });
   
    $(document).ready(function() {
        $("#formAgregar").submit(InsertarImg) 
        function InsertarImg(e){
            //e.preventDefault();
            var datos = new FormData($("#formAgregar")[0])
            $.ajax({
                url: "clases/admin/datatable_agregar.php",
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                success: function(datos){
                    console.log(datos);
                }
            })
            $("#modalCRUD").modal("hide");
        }
    });

    //Eliminar

    $("#btnBorrar").click(function(){
        $(".modal-header").css("background-color", "#f83030");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Eliminar imagen ");
        $("#modalEliminar").modal("show");
    });

    let obtData = function (tbody, table){
        $(tbody).on("click","button.eliminar", function(){
            let data = table.row($(this).parents("tr")).data()
            $("#formEliminar #idImg").val(data[0])
            let ruta = data[8].substring(23)
            let rutaImg = ruta.split('"',1)
            $("#formEliminar #rutaImg").val(rutaImg)
            $("#formEliminar #Fecha").text(data[5])
        })
    }
    obtData("#tablaOperaciones tbody",tablaOperaciones)

    $(document).ready(function(){
        $("#formEliminar").submit(function EliminarImgBd(e){
            let datos = new FormData($("#formEliminar")[0])
            $.ajax({
                url: "clases/admin/datatable_eliminar.php",
                method: "POST",
                data: datos,
                contentType: false,
                processData: false,
                success: function(idImg){
                    console.log(idImg);
                }
            })
            $("#modalEliminar").modal("hide");
        })
    })

    //Actualizar

    $("#btnEditar").click(function(){
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Actualizar registro ");
        $("#modalUpdate").modal("show");
    });
    let obtDataEditar = function (tbody, table){
        $(tbody).on("click","button.Editar", function(){
            let data = table.row($(this).parents("tr")).data()
            let ruta = data[8].substring(23)
            let rutaImg = ruta.split('"',1)
            $("#formUpdate #rImagen").val(rutaImg)
            $("#formUpdate #idImagen").val(data[0])
            $("#formUpdate #Fecha").val(data[5])
            $("#formUpdate #Horas").val(data[6])
            $("#formUpdate #Combustible").val(data[7])
            console.log(data)
        })
    }
    obtDataEditar("#tablaOperaciones tbody",tablaOperaciones)

    $(document).ready(function(){
        $("#formUpdate").submit(actualizarImg)
        function actualizarImg(e){
            let datos = new FormData($("#formUpdate")[0])
            $.ajax({
                url: "clases/admin/datatable_actualizar.php",
                method: "POST",
                data: datos,
                contentType: false,
                processData: false,
                success: function(idImg){
                    console.log(idImg);
                }
            })
            $("#modalUpdate").modal("hide");
        }
    })
});