$(document).ready(function () {
    cargarRoles();
})

var idActual = 0;

function nuevoRol(flag) {
    if (!flag) {
        limpiarDatos();
        $("#modalNuevoRol").modal("show");
    } else {
        var bandera = true;
        if ($("input[name='nRol']").val() == "") {
            $("input[name='nRol']").css("border", "1px solid red");
            bandera = false;
        }

        if (!bandera) {
            $("#msgRol").css("display", "block");
        } else {
            var param = {
                nombreRol: $("input[name='nRol']").val()
            }

            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Privilegio/nuevoRol/",
                beforeSend: function (xhr) {
                    $("#btnGuardarRol").prop("disabled", true);
                    $("#btnGuardarRol").text("Guardando...");
                }, success: function (data, textStatus, jqXHR) {
                    //console.log(data);
                    $("#btnGuardarRol").prop("disabled", false);
                    $("#btnGuardarRol").text("Guardar");
                    if (data == 1) {
                        cargarRoles();
                        $("#modalNuevoRol").modal("hide");
                        alert("Datos ingresados con exito");
                    } else {
                        alert("Ocurrio un problema al registrar el rol");
                    }
                }
            })
        }
    }
}

function cargarRolById() {
    var param = {
        idRol: idActual
    }

    $.ajax({
        data: param,
        type: 'POST',
        url: base_url() + "Privilegio/cargarRolById/",
        beforeSend: function (xhr) {

        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                $("input[name='nRol']").val(arr[0]["rol"]);
                $("#task").text("Editar");
                $("#btnGuardarRol").css("display", "none");
                $("#btnEditarRol").css("display", "inline");
                $("#modalNuevoRol").modal("show");

            } else {
                alert("No se encontro resultados para su peticion");
            }
        }
    })
}

function editarRol(id, flag) {
    if (!flag) {
        limpiarDatos();
        idActual = id;
        cargarRolById();

    } else {
        var bandera = true;
        if ($("input[name='nRol']").val() == "") {
            $("input[name='nRol']").css("border", "1px solid red");
            bandera = false;
        }

        if (!bandera) {
            $("#msgRol").css("display", "block");
        } else {
            var param = {
                idRol: idActual,
                nombreRol: $("input[name='nRol']").val()
            }

            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Privilegio/editarRol/",
                beforeSend: function (xhr) {
                    $("#btnEditarRol").prop("disabled", true);
                    $("#btnEditarRol").text("Guardando...");
                }, success: function (data, textStatus, jqXHR) {
                    console.log(data);
                    $("#btnEditarRol").prop("disabled", false);
                    $("#btnEditarRol").text("Guardar");
                    if (data == 1) {
                        cargarRoles();
                        $("#modalNuevoRol").modal("hide");
                        alert("Datos ingresados con exito");
                    } else {
                        alert("Ocurrio un problema al actualizar el rol");
                    }
                }
            })
        }
    }
}

function borrar(id, flag) {
    if (!flag) {
        idActual = id;
        $("#modalConfirmacion").modal("show");
    } else {
        var param = {
            idRol: idActual
        }

        $.ajax({
            data: param,
            type: 'POST',
            url: base_url() + "Privilegio/borrarRol/",
            beforeSend: function () {

            }, success: function (data, textStatus, jqXHR) {
                console.log(data);
                if (data == 1) {
                    $("#modalConfirmacion").modal("hide");
                    alert("Rol dado de baja exitosamente");
                    cargarRoles();
                } else {
                    alert("Se produjo un error al dar de baja al rol");
                }
            }
        })
    }
}

function cargarRoles() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Privilegio/cargarRoles/",
        beforeSend: function () {
            $("#tablaRoles>tbody").empty();
        }, success: function (data, textStatus, jqXHR) {
            console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                var estado = "";
                $.each(arr, function (index, contenido) {
                    estado = (contenido.estado == 1) ? "Activo" : "Inactivo";
                    $("#tablaRoles>tbody").append('<tr><td>' + contenido.rol + '</td><td>0</td><td>' + contenido.cantidadAcceso + '</td><td>' + estado + '</td><td><a class = "btn btn-default btn-xs" onclick = "editarRol(' + contenido.id + ', false);"><i class = "fa fa-pencil"></i></a><a class = "btn btn-default btn-xs" onclick = "borrar(' + contenido.id + ', false);"><i class = "fa fa-trash-o"></i></a></td></tr>');
                })

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

                $('#tablaRoles').dataTable();
            }
        }
    })
}


function limpiarDatos() {
    $("#formRol input").val("");
    $("#formRol input").css("border", "1px solid #ccc");
    $(".msgAlertas").css("display", "none");
    $("#task").text("Nuevo");
    $("#btnGuardarRol").css("display", "inline");
    $("#btnEditarRol").css("display", "none");
}