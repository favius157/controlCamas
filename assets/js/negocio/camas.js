$(document).ready(function () {


    cargarCamas();
    cargarPisos();
})

var idActual = 0;

function nuevaCama(flag) {
    if (!flag) {
        limpiarDatosCama();
        $("#modalCamas").modal("show");
    } else {
        var bandera = false;
        if ($("input[name='nCama']").val() == "") {
            $("input[name='nCama']").css("border", "1px solid red");
            bandera = true;
        }

        if ($("#cmbBloques").val() == 0) {
            $("#s2id_cmbBloques").css("border", "1px solid red");
            bandera = true;
        }

        if ($("#cmbPisos").val() == 0) {
            $("#s2id_cmbPisos").css("border", "1px solid red");
            bandera = true;
        }

        if ($("#cmbSala").val() == 0) {
            $("#s2id_cmbSala").css("border", "1px solid red");
            bandera = true;
        }

        if ($("#cmbSector").val() == 0) {
            $("#cmbSector").css("border", "1px solid red");
            bandera = true;
        }

        if (bandera) {
            $("#msgCama").css("display", "block");
        } else {
            var param = {
                numeroCama: $("input[name='nCama']").val(),
                bloque: $("#cmbBloques").val(),
                piso: $("#cmbPisos").val(),
                sala: $("#cmbSala").val(),
                sector: $("#cmbSector").val()
            }

            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Cama/nuevaCama",
                beforeSend: function () {
                    $("#btnGuardarCama").prop("disabled", true);
                    $("#btnGuardarCama").text("Guardando...");
                }, success: function (data, textStatus, jqXHR) {
                    $("#btnGuardarCama").prop("disabled", false);
                    $("#btnGuardarCama").text("Guardar");
                    $("#modalCamas").modal("hide");
                    alert(data);
                    cargarCamas();
                }
            })
        }

    }
}

function nuevoBloque(flag) {
    if (!flag) {
        limpiarDatosBloque();
        $("#modalBloque").modal("show");
    } else {
        var bandera = false;
        if ($("input[name='nBloque']").val() == "") {
            $("input[name='nBloque']").css("border", "1px solid red");
            bandera = true;
        }

        if (bandera) {
            $("#msgBloque").css("display", "block");
        } else {
            var param = {
                nombreBloque: $("input[name='nBloque']").val()
            }

            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Cama/nuevoBloque",
                beforeSend: function () {
                    $("#btnGuardarBloque").prop("disabled", true);
                    $("#btnGuardarBloque").text("Guardando...");
                }, success: function (data, textStatus, jqXHR) {
                    console.log(data);
                    $("#btnGuardarBloque").prop("disabled", false);
                    $("#btnGuardarBloque").text("Guardar");
                    if (data == 1) {
                        alert("Registro exitoso");
                        $("#modalBloque").modal("hide");
                    } else {
                        alert("Error al guardar el registro");
                    }
                }
            })
        }

    }
}

function nuevaSala(flag) {
    if (!flag) {
        limpiarDatosSala();
        $("#modalSala").modal("show");
    } else {
        var bandera = false;
        if ($("input[name='nSala']").val() == "") {
            $("input[name='nSala']").css("border", "1px solid red");
            bandera = true;
        }

        if (bandera) {
            $("#msgSala").css("display", "block");
        } else {
            var param = {
                nombreSala: $("input[name='nSala']").val()
            }

            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Cama/nuevaSala",
                beforeSend: function () {
                    $("#btnGuardarSala").prop("disabled", true);
                    $("#btnGuardarSala").text("Guardando...");
                }, success: function (data, textStatus, jqXHR) {
                    console.log(data);
                    $("#btnGuardarSala").prop("disabled", false);
                    $("#btnGuardarSala").text("Guardar");
                    if (data == 1) {
                        alert("Registro exitoso");
                        $("#modalSala").modal("hide");
                    } else {
                        alert("Error al guardar el registro");
                    }
                }
            })
        }

    }
}


function cargarCamas() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Cama/cargarCamas",
        beforeSend: function (xhr) {
            $("#tablaCamas>tbody").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                var sector = "";
                var estado = ""
                var title = "";
                var statusIcon = "";
                $.each(arr, function (index, contenido) {
                    sector = (contenido.sector == 1) ? "Varones" : "Mujeres";
                    if (contenido.estado == 1) {
                        estado = "Habilitada";
                        statusIcon = '<a class = "btn btn-default btn-xs" onclick = "cambiarEstadoCama(0, ' + contenido.id + ', false);" title = "Deshabilitar cama"><i class = "fa fa-power-off" style = "color : red;"></i></a>';
                    } else {
                        estado = "Deshabilitada";
                        title = "Habilitar cama";
                        statusIcon = '<a class = "btn btn-default btn-xs" onclick = "cambiarEstadoCama(1, ' + contenido.id + ', false);" title = "Habilitar cama"><i class = "fa fa-power-off" style = "color : green;"></i></a>';
                    }
                    $("#tablaCamas>tbody").append('<tr><th scope="row">' + contenido.bloque + '</th><th scope="row">' + contenido.piso + '</th><th scope="row">' + contenido.sala + '</th><td>' + contenido.numeroCama + '</td><td>' + sector + '</td><td>' + estado + '</td><td style = "text-align:center;"><a class = "btn btn-default btn-xs" onclick = "editar(' + contenido.id + ', false);"><i class = "fa fa-pencil"></i></a>'+statusIcon+'</td></tr>');
                })
            } else {
                $("#tablaCamas>tbody").append('<tr><td colspan = "6" style = "text-align: center;">No hay datos para mostrar</td></tr>');
            }
        }
    })
}

