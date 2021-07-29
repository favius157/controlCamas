$(document).ready(function () {
    
})

function base_url() {
    return "/controlCama2/index.php/";
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
                        $("#grupo-" + contenido.grupo).append('<li><a href="' + contenido.url + '"> ' + contenido.menu + '</a></li>');
                        aux = contenido.grupo;
                    } else {
                        $("#grupo-" + contenido.grupo).append('<li><a href="' + contenido.url + '"> ' + contenido.menu + '</a></li>');
                    }
                })
            } else {
            }
        }
    })
}