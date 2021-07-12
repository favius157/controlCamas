$(document).ready(function () {
    cargarMenus();
    cargarGrupos();
})

var idActual = 0;

function nuevoMenu(flag) {
    if (!flag) {
        limpiarDatosMenu();
        $("#modalMenu").modal("show");
    } else {
        var bandera = false;
        if ($("input[name = 'nMenu']").val() == "") {
            $("input[name = 'nMenu']").css("border", "1px red solid");
            bandera = true;
        }

        if ($("input[name = 'url']").val() == "") {
            $("input[name = 'url']").css("border", "1px red solid");
            bandera = true;
        }

        if ($("#cmbGrupo").val() == 0) {
            $("#s2id_cmbGrupo").css("border", "1px red solid");
            bandera = true;
        }

        if (bandera) {
            $("#msgMenu").css("display", "block");
        } else {
            var param = {
                nombreMenu: $("input[name = 'nMenu']").val(),
                ruta: $("input[name = 'url']").val(),
                idGrupo: $("#cmbGrupo").val()
            }

            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Menu/nuevoItem",
                bewforeSend: function (xhr) {
                    $("#btnGuardarMenu").prop("disabled", true);
                    $("#btnGuardarMenu").text("Guardando...");
                }, success: function (data, textStatus, jqXHR) {
                    $("#btnGuardarMenu").prop("disabled", false);
                    $("#btnGuardarMenu").text("Guardar");
                    if (data == 1) {
                        alert("Datos guardados con exito");
                        cargarMenus();
                        cargarGrupos();
                    } else {
                        alert("No se pudo guardar los datos");
                    }
                    $("#modalMenu").modal("hide");
                }
            })
        }
    }
}

function nuevoGrupo(flag) {
    if (!flag) {
        limpiarDatosGrupo();
        $("#modalGrupo").modal("show");
    } else {
        var bandera = false;
        if ($("input[name = 'nGrupo']").val() == "") {
            $("input[name = 'nGrupo']").css("border", "1px red solid");
            bandera = true;
        }

        if (bandera) {
            $("#msgGrupo").css("display", "block");
        } else {
            var param = {
                nombreGrupo: $("input[name = 'nGrupo']").val()
            }

            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Menu/nuevoGrupo",
                bewforeSend: function (xhr) {
                    $("#btnGuardarGrupo").prop("disabled", true);
                    $("#btnGuardarGrupo").text("Guardando...");
                }, success: function (data, textStatus, jqXHR) {
                    $("#btnGuardarGrupo").prop("disabled", false);
                    $("#btnGuardarGrupo").text("Guardar");
                    if (data == 1) {
                        alert("Datos guardados con exito");
                        cargarGrupos();
                    } else {
                        alert("No se pudo guardar los datos");
                    }
                    $("#modalGrupo").modal("hide");
                }
            })
        }
    }
}

function cargarMenuById(idMenu) {
    var param = {
        idMenu: idMenu
    }

    $.ajax({
        data: param,
        type: 'POST',
        url: base_url() + "Menu/cargarMenuById",
        beforeSend: function (xhr) {

        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                $("input[name='nMenu']").val(arr[0]["menu"]);
                $("input[name='url']").val(arr[0]["url"]);
                $("#cmbGrupo").val(arr[0]["idGrupo"]);
                $("#cmbGrupo").change();
                $("#btnGuardarMenu").css("display", "none");
                $("#btnEditarMenu").css("display", "inline");
                $(".task").text("Modificar");
                $("#modalMenu").modal("show");
            } else {
            }

        }
    })
}

function borrarItem(idMenu, flag) {
    if (!flag) {
        idActual = idMenu;
        $("#modalConfirmacion").modal("show");
    } else {
        var param = {
            idMenu: idActual
        }

        $.ajax({
            data: param,
            type: 'POST',
            url: base_url() + "Menu/borrarItem",
            beforeSend: function (xhr) {

            }, success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    alert("Cambio realizado con éxito");
                    $("#modalConfirmacion").modal("hide");
                    cargarMenus();
                } else {
                    alert("No se pudo realizar los cambios");
                }
            }
        })
    }
}

