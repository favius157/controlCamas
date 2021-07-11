$(document).ready(function () {
    cargarCamas();
    cargarPisos();
})

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
                $.each(arr, function (index, contenido) {
                    sector = (contenido.sector == 1) ? "Varones" : "Mujeres";
                    estado = (contenido.estado == 1) ? "Habilitada" : "Deshabilitada";
                    $("#tablaCamas>tbody").append('<tr><th scope="row">' + contenido.bloque + '</th><th scope="row">' + contenido.piso + '</th><td>' + contenido.numeroCama + '</td><td>' + sector + '</td><td>' + estado + '</td><td><a class = "btn btn-default btn-xs" onclick = "editar(' + contenido.id + ', false);"><i class = "fa fa-pencil"></i></a><a class = "btn btn-default btn-xs" onclick = "borrar(' + contenido.id + ', false);"><i class = "fa fa-trash-o"></i></a></td></tr>');
                })
            } else {
                $("#tablaCamas<tbody").append('<tr><td colspan = "5" style = "text-align: center;">No hay datos para mostrar</td></tr>');
            }
        }
    })
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
                var estado = ""
                $.each(arr, function (index, contenido) {
                    sector = (contenido.sector == 1) ? "Varones" : "Mujeres";
                    estado = (contenido.estado == 1) ? "Habilitada" : "Deshabilitada";
                    $("#tablaCamas>tbody").append('<tr><th scope="row">' + contenido.bloque + '</th><th scope="row">' + contenido.piso + '</th><td>' + contenido.numeroCama + '</td><td>' + sector + '</td><td>' + estado + '</td><td><a class = "btn btn-default btn-xs" onclick = "editar(' + contenido.id + ', false);"><i class = "fa fa-pencil"></i></a><a class = "btn btn-default btn-xs" onclick = "borrar(' + contenido.id + ', false);"><i class = "fa fa-trash-o"></i></a></td></tr>');
                })
            } else {
                $("#tablaCamas<tbody").append('<tr><td colspan = "5" style = "text-align: center;">No hay datos para mostrar</td></tr>');
            }
        }
    })
}

function cargarPisos() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Cama/cargarPisos",
        beforeSend: function (xhr) {
            $("#listaPisos").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                $.each(arr, function (index, contenido) {
                    $("#listaPisos").append('<li class="list-group-item d-flex justify-content-between align-items-center">' + contenido.numeroPiso + '<span class="badge badge-primary badge-pill" title = "Ver camas de: '+contenido.numeroPiso+'" style = "background-color: green !important; cursor: pointer;" onclick = "cargarCamasByPiso('+contenido.id+')">' + contenido.cantidad + '</span></li>');
                })
            } else {
            }
        }
    })
}