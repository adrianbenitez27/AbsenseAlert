$(document).ready(function () {
    tablaJustificantes = $("#tablaJustificantes").DataTable({
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
        opcion = 1; //editar
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        boleta = fila.find('td:eq(1)').text();
        nombre = fila.find('td:eq(2)').text();
        apellidoPat = fila.find('td:eq(3)').text(); //revisar si jala el email
        apellidoMat = fila.find('td:eq(4)').text(); //revisar si jala el email
        fechaIn = parseInt(fila.find('td:eq(5)').text()); //revisar si es int o text
        fechaTerm = fila.find('td:eq(6)').text();
        fechaSolic = fila.find('td:eq(7)').text();
        razon_ausen = fila.find('td:eq(8)').text();
        statuss = fila.find('td:eq(9)').text();

        $("#id").val(id);
        $("#boleta").val(boleta);
        $("#nombre").val(nombre);
        $("#apellido_pat").val(apellidoPat);
        $("#apellido_mat").val(apellidoMat);
        $("#fecha_ini").val(fechaIn);
        $("#fecha_fin").val(fechaTerm);
        $("#fecha_jus").val(fechaSolic);
        $("#razon_ausen").val(razon_ausen);
        $("#statuss").val(statuss);


        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar status");
        $("#modalCRUD").modal("show");

    });

    $("#formSolicitudes").submit(function (e) {
        e.preventDefault();
        id = $.trim($("#id").val());
        boleta = $.trim($("#boleta").val());
        nombre = $.trim($("#nombre").val());
        apellidoPat = $.trim($("#apellido_pat").val());
        apellidoMat = $.trim($("#apellido_mat").val());
        fechaIn = $.trim($("#fecha_ini").val());
        fechaTerm = $.trim($("#fecha_fin").val());
        fechaSolic = $.trim($("#fecha_jus").val());
        razon_ausen = $.trim($("#razon_ausen").val());
        statuss = $.trim($("#statuss").val());

        $.ajax({
            url: "crud_justificantes.php",
            type: "POST",
            dataType: "json",
            data: {id:id, boleta:boleta, nombre:nombre, apellidoPat:apellidoPat, apellidoMat:apellidoMat, fechaIn:fechaIn, fechaTerm:fechaTerm, fechaSolic:fechaSolic, razon_ausen:razon_ausen , statuss:statuss, opcion:opcion},
            success: function (data) {
                console.log(data);
                console.log(id);
                id = data[0].id;
                boleta = data[0].boleta;
                nombre = data[0].nombre;
                apellidoPat = data[0].apellidoPat;
                apellidoMat = data[0].apellidoMat;
                fechaIn = data[0].fechaIn;
                fechaTerm = data[0].fechaTerm;
                fechaSolic = data[0].fechaSolic;
                razon_ausen = data[0].razon_ausen;
                statuss = data[0].statuss;
                if (opcion == 1) { tablaJustificantes.row(fila).data([id, boleta, usuario, nombre, apellidoPat,apellidoMat,fechaIn,fechaTerm,fechaSolic,razon_ausen,statuss]).draw(); }
                else { tablaJustificantes.row.add([id, boleta, usuario, nombre, apellidoPat,apellidoMat,fechaIn,fechaTerm,fechaSolic,razon_ausen,statuss]).draw(); }
            }
        });
        $("#modalCRUD").modal("hide");

    });
});