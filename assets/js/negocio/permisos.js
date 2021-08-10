$(document).ready(function () {
    cargarUsuarios();
})

function cargarUsuarios() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Usuario/cargarUsuarios",
        beforeSend: function (xhr) {
            $("#listaUsuarios").empty();
        }, success: function (data, textStatus, jqXHR) {
            //console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                var estado = "";
                $.each(arr, function (index, contenido) {
                    //console.log(contenido.id);
                    if (contenido.estado == 1) {
                        $("#listaUsuarios").append('<li class="list-group-item d-flex justify-content-between align-items-center">' + contenido.nombres + ' ' + contenido.apellidos + '<span class="badge badge-primary badge-pill" title = "Ver permisos de: ' + contenido.usuario + '" style = "background-color: green !important; cursor: pointer;" onclick = "cargarPermisosByUsuario(' + contenido.id + ')">></span></li>');
                    }

                });

            } else {
                $("#tablaUsuario>tbody").append('<tr><td style = "text-align: center;" colspan = "9">No se encontraron resultados</td></tr>');
            }



        }
    })
}

function cargarPermisosByUsuario(idUsuario) {

    var param = {
        usuario: idUsuario
    }

    $.ajax({
        data: param,
        type: 'POST',
        url: base_url() + "Privilegio/permisosByUsuario",
        beforeSend: function (xhr) {
            $("#tablaPermisos>tbody").empty();
        }, success: function (data, textStatus, jqXHR) {
            //console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);

                $.each(arr, function (index, contenido) {

                    $("#tablaPermisos>tbody").append("<tr><td>" + contenido.menu + "</td><td id = 'p-" + contenido.idMenu + "'></td></tr>");
                    var permisos = JSON.parse(contenido.permisos);
                    console.log(permisos);
                    $.each(permisos, function (i, c) {
                        console.log(c.clave);
                        $("#p-" + contenido.idMenu).append("" + c.clave.trim() + " <input type = 'checkbox' id = '" + contenido.idMenu + "-" + c.clave.trim() + "' title = '" + c.clave.trim() + "'><br/>");
                        (c.valor.trim() == "false") ? $("#" + contenido.idMenu + "-" + c.clave.trim()).prop("checked", false) : $("#" + contenido.idMenu + "-" + c.clave.trim()).prop("checked", true);
                    })

                });

            } else {
                $("#tablaPermisos>tbody").append('<tr><td style = "text-align: center;" colspan = "9">No se encontraron resultados</td></tr>');
            }



        }
    })
}