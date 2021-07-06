$(function () {

    $('a').mouseover(function () {



        var clase = $(this).attr('class');
        if (clase == "borrar") {
            $(this).css("border-color", "#E82C21");
            $(this).children().css("color", "#E82C21");
        }

        if (clase == "mod") {
            $(this).css("border-color", "#FFDC33");
            $(this).children().css("color", "#FFDC33");
        }

        if (clase == "actualizar") {
            $(this).css("border-color", "#1F2468");
            $(this).children().css("color", "#1F2468");
        }

        if (clase == "btnInsert nuevo") {

            $(this).css("border-color", "#15A822");
            $(this).children().css("color", "#15A822");
        }

        if (clase == "btn guardar") {

            $(this).css("background-color", "#149122");
        }
        if (clase == "buscar ibtn") {

            $(this).css("background-color", "#149122");
        }

        if (clase == "reporte") {
            $(this).css("border-color", "#15A822");
            $(this).children().css("color", "#15A822");
        }
    });

    $('a').mouseout(function () {
        $(this).removeAttr('style');
        $(this).children().removeAttr('style');
    });
});

