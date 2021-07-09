$(document).ready(function () {
    cargarPermisos();
    $("#cmbRoles").change(function () {
        if ($(this).val() != 0) {
            cargarMenus();
        }
    });
})

var itemElegidos = [];
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
                        //cargarPrivilegios();
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

function nuevoPermiso(flag) {
    if (!flag) {
        limpiarDatosPermisos();
        //cargarRoles();
        $("#modalNuevoPermiso").modal("show");
    } else {
        var bandera = true;
        if (itemElegidos.length == 0) {
            alert("No ha seleccionado ningún acceso para permitir al usuario");
            bandera = false;
        } else {
            bandera = true;
        }

        if ($("#cmbRoles").val() == 0) {
            $("#s2id_cmbRoles").css("border", "1px solid red");
            $("#msgPermiso").css("display", "block");
            bandera = false;
        }

        if (!bandera) {
            //$("#msgPermiso").css("display", "block");
        } else {
            var param = {
                idRol: $("#cmbRoles").val(),
                permisos: JSON.stringify(itemElegidos)
            }

            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Privilegio/nuevoPermiso/",
                beforeSend: function (xhr) {
                    $("#btnGuardarPermiso").prop("disabled", true);
                    $("#btnGuardarPermiso").text("Guardando...");
                }, success: function (data, textStatus, jqXHR) {
                    //console.log(data);
                    $("#btnGuardarPermiso").prop("disabled", false);
                    $("#btnGuardarPermiso").text("Guardar");
                    $("#modalNuevoPermiso").modal("hide");
                    cargarPermisos();
                    alert(data);
                }
            })
        }
    }
}

function cargarPermisoByRol(idRol) {
    var param = {
        idRol: idRol
    }

    $.ajax({
        data: param,
        type: 'POST',
        url: base_url() + "Privilegio/cargarPermisoByRol",
        beforeSend: function (xhr) {

        }, success: function (data, textStatus, jqXHR) {
            console.log(data);
            if (data != "null") {
                $("#btnGuardarPermiso").css("display", "none");
                $("#btnEditarPermiso").css("display", "inline");
                $("#modalNuevoPermiso").modal("show");
                var arr = JSON.parse(data);
                $("#cmbRoles").val(arr[0]["idRol"]);
                $("#cmbRoles").prop("disabled", true);
                $("#cmbRoles").change();
                $.each(arr, function (index, contenido) {
                    itemElegidos.push("" + contenido.idMenu);
                    $("#listSeleccionados").append("<li style = 'margin-bottom: 15px; width: 150px;' id = 'liSelect-" + contenido.idMenu + "'>" + contenido.menu + "<a style = 'float : right;' class = 'btn btn-default btn-xs' onclick = 'quitar(" + contenido.idMenu + ")'><i class = 'fa fa-trash-o'></i></li></a>");
                })
                console.log("nueva lista " + itemElegidos);
            } else {
                alert("No se encontraron resultados");
                cargarPermisos();
            }
        }
    })
}

function editarPermiso(id, idRol, flag) {
    if (!flag) {
        limpiarDatosPermisos();
        idActual = id;

        cargarPermisoByRol(idRol);

    } else {
        var param = {
            idPermiso: idActual,
            permisos: JSON.stringify(itemElegidos),
            idRol: $("#cmbRoles").val()
        }

        $.ajax({
            data: param,
            type: 'POST',
            url: base_url() + "Privilegio/editarPrivilegio",
            beforeSend: function (xhr) {
                $("#btnEditarPermiso").prop("disabled", true);
                $("#btnEditarPermiso").text("Guardando...");
            }, success: function (data, textStatus, jqXHR) {
                $("#btnEditarPermiso").prop("disabled", false);
                $("#btnEditarPermiso").text("Guardar");
                $("#modalNuevoPermiso").modal("hide");
                alert(data);
                cargarPermisos();
            }
        })
    }
}

function cargarPermisos() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Privilegio/cargarPermisos/",
        beforeSend: function (xhr) {
            $("#tablaPermisos>tbody").empty();
        }, success: function (data, textStatus, jqXHR) {
            console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                var estado = "";
                $.each(arr, function (index, contenido) {
                    estado = (contenido.estado == 1) ? "Activo" : "Inactivo";
                    $("#tablaPermisos>tbody").append('<tr><td>' + contenido.menu + '</td><td>' + contenido.rol + '</td><td>' + estado + '</td><td><a class = "btn btn-default btn-xs" onclick = "editarPermiso(' + contenido.id + ', ' + contenido.idRol + ', false);"><i class = "fa fa-pencil"></i></a></td></tr>');
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

                $('#tablaPermisos').dataTable();


            } else {
                $("#tablaPermisos>tbody").append('<tr><td colspan = "4" style = "text-align:center;">No hay datos para mostrar</td></tr>');
            }
        }
    })
}

function cargarMenus() {
    var param = {
        idRol: $("#cmbRoles").val()
    }

    $.ajax({
        data: param,
        type: 'POST',
        url: base_url() + "Privilegio/cargarMenu/",
        beforeSend: function () {
            $("#listMenus").empty();
            $("#listSeleccionados").empty();
            itemElegidos = [];
        }, success: function (data, textStatus, jqXHR) {
            console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                $.each(arr, function (index, contenido) {
                    $("#listMenus").append("<li style = 'margin-bottom: 15px; width: 150px;' id = 'li-" + contenido.id + "'>" + contenido.menu + "<a style = 'float : right;' class = 'btn btn-default btn-xs' onclick = 'agregar(" + contenido.id + ")'><i class = 'fa fa-plus'></i></li></a>");
                })
            }
        }
    })
}

function cargarRoles() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Privilegio/cargarRoles/",
        beforeSend: function () {
            $("#cmbRoles").empty();
        }, success: function (data, textStatus, jqXHR) {
            console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                $("#cmbRoles").append("<option value = 0 selected>Elija el rol a configurar</option>");
                $.each(arr, function (index, contenido) {
                    if (contenido.estado == 1) {
                        $("#cmbRoles").append("<option value = " + contenido.id + ">" + contenido.rol + "</option>");
                    }
                })
                $("#cmbRoles").change();
            }
        }
    })
}

function agregar(id) {
    if ($.inArray("" + id, itemElegidos) >= 0) {
        alert("Item ya elegido");
    } else {
        itemElegidos.push("" + id);

        var item = $("#li-" + id).text();
        $("#listSeleccionados").append("<li style = 'margin-bottom: 15px; width: 150px;' id = 'liSelect-" + id + "'>" + item + "<a style = 'float : right;' class = 'btn btn-default btn-xs' onclick = 'quitar(" + id + ")'><i class = 'fa fa-trash-o'></i></li></a>");
    }
}

function quitar(item) {
    var i = itemElegidos.indexOf("" + item);
    if (i !== -1) {
        itemElegidos.splice(i, 1);
        $("#liSelect-" + item).remove();
    }
}

function limpiarDatos() {
    $("#formRol input").val("");
    $("#formRol input").css("border", "1px solid #ccc");
    $(".msgAlertas").css("display", "none");
}

function limpiarDatosPermisos() {
    $("#btnGuardarPermiso").css("display", "inline");
    $("#btnEditarPermiso").css("display", "none");
    $("#formPermiso select").val(0);
    $("#formPermiso select").css("border", "1px solid #ccc");
    $(".msgAlertas").css("display", "none");
    $("#listMenus").empty();
    $("#listSeleccionados").empty();
    $("#cmbRoles").prop("disabled", false);
    itemElegidos = [];
    cargarRoles();
}