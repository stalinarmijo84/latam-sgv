$(document).ready(function () {
    tablaEmpleados = $("#tablaEmpleados").DataTable({
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
        $("#formEmpleados").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Registrar Nuevo ");
        $("#modalCRUD").modal("show");
        IdEmpleado = null;
        opcion = 1 //alta
    });

    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function () {
        fila = $(this).closest("tr");
        IdEmpleado = parseInt(fila.find('td:eq(0)').text());
        Nombres = fila.find('td:eq(2)').text();
        Apellidos = fila.find('td:eq(3)').text();
        Identificacion = fila.find('td:eq(4)').text();
        Direccion = fila.find('td:eq(5)').text();
        Telefono = fila.find('td:eq(6)').text();
        Email = fila.find('td:eq(7)').text();
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

    

    /*botón BORRAR
    $(document).on("click", ".btnBorrar", function () {
        fila = $(this);
        IdEmpleado = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + IdEmpleado + "?");
        if (respuesta) {
            $.ajax({
                url: "clases/empleado.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, IdEmpleado: IdEmpleado },
                success: function () {
                    tablaEmpleados.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });*/

    $("#formEmpleados").submit(function (e) {
        //e.preventDefault();
        cmbempresa = $.trim($("#idcmbempresa").val());
        Nombres = $.trim($("#Nombres").val());
        Apellidos = $.trim($("#Apellidos").val());
        Identificacion = $.trim($("#Identificacion").val());
        Direccion = $.trim($("#Direccion").val());
        Telefono = $.trim($("#Telefono").val());
        Email = $.trim($("#Email").val());
        cmbcargo = $.trim($("#idcmbcargo").val());
        $.ajax({
            url: "clases/empleado.php",
            type: "POST",
            dataType: "json",
            data: { cmbempresa:cmbempresa, Nombres:Nombres, Apellidos:Apellidos, Identificacion:Identificacion, Direccion:Direccion, Telefono:Telefono, Email:Email, cmbcargo:cmbcargo, IdEmpleado:IdEmpleado, opcion:opcion },
            success: function (data) {
                console.log(data);
            }
        });
        $("#modalCRUD").modal("hide");
    });
});