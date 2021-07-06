$(document).ready(function () {
    cargarPersonas();
})

function cargarPersonas() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Persona/cargarPersonas",
        beforeSend: function (xhr) {
            $("#tablaPersona>tbody").empty();
        }, success: function (data, textStatus, jqXHR) {
            console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                var estado = "";
                $.each(arr, function (index, contenido) {
                    estado = (contenido.estado == 0) ? "Inactivo" : "Activo";
                    $("#tablaPersona>tbody").append('<tr><td>' + contenido.nombres + ' ' + contenido.apellidos + '</td><td>' + contenido.ci + '</td><td>' + contenido.matricula + '</td><td>' + contenido.telefono + '</td><td>' + contenido.cargo + '</td><td>' + contenido.establecimiento + '</td><td>' + estado + '</td><td></td></tr>');
                });

                function fnFormatDetails(oTable, nTr)
                {
                    var aData = oTable.fnGetData(nTr);
                    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                    sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
                    sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
                    sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
                    sOut += '</table>';

                    return sOut;
                }
                var nCloneTh = document.createElement('th');
                var nCloneTd = document.createElement('td');
                nCloneTd.innerHTML = '<img class="toggle-details" src="images/plus.png" />';
                nCloneTd.className = "center";

                $('#datatable2 thead tr').each(function () {
                    this.insertBefore(nCloneTh, this.childNodes[0]);
                });

                $('#datatable2 tbody tr').each(function () {
                    this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
                });
                var oTable = $('#datatable2').dataTable({

                    "aoColumnDefs": [

                        {"bSortable": false, "aTargets": [0]}

                    ],

                    "aaSorting": [[1, 'asc']]

                });


                $('#datatable2').delegate('tbody td img', 'click', function () {

                    var nTr = $(this).parents('tr')[0];

                    if (oTable.fnIsOpen(nTr))

                    {

                        /* This row is already open - close it */

                        this.src = "images/plus.png";

                        oTable.fnClose(nTr);

                    } else

                    {

                        /* Open this row */

                        this.src = "images/minus.png";

                        oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');

                    }

                });



                $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'Buscar...');

                $('.dataTables_length select').addClass('form-control');



                //Horizontal Icons dataTable

                $('#tablaPersona').dataTable();
            } else {
                $("#tablaPersona>tbody").append('<tr><td style = "text-align: center;" colspan = "9">No se encontraron resultados</td></tr>');
            }



        }
    })
}

function nuevaPersona(flag) {
    if (!flag) {
        limpiarDatosPersona();
        $("#modalNuevaPersona").modal("show");
    } else {
        var bandera = true;
        if ($("input[name='nPersona']").val() == "") {
            $("input[name='nPersona']").css("border", "1px solid red");
            bandera = false;
        }

        if ($("input[name='aPersona']").val() == "") {
            $("input[name='aPersona']").css("border", "1px solid red");
            bandera = false;
        }

        if ($("input[name='ci']").val() == "") {
            $("input[name='ci']").css("border", "1px solid red");
            bandera = false;
        }

        if ($("input[name='matricula']").val() == "") {
            $("input[name='matricula']").css("border", "1px solid red");
            bandera = false;
        }

        if ($("input[name='telefono']").val() == "") {
            $("input[name='telefono']").css("border", "1px solid red");
            bandera = false;
        }

        if ($("#cmbCargos").val() == 0) {
            $("#s2id_cmbCargos").css("border", "1px solid red");
            bandera = false;
        }

        if ($("#cmbEstablecimientos").val() == 0) {
            $("#s2id_cmbEstablecimientos").css("border", "1px solid red");
            bandera = false;
        }

        if (!bandera) {
            $("#msgPersonas").css("display", "block");
        } else {
            var param = {
                nombres: $("input[name='nPersona']").val(),
                apellidos: $("input[name='aPersona']").val(),
                ci: $("input[name='ci']").val(),
                matricula: $("input[name='matricula']").val(),
                telefono: $("input[name='telefono']").val(),
                cargo: $("#cmbCargos").val(),
                establecimiento: $("#cmbEstablecimientos").val()
            }

            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "/Persona/nuevaPersona/",
                beforeSend: function (xhr) {
                    $("#btnGuardarPersona").prop("disabled", true);
                    $("#btnGuardarPersona").text("Guardando...");
                }, success: function (data, textStatus, jqXHR) {
                    
                    if (data == 1) {
                        $("#btnGuardarPersona").prop("disabled", true);
                        $("#btnGuardarPersona").text("Guardar");
                        cargarPersonas();
                        $("#modalNuevaPersona").modal("hide");
                        alert("Persona registrada exitosamente");
                        
                    } else {
                        alert("Ocurrio un problemas al registrar a la persona");
                    }
                }
            })
        }


    }
}




/*Seccion cargos*/

function cargarCargos() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Cargo/cargarCargos",
        beforeSend: function (xhr) {
            $("#cmbCargos").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                $("#cmbCargos").append("<option value = 0 selected>Asigne el cargo de la persona</option>");
                $.each(arr, function (index, contenido) {
                    $("#cmbCargos").append("<option value = " + contenido.id + ">" + contenido.cargo + "</option>");
                })
            } else {
                $("#cmbCargos").append("<option value = 0 selected>No hay datos para mostrar</option>");
            }
            $("#cmbCargos").change();
        }
    })
}


/*Seccion establecimientos*/

function cargarEstablecimientos() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Establecimiento/cargarEstablecimientos",
        beforeSend: function (xhr) {
            $("#cmbEstablecimientos").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                $("#cmbEstablecimientos").append("<option value = 0 selected>Asigne el centro de la persona</option>");
                $.each(arr, function (index, contenido) {
                    $("#cmbEstablecimientos").append("<option value = " + contenido.id + ">" + contenido.centro + "</option>");
                })
            } else {
                $("#cmbEstablecimientos").append("<option value = 0 selected>No hay datos para mostrar</option>");
            }
            $("#cmbEstablecimientos").change();
        }
    })
}


function limpiarDatosPersona() {
    $("#formPersona input").val("");
    cargarCargos();
    cargarEstablecimientos();
    $("#btnEditarPersona").css("display", "none");
    $("#btnGuardarPersona").css("display", "inline");
    $("#formPersona .select2").css("border", "1px solid #ccc");
    $("#formPersona input").css("border", "1px solid #ccc");
    $(".msgAlertas").css("display", "none");
}