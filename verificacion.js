$(document).ready(function () {
    tablaUsuarios = $("#tablaJustificantes").DataTable({
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnVerificar'>Verificar</button></div></div>"
        }],

        //Para cambiar el lenguaje a español
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

    //botón VERIFICAR   
    $(document).on("click", ".btnVerificar", function () {
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        boleta = fila.find('td:eq(1)').text();
        usuario = fila.find('td:eq(2)').text();
        email = fila.find('td:eq(3)').text(); //revisar si jala el email
        statuss = fila.find('td:eq(2)').text();
        es_admin = parseInt(fila.find('td:eq(4)').text()); //revisar si es int o text

        $("#id").val(id);
        $("#boleta").val(boleta);
        $("#usuario").val(usuario);
        $("#email").val(email);
        $("#es_admin").val(es_admin);
        $("#statuss").val(statuss);
        opcion = 2; //editar

        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Persona");
        $("#modalCRUD").modal("show");

    });

    $("#formSolicitudes").submit(function (e) {
        e.preventDefault();

        id = $.trim($("#id").val());
        boleta = $.trim($("#boleta").val());
        usuario = $.trim($("#usuario").val());
        email = $.trim($("#email").val());
        es_admin = $.trim($("#es_admin").val());
        statuss = $.trim($("#statuss").val());

        $.ajax({
            url: "crud_justificantes.php",
            type: "POST",
            dataType: "json",
            data: { boleta: boleta, usuario: usuario, email: email, es_admin: es_admin, statuss:statuss, id: id, opcion: opcion },
            success: function (data) {
                console.log(data);
                id = data[0].id;
                boleta = data[0].boleta;
                usuario = data[0].usuario;
                email = data[0].email;
                es_admin = data[0].es_admin;
                statuss = data[0].es_admin;
                if (opcion == 1) { tablaUsuarios.row.add([id, boleta, usuario, email, es_admin,statuss]).draw(); }
                else { tablaUsuarios.row(fila).data([id, boleta, usuario, email, es_admin,statuss]).draw(); }
            }
        });
        $("#modalCRUD").modal("hide");

    });
});