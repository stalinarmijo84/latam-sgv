$(document).ready(function() {
    tablaUsuarios = $("#tablaUsuarios").DataTable({
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
    var fila; //capturar la fila para editar o borrar el registro
    $("#btnNuevo").click(function() {
        $("#formUsuario").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Registrar Nuevo ");
        $("#modalCRUD").modal("show");
        IdUsuario = null;
        opcion = 1 //alta
    });
    
    $(document).on("click", ".btnBorrar", function() {
        fila = $(this);
        IdUsuario = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: " + IdUsuario + "?");
        if (respuesta) {
            $.ajax({
                url: "clases/usuario.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, IdUsuario: IdUsuario },
                success: function() {
                    tablaUsuarios.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });
    
    var fila; //capturar la fila para editar o borrar el registro

    //botón EDITAR    
    $(document).on("click", ".btnEditar", function() {
        fila = $(this).closest("tr");
        IdUsuario = parseInt(fila.find('td:eq(0)').text());
        Usuario = fila.find('td:eq(3)').text();
        Clave = fila.find('td:eq(4)').text();
        $("#Usuario").val(Usuario);
        $("#Clave").val(Clave);
        opcion = 2 //editar
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Registro");
        $("#modalCRUD").modal("show");
    });

    $(document).on("click", ".btnBorrar", function() {
        fila = $(this);
        IdUsuario = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        Swal.fire({
            type: "warning",
            title: "Debe ingresar un usuario y/o password",
          });
        var respuesta = confirm("¿Está seguro de eliminar el registro ?");
        if (respuesta) {
            $.ajax({
                url: "clases/usuario.php",
                type: "POST",
                dataType: "json",
                data: { opcion: opcion, IdUsuario: IdUsuario },
                success: function() {
                    tablaEmpresas.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });

    $("#formUsuarios").submit(function(e) {
        //e.preventDefault();
        cmbempresa = $.trim($("#idcmbempresa").val());
        cmbrol = $.trim($("#idcmbrol").val());
        Usuario = $.trim($("#Usuario").val());
        Clave = $.trim($("#Clave").val());
        cmbestado = $.trim($("#idcmbestado").val());
        $.ajax({
            url: "clases/usuario.php",
            type: "POST",
            dataType: "json",
            data: { cmbempresa: cmbempresa, cmbrol: cmbrol, Usuario: Usuario, Clave: Clave, cmbestado: cmbestado, IdUsuario: IdUsuario, opcion: opcion },
            success: function(data) {
                console.log(data);
            }
        });
        $("#modalCRUD").modal("hide");
    });

});