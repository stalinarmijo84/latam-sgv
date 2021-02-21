$(document).ready(function() {
    tablaCategorias = $("#tablaCategorias").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"
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
        $("#formCategorias").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Registrar Nuevo ");
        $("#modalCRUD").modal("show");
        IdCategoria = null;
        opcion = 1 //alta
    });

    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function() {
        fila = $(this).closest("tr");
        IdCategoria = parseInt(fila.find('td:eq(0)').text());
        Descripcion = fila.find('td:eq(2)').text();
        $("#Descripcion").val(Descripcion);
        opcion = 2 //editar
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Registro");
        $("#modalCRUD").modal("show");
    });

    /*
    $(document).on("click", ".btnBorrar", function() {
        fila = $(this);
        IdEmpresa = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + IdEmpresa + "?");
        if (respuesta) {
            $.ajax({
                url: "clases/empresa.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, IdEmpresa: IdEmpresa },
                success: function() {
                    tablaEmpresas.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });*/

    $("#formCategorias").submit(function(e) {
        //e.preventDefault();
        cmbempresa = $.trim($("#idcmbempresa").val());
        Descripcion = $.trim($("#Descripcion").val());
        $.ajax({
            url: "clases/categoria.php",
            type: "POST",
            dataType: "json",
            data: { cmbempresa:cmbempresa, Descripcion:Descripcion, IdCategoria:IdCategoria, opcion:opcion },
            success: function(data) {
                console.log(data);
            }
        });
        $("#modalCRUD").modal("hide");
    });
});
