$(document).ready(function () {
    tablaDiarios = $("#tablaDiarios").DataTable({
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

    $("#btnNuevo").click(function () {
        $("#formDiario").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Registrar Nuevo ");
        $("#modalCRUD").modal("show");
        IdDiario = null;
        opcion = 1 //alta
    });

    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        IdDiario = parseInt(fila.find('td:eq(0)').text());
        Detalle = fila.find('td:eq(4)').text();
        $("#Detalle").text(Detalle);
        opcion = 2 //editar
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Registro");
        $("#modalCRUD").modal("show");
    });

    $("#formDiario").submit(function (e) {
        //e.preventDefault();
        IdUsuario = $.trim($("#IdUsuario").val());
        IdEmpresa = $.trim($("#IdEmpresa").val());
        cmbtipo_diario = $.trim($("#idcmbtipo_diario").val());
        cmbcategoria = $.trim($("#idcmbcategoria").val());
        cmbtercero = $.trim($("#idcmbtercero").val());
        Fecha = $.trim($("#Fecha").val());
        Detalle = $.trim($("#Detalle").val());
        Valor = $.trim($("#Valor").val());
        $.ajax({
            url: "clases/diario.php",
            type: "POST",
            dataType: "json",
            data: { IdUsuario: IdUsuario, IdEmpresa: IdEmpresa, cmbtipo_diario: cmbtipo_diario, cmbcategoria: cmbcategoria, cmbtercero: cmbtercero, Fecha: Fecha, Detalle: Detalle, Valor: Valor, IdDiario: IdDiario, opcion: opcion },
            success: function (data) {
               console.log(data);
            }
        });
        $("#modalCRUD").modal("hide");
    });
    
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        IdDiario = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3; //borrar
        var respuesta = confirm("Para recuperar registros eliminados contacte con el DBA del Sistema. Desea continuar y eliminar el registro: " + IdDiario + "?");
        if (respuesta) {
            $.ajax({
                url: "clases/diario.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, IdDiario: IdDiario },
                success: function () {
                    tablaObras.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });

    
});