$(document).ready(function () {
    //opcion1();
    $(".card-body").click(function () {
        var id = $(this).attr("id");
        var nombreBolque = $(this).find("h1").text();
        $("#nombreBloque").text(nombreBolque + " ");
        $("#nombrePiso").text("Piso 3");
        opcion2(nombreBolque);
        //alert();
    })

    $(".card-body").each(function (i, obj) {
        var id = $(this).attr("id");
        $(this).append('<ul class="list-inline" style="text-align: center;"><li class="detalleCama" style="background-color: green;" title="Total de camas"></li><span id="totalCamas-' + id + '"></span><li class="detalleCama" style="background-color: white;" title="Camas libres"></li><span id="camasLibres-' + id + '"></span><li class="detalleCama" style="background-color: red;" title="Camas Ocupadas"></li><span id="camasOcupadas-' + id + '"></span></ul>');
        cargarDetalleByBloque($(this).find("h1").text());
    })
})


function cargarCamas() {

}

function cargarDetalleCamasByBloques() {

}

function opcion1() {
    var param = {
        idPiso: 3
    }
    $.ajax({
        data: param,
        type: 'POST',
        url: base_url() + "Cama/cargarCamasByPiso",
        beforeSend: function (xhr) {
            $(".card-body").empty();
        }, success: function (data, textStatus, jqXHR) {
            var arr = JSON.parse(data);
            var sala = 0;
            var bloque = "";
            console.log(arr);
            $.each(arr, function (index, contenido) {
                if (contenido.idSala != sala) {
                    sala = contenido.idSala;
                    bloque = contenido.bloque.replace(" ", "");
                    bloque = bloque.toLowerCase();
                    console.log(bloque);
                    $("#" + bloque).append('<div class="row salas" id="sala-' + contenido.idSala + '" style="margin-top: 0px;"></div>');
                    $("#sala-" + contenido.idSala).append('<div class="col-md-3">' + contenido.numeroCama + '</div>');
                } else {
                    $("#sala-" + sala).append('<div class="col-md-3">' + contenido.numeroCama + '</div>');
                }
            })
        }
    })
}

function opcion2(dato) {
    var param = {
        idPiso: 3
    }
    $.ajax({
        data: param,
        type: 'POST',
        url: base_url() + "Cama/cargarCamasByPiso",
        beforeSend: function (xhr) {
            $("#theBloque").empty();
        }, success: function (data, textStatus, jqXHR) {

            if (data != "null") {
                var arr = JSON.parse(data);
                var sala = 0;
                var bloque = "";
                var aux = 0;
                var resultado = "";
                var estado = "";
                var control = "";
                console.log(arr);
                $.each(arr, function (index, contenido) {

                    if (contenido.bloque == dato) {
                        if (contenido.idSala != sala) {
                            resultado = 12 / aux;
                            $("#sala-" + sala + ">div").addClass("col-md-" + resultado);
                            sala = contenido.idSala;
                            bloque = contenido.bloque.replace(" ", "");
                            bloque = bloque.toLowerCase();
                            aux = 1;
                            estado = (contenido.estado == 1) ? "<p style = 'font-weight: 500;'>Libre</p>" : "<p style = 'font-weight: 800; color : red;'>Ocupado</p>";
                            control = (contenido.estado == 1) ? '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-secondary" title = "Asignar cama"><i class = "fa fa-check"></i></button></div>' : '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-secondary" title = "Liberar cama"><i class = "fa fa-trash-o"></i></button><button type="button" class="btn btn-secondary" title  = "Ver detalles de paciente"><i class = "fa fa-eye"></i></button></div>';
                            $("#theBloque").append('<div class="row salas" id="sala-' + contenido.idSala + '" style="margin-top: 0px;"></div>');
                            $("#sala-" + contenido.idSala).append('<div class="card"><label>Número de cama: </label>' + contenido.numeroCama + ' ' + contenido.sala + '<br/><label>Estado: </label>'+estado+'<br/><br/>'+control+'</div>');
                        } else {
                            aux++;
                            estado = (contenido.estado == 1) ? "<p style = 'font-weight: 500;'>Libre</p>" : "<p style = 'font-weight: 800; color : red;'>Ocupado</p>";
                            control = (contenido.estado == 1) ? '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-secondary" title = "Asignar cama"><i class = "fa fa-check"></i></button></div>' : '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-secondary" title = "Liberar cama"><i class = "fa fa-trash-o"></i></button><button type="button" class="btn btn-secondary" title  = "Ver detalles de paciente"><i class = "fa fa-eye"></i></button></div>';
                            $("#sala-" + contenido.idSala).append('<div class="card"><label>Número de cama: </label>' + contenido.numeroCama + ' ' + contenido.sala + '<br/><label>Estado: </label>'+estado+'<br/><br/>'+control+'</div>');
                        }
                    } else {
                    }
                })
                resultado = 12 / aux;
                $("#sala-" + sala + ">div").addClass("col-md-" + resultado);
                $("#modalCamas").modal("show");
            } else {
            }


        }
    })
}

function cargarDetalleByBloque(nombreBloque) {
    var param = {
        idPiso: 3,
        bloque: nombreBloque
    }
    $.ajax({
        data: param,
        type: 'POST',
        url: base_url() + "Cama/cargarDetalleByBloque",
        beforeSend: function (xhr) {
            //$("#theBloque").empty();
        }, success: function (data, textStatus, jqXHR) {
            console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                var estado = "";
                var total = 0;
                var bloque = "";
                $.each(arr, function (index, contenido) {
                    total += parseInt(contenido.cantidad);
                    bloque = nombreBloque.replace(" ", "");
                    bloque = bloque.toLowerCase();
                    (contenido.estado == 1) ? $("#camasLibres-" + bloque).text(contenido.cantidad) : $("#camasOcupadas-" + bloque).text(contenido.cantidad);
                })
                $("#totalCamas-" + bloque).text(total);

            }

        }
    })
}