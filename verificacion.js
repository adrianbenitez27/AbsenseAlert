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



    $("#btnNuevo").click(function () {
        $("#formPersonas").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Persona");
        $("#modalJustificante").modal("show");
        // id=null;
        opcion = 1; //alta
    });

    var fila;

    //botón VERIFICAR   
    $(document).on("click", ".btnVerificar", function () {
        opcion = 2; //editar
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        boleta = fila.find('td:eq(1)').text();
        nombre = fila.find('td:eq(2)').text();
        apellido_pat = fila.find('td:eq(3)').text();
        apellido_mat = fila.find('td:eq(4)').text();
        fecha_ini = fila.find('td:eq(5)').text();
        fecha_fin = fila.find('td:eq(6)').text();
        fecha_jus = fila.find('td:eq(7)').text();
        razon_ausen = fila.find('td:eq(8)').text();
        statuss = fila.find('td:eq(9)').text();

        $("#id").val(id);
        $("#boleta").val(boleta);
        $("#nombre").val(nombre);
        $("#apellido_pat").val(apellido_pat);
        $("#apellido_mat").val(apellido_mat);
        $("#fecha_ini").val(fecha_ini);
        $("#fecha_fin").val(fecha_fin);
        $("#fecha_jus").val(fecha_jus);
        $("#razon_ausen").val(razon_ausen);
        $("#statuss").val(statuss);
        
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar status");
        $("#modalJustificante").modal("show");

    });

    $("#formSolicitudes").submit(function (e) {
        e.preventDefault();
        id = $.trim($("#id").val());
        boleta = $.trim($("#boleta").val());
        nombre = $.trim($("#nombre").val());
        apellido_pat = $.trim($("#apellido_pat").val());
        apellido_mat = $.trim($("#apellido_mat").val());
        fecha_ini = $.trim($("#fecha_ini").val());
        fecha_fin = $.trim($("#fecha_fin").val());
        fecha_jus = $.trim($("#fecha_jus").val());
        razon_ausen = $.trim($("#razon_ausen").val());
        statuss = $.trim($("#statuss").val());

        $.ajax({
            url: "crud_justificantes.php",
            type: "POST",
            dataType: "json",
            data: {id: id, boleta: boleta, nombre: nombre, apellido_pat: apellido_pat, apellido_mat: apellido_mat, fecha_ini: fecha_ini, fecha_fin: fecha_fin, fecha_jus: fecha_jus, razon_ausen: razon_ausen, statuss: statuss, opcion: opcion},
            success: function (data) {
                console.log(data);
                id = data[0].id;
                boleta = data[0].boleta;
                nombre = data[0].nombre;
                apellido_pat = data[0].apellido_pat;
                apellido_mat = data[0].apellido_mat;
                fecha_ini = data[0].fecha_ini;
                fecha_fin = data[0].fecha_fin;
                fecha_jus = data[0].fecha_jus;
                razon_ausen = data[0].razon_ausen;
                statuss = data[0].statuss;
                if(opcion == 1){tablaJustificantes.row.add([id,boleta,nombre,apellido_pat,apellido_mat,fecha_ini,fecha_fin,fecha_jus,razon_ausen,statuss]).draw();}
                else{tablaJustificantes.row(fila).data([id,boleta,nombre,apellido_pat,apellido_mat,fecha_ini,fecha_fin,fecha_jus,razon_ausen,statuss]).draw();}    
            }
        });
        $("#modalJustificante").modal("hide");
    });
});