function editarItem(idMenu, flag) {
    if (!flag) {
        idActual = idMenu;
        limpiarDatosMenu();
        cargarMenuById(idMenu);
    } else {
        var bandera = false;
        if ($("input[name = 'nMenu']").val() == "") {
            $("input[name = 'nMenu']").css("border", "1px red solid");
            bandera = true;
        }

        if ($("input[name = 'url']").val() == "") {
            $("input[name = 'url']").css("border", "1px red solid");
            bandera = true;
        }

        if ($("#cmbGrupo").val() == 0) {
            $("#s2id_cmbGrupo").css("border", "1px red solid");
            bandera = true;
        }

        if (bandera) {
            $("#msgMenu").css("display", "block");
        } else {
            var param = {
                idMenu: idActual,
                nombreMenu: $("input[name = 'nMenu']").val(),
                ruta: $("input[name = 'url']").val(),
                idGrupo: $("#cmbGrupo").val()
            }

            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Menu/editarItem",
                bewforeSend: function (xhr) {
                    $("#btnEditarMenu").prop("disabled", true);
                    $("#btnEditarMenu").text("Guardando...");
                }, success: function (data, textStatus, jqXHR) {
                    $("#btnEditarMenu").prop("disabled", false);
                    $("#btnEditarMenu").text("Guardar");
                    if (data == 1) {
                        alert("Datos guardados con exito");
                        cargarMenus();
                        cargarGrupos();
                    } else {
                        alert("No se pudo guardar los datos");
                    }
                    $("#modalMenu").modal("hide");
                }
            })
        }
    }
}

function cargarMenus() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Menu/cargarItems",
        beforeSend: function (xhr) {
            $("#tablaMenu>tbody").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                var estado = "";
                $.each(arr, function (index, contenido) {
                    estado = (contenido.estado == 0) ? "Inactivo" : "Activo";
                    $("#tablaMenu>tbody").append("<tr><td>" + contenido.menu + "</td><td>/" + contenido.url + "</td><td>" + contenido.grupo + "</td><td>" + estado + "</td><td style = 'text-align:center;'><a class = 'btn btn-default btn-xs' onclick = 'editarItem(" + contenido.id + ", false);'><i class = 'fa fa-pencil'></i></a><a class = 'btn btn-default btn-xs' onclick = 'borrarItem(" + contenido.id + ", false);'><i class = 'fa fa-trash-o'></i></a></td></tr>");
                })
            } else {
                $("#tablaMenu>tbody").append("<tr><td colspan = 5 style = 'text-align: center;'>No hay datos para mostrar</td></tr>");
            }
        }
    })
}

function cargarItemsByGrupo(idGrupo) {
    var param = {
        idGrupo: idGrupo
    }

    $.ajax({
        data: param,
        type: 'POST',
        url: base_url() + "Menu/cargarItemsByGrupo",
        beforeSend: function (xhr) {
            $("#tablaMenu>tbody").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                var estado = "";
                $.each(arr, function (index, contenido) {
                    estado = (contenido.estado == 0) ? "Inactivo" : "Activo";
                    $("#tablaMenu>tbody").append("<tr><td>" + contenido.menu + "</td><td>" + contenido.url + "</td><td>" + contenido.grupo + "</td><td>" + estado + "</td><td style = 'text-align:center;'><a class = 'btn btn-default btn-xs' onclick = 'editar(" + contenido.id + ", false);'><i class = 'fa fa-pencil'></i></a></td></tr>");
                })
            } else {
                $("#tablaMenu>tbody").append("<tr><td colspan = 5 style = 'text-align: center;'>No hay datos para mostrar</td></tr>");
            }
        }
    })
}

function cargarGrupos() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Menu/cargarGrupos",
        beforeSend: function (xhr) {
            $("#listaGrupos").empty();
            $("#cmbGrupo").empty();
        }, success: function (data, textStatus, jqXHR) {
            console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                $("#cmbGrupo").append("<option value = 0 selected>Seleccione el grupo</option>");
                $.each(arr, function (index, contenido) {
                    $("#cmbGrupo").append("<option value = '" + contenido.id + "'>" + contenido.grupo + "</option>");
                    $("#listaGrupos").append('<li class="list-group-item d-flex justify-content-between align-items-center">' + contenido.grupo + '<span class="badge badge-primary badge-pill" title = "Ver ítems de: ' + contenido.grupo + '" style = "background-color: green !important; cursor: pointer;" onclick = "cargarItemsByGrupo(' + contenido.id + ')">' + contenido.cantidad + '</span></li>');
                })
            } else {
                $("#cmbGrupo").append("<option value 0 selected>No hay datos para mostrar</option>");
            }
            $("#cmbGrupo").change();
        }
    })
}

function editarMenu() {

}

function borrarMenu() {

}

function limpiarDatosMenu() {
    $("#formMenu input").val("");
    $("#formMenu select").val(0);
    $("#formMenu .select2").css("border", "1px solid #ccc");
    $("#formMenu select").change();
    $("#formMenu input").css("border", "1px solid #ccc");
    $("#btnGuardarMenu").css("display", "inline");
    $("#btnEditarMenu").css("display", "none");
    $(".task").text("Nuevo");
    $(".msgAlertas").css("display", "none");
}

function limpiarDatosGrupo() {
    $("#formGrupo input").val("");
    $("#formGrupo input").css("border", "1px solid #ccc");
    $("#btnGuardarGrupo").css("display", "inline");
    $("#btnEditarGrupo").css("display", "none");
    $(".task").text("Nuevo");
    $(".msgAlertas").css("display", "none");
}