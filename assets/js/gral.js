$(document).ready(function () {
    
})

function base_url() {
    return "/controlCama/index.php/";
}

function cargarMenu() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Login/devolverMenu",
        beforeSend: function (xhr) {
            $("#menuPrincipal").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                var aux = "";
                $.each(arr, function (index, contenido) {
                    if (aux != contenido.grupo) {
                        $("#menuPrincipal").append('<li class = "parent"><a href="#"><i class="fa fa-home"></i><span>' + contenido.grupo + '</span></a><ul class="sub-menu" id = "grupo-' + contenido.grupo + '"></ul></li>');
                        $("#grupo-" + contenido.grupo).append('<li><a href="' + base_url() + contenido.url + '"> ' + contenido.menu + '</a></li>');
                        aux = contenido.grupo;
                    } else {
                        $("#grupo-" + contenido.grupo).append('<li><a href="' + base_url() + contenido.url + '"> ' + contenido.menu + '</a></li>');
                    }
                })
            } else {
            }
        }
    })
}

function cargarPermisosUsuario(item) {
    
    var param = {
        item: item
    }

    $.ajax({
        data: param,
        type: 'POST',
        url: base_url() + "Privilegio/permisosByItem",
        beforeSend: function (xhr) {

        }, success: function (data, textStatus, jqXHR) {
            console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                console.log(arr.length);
                $.each(arr, function (i, c) {
                    if (c.valor.trim() == "false") {
                        console.log("." + c.clave.trim());
                        $("." + c.clave.trim()).remove();
                    }
                })
            } else {
            }
        }
    })
}

function URLActual() {
    var url = window.location.href;
    url = url.split("/");
    return url[url.length - 1];
}