var estadoActual = 0;
function cambiarEstadoCama(estado, idCama, flag) {
    if (!flag) {
        idActual = idCama;
        estadoActual = estado;
        (estado == 0) ? $(".task").text("deshabilitar") : $(".task").text("habilitar");
        
        $("#modalConfirmacion").modal("show");
    } else {
        var param = {
            idCama: idActual,
            estado: estadoActual
        }

        $.ajax({
            data: param,
            type: 'POST',
            url: base_url() + "Cama/cambiarEstadoCama",
            beforeSend: function (xhr) {

            }, success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    alert("Cambio realizado con éxito");
                    $("#modalConfirmacion").modal("hide");
                    cargarCamas();
                } else {
                    alert("No se pudo realizar los cambios");
                }
            }
        })
    }
}


function cargarCamasByPiso(idPiso) {

    var param = {
        idPiso: idPiso
    }

    $.ajax({
        data: param,
        type: 'POST',
        url: base_url() + "Cama/cargarCamasByPiso",
        beforeSend: function (xhr) {
            $("#tablaCamas>tbody").empty();

        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                var sector = "";
                var estado = "";

                $.each(arr, function (index, contenido) {
                    sector = (contenido.sector == 1) ? "Varones" : "Mujeres";
                    estado = (contenido.estado == 1) ? "Habilitada" : "Deshabilitada";

                    $("#tablaCamas>tbody").append('<tr><th scope="row">' + contenido.bloque + '</th><th scope="row">' + contenido.piso + '</th><td>' + contenido.numeroCama + '</td><td>' + sector + '</td><td>' + estado + '</td><td><a class = "btn btn-default btn-xs" onclick = "editar(' + contenido.id + ', false);"><i class = "fa fa-pencil"></i></a><a class = "btn btn-default btn-xs" onclick = "borrar(' + contenido.id + ', false);"><i class = "fa fa-trash-o"></i></a></td></tr>');
                })
            } else {
                $("#tablaCamas>tbody").append('<tr><td colspan = "6" style = "text-align: center;">No hay datos para mostrar</td></tr>');
            }
        }
    })
}

function cargarBloques() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Cama/cargarBloques",
        beforeSend: function (xhr) {

            $("#cmbBloques").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                $("#cmbBloques").append("<option value = 0 selected>Seleccione el bloque</option>");
                $.each(arr, function (index, contenido) {
                    $("#cmbBloques").append("<option value = " + contenido.id + ">" + contenido.nombreBloque + "</option>");

                })
            } else {
                $("#cmbBloques").append("<option value = 0 selected>No hay datos para mostrar</option>");
            }
            $("#cmbBloques").change();
        }
    })
}

function cargarPisos() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Cama/cargarPisos",
        beforeSend: function (xhr) {
            $("#listaPisos").empty();
            $("#cmbPisos").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                $("#cmbPisos").append("<option value = 0 selected>Seleccione el piso</option>");
                $.each(arr, function (index, contenido) {
                    $("#cmbPisos").append("<option value = " + contenido.id + ">" + contenido.numeroPiso + "</option>");
                    $("#listaPisos").append('<li class="list-group-item d-flex justify-content-between align-items-center">' + contenido.numeroPiso + '<span class="badge badge-primary badge-pill" title = "Ver camas de: ' + contenido.numeroPiso + '" style = "background-color: green !important; cursor: pointer;" onclick = "cargarCamasByPiso(' + contenido.id + ')">' + contenido.cantidad + '</span></li>');
                })

            } else {
                $("#cmbPisos").append("<option value = 0 selected>No hay datos para mostrar</option>");
            }
            $("#cmbPisos").change();
        }
    })
}

function cargarSalas() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Cama/cargarSalas",
        beforeSend: function (xhr) {
            $("#cmbSala").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                $("#cmbSala").append("<option value = 0 selected>Seleccione sala</option>");
                $.each(arr, function (index, contenido) {
                    $("#cmbSala").append("<option value = " + contenido.id + ">" + contenido.sala + "</option>");

                })

            } else {
                $("#cmbSala").append("<option value = 0 selected>No hay datos para mostrar</option>");
            }
            $("#cmbSala").change();
        }
    })
}

function limpiarDatosCama() {
    $("#formCama input").val("");
    $("#formCama input").css("border", "1px solid #ccc");
    $("#formCama select").css("border", "1px solid #ccc");
    $("#formCama .select2").css("border", "1px solid #ccc");
    $("#formCama select").val("0");
    $("#formCama select").change();
    $("#btnGuardarCama").css("display", "inline");
    $("#btnEditarCama").css("display", "none");
    $(".msgAlertas").css("display", "none");
    $(".task").text("Nueva");

    cargarBloques();
    cargarSalas();
}

function limpiarDatosBloque() {
    $("#formBloque input").val("");
    $("#formBloque select").val("0");
    $("#btnGuardarBloque").css("display", "inline");
    $("#btnEditarBloque").css("display", "none");
    $(".msgAlertas").css("display", "none");
    $(".task").text("Nuevo");
    $("#formBloque input").css("border", "1px solid #ccc");
    cargarBloques();
}

function limpiarDatosSala() {
    $("#formSala input").val("");
    $("#formSala select").val("0");
    $("#btnGuardarSala").css("display", "inline");
    $("#btnEditarSala").css("display", "none");
    $(".msgAlertas").css("display", "none");
    $(".task").text("Nueva");
    $("#formSala input").css("border", "1px solid #ccc");
    cargarSalas();
}