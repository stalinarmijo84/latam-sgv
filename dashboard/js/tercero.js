$(document).ready(function () {
    tablaTerceros = $("#tablaTerceros").DataTable({
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
        $("#formTerceros").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Registrar Nuevo ");
        $("#modalCRUD").modal("show");
        IdTercero = null;
        opcion = 1 //alta
    });

    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        IdTercero = parseInt(fila.find('td:eq(0)').text());
        //cmbtipo = fila.find('td:eq(1)').text();
        Nombres = fila.find('td:eq(2)').text();
        Apellidos = fila.find('td:eq(3)').text();
        Identificacion = fila.find('td:eq(4)').text();
        Direccion = fila.find('td:eq(5)').text();
        Telefono = fila.find('td:eq(6)').text();
        Email = fila.find('td:eq(7)').text();
        //$("#cmbtipo").val(cmbtipo);
        $("#Nombres").val(Nombres);
        $("#Apellidos").val(Apellidos);
        $("#Identificacion").val(Identificacion);
        $("#Direccion").val(Direccion);
        $("#Telefono").val(Telefono);
        $("#Email").val(Email);
        opcion = 2 //editar
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Registro");
        $("#modalCRUD").modal("show");
    });

     //botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        IdTercero = parseInt($(this).closest("tr").find('td:eq(0)').text());
        NombreTercero = ($(this).closest("tr").find('td:eq(2)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + NombreTercero + "?");
        if (respuesta) {
            $.ajax({
                url: "clases/tercero.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, IdTercero: IdTercero },
                success: function () {
                    tablaClientes.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });

    $("#formTerceros").submit(function (e) {
        //e.preventDefault();
        cmbtipo = $.trim($("#idcmbtipo").val());
        Nombres = $.trim($("#Nombres").val());
        Apellidos = $.trim($("#Apellidos").val());
        Identificacion = $.trim($("#Identificacion").val());
        Direccion = $.trim($("#Direccion").val());
        Telefono = $.trim($("#Telefono").val());
        Email = $.trim($("#Email").val());
        cmbtipo = $.trim($("#idcmbtipo").val());
        cmbiva = $.trim($("#idcmbiva").val());
        cmbrenta = $.trim($("#idcmbrenta").val());
        $.ajax({
            url: "clases/tercero.php",
            type: "POST",
            dataType: "json",
            data: { IdTercero:IdTercero, cmbtipo:cmbtipo ,Nombres:Nombres, Apellidos:Apellidos, Identificacion:Identificacion, Direccion:Direccion, Telefono:Telefono, Email:Email, opcion:opcion,cmbiva:cmbiva, cmbrenta:cmbrenta},
            success: function (data) {
                console.log(data);
            }
        });
        $("#modalCRUD").modal("hide");
    });
});