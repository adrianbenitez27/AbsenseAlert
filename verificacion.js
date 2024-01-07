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
        statuss = fila.find('td:eq(9)').text();

        $("#id").val(id);
        $("#statuss").val(statuss);

        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar status");
        $("#modalCRUD").modal("show");

    });

    $("#formSolicitudes").submit(function (e) {
        e.preventDefault();
        id = $.trim($("#id").val());
        statuss = $.trim($("#statuss").val());

        $.ajax({
            url: "crud_justificantes.php",
            type: "POST",
            dataType: "json",
            data: {id:id, statuss:statuss, opcion:opcion},
            success: function (data) {
                console.log(data);
                id = data[0].id;
                statuss = data[0].statuss;
                if(opcion == 1){tablaJustificantes.row.add([id,statuss]).draw();}
            else{tablaJustificantes.row(fila).data([id,statuss]).draw();}    
            }
        });
        $("#modalCRUD").modal("hide");

    });
});