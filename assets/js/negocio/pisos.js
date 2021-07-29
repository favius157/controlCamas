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
        //$(this).append('<ul class="list-inline" style="text-align: center;font-size: 15px; font-weight:bold;"><li class="detalleCama" style="background-color: white;height: 15px;width: 15px;" title="Total de camas" ></li><span id="totalCamas-' + id + '"></span><li class="detalleCama" style="background-color: green;height: 15px;width: 15px;" title="Camas libres"></li><span id="camasLibres-' + id + '"></span><li class="detalleCama" style="background-color: red;height: 15px;width: 15px;" title="Camas Ocupadas"></li><span id="camasOcupadas-' + id + '"></span></ul>');
        $(this).append('<ul class="list-inline" ><span class="detalleCama badge badge-primary" style="text-align: left;font-size: 20px; font-weight:bold;height: 28px;width: 30px; color:white;"id="totalCamas-' + id + '" title="Total de camas" ></span><li class="detalleCama" style="background-color: green;height: 15px;width: 15px;" title="Camas libres"></li><span id="camasLibres-' + id + '"></span><li class="detalleCama" style="background-color: red;height: 15px;width: 15px;" title="Camas Ocupadas"></li><span id="camasOcupadas-' + id + '"></span><span class="detalleCama badge badge-warning" style="text-align: left;font-size: 20px; font-weight:bold;height: 28px;width: 30px; color:white;" title="Camas Aisladas" id="camasAisladas-' + id + '"  ></span></ul>');
        cargarDetalleByBloque($(this).find("h1").text());
    })
})
var idActual = 0;

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
            //console.log(data);
            var arr = JSON.parse(data);
            var sala = 0;
            var bloque = "";
            //console.log(arr);
            $.each(arr, function (index, contenido) {
                if (contenido.idSala != sala) {
                    sala = contenido.idSala;
                    bloque = contenido.bloque.replace(" ", "");
                    bloque = bloque.toLowerCase();
                    //console.log(bloque);
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
            //console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                var sala = 0;
                var bloque = "";
                var aux = 0;
                var resultado = "";
                var estado = "";
                var control = "";
                //console.log(arr);
                $.each(arr, function (index, contenido) {

                    if (contenido.bloque == dato) {
                        console.log("numero de cama: "+contenido.numeroCama+" dias de internacion: "+contenido.diasInternacion+" idAsignacion: "+contenido.asignacion);
                        if (contenido.idSala != sala) {
                            resultado = 12 / aux;
                            $("#sala-" + sala + ">div").addClass("col-md-" + resultado);
                            sala = contenido.idSala;
                            bloque = contenido.bloque.replace(" ", "");
                            bloque = bloque.toLowerCase();
                            aux = 1;
                            estado = (contenido.estado == 1) ? "<p style = 'font-weight: 500;font-weight: bold;color : green;font-size:20px;'>CAMA LIBRE</p>" : ((contenido.estado == 2) ? "<p style = 'font-size:20px;font-weight: 800; color : red;'>CAMA OCUPADA</p>" : "<p style = 'font-size:20px;font-weight: 800; color : #ffd700;'>PACIENTE AISLADO</p>");
                            control = (contenido.estado == 1) ? '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-success" title = "Asignar cama"  onclick = "asignarPaciente(' + contenido.id + ', false)"><i class = "fa fa-check"></i></button></div>' : '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-danger" title = "Liberar cama" onclick = "liberarCama(' + contenido.id + ', false)"><i class = "fa fa-trash-o"></i></button><button type="button" class="btn btn-info" title  = "Ver detalles de paciente"onclick = "verPacienteByCama(' + contenido.id + ')"><i class = "fa fa-eye"></i></button></div>';
                            $("#theBloque").append('<div class="row salas" id="sala-' + contenido.idSala + '" style="margin-top: 0px;"></div>');
                            $("#sala-" + contenido.idSala).append('<div class="alert alert-success alert-white rounded" style="font-weight: bold;font-size:13px; width: 30%; margin-right: 15px; padding-right: 2px;"><label>Número de cama: </label>' + contenido.numeroCama + ' ' + contenido.sala + '<br/><label>Estado: </label>' + estado + '<br/><br/>' + control + '<div class="icon" style = "background-color : ' + colorCama(contenido.diasInternacion) + '"></div></div>');
                            //$("#sala-" + contenido.idSala).append('<div class="card" style="font-weight: bold;font-size:13px;"><label>Número de cama: </label>' + contenido.numeroCama + ' ' + contenido.sala + '<br/><label>Estado: </label>' + estado + '<br/><br/>' + control + '</div>');
                        } else {
                            aux++;
                            estado = (contenido.estado == 1) ? "<p style = 'font-weight: 500;font-weight: bold;color : green;font-size:20px;'>CAMA LIBRE</p>" : ((contenido.estado == 2) ? "<p style = 'font-size:20px;font-weight: 800; color : red;'>CAMA OCUPADA</p>" : "<p style = 'font-size:20px;font-weight: 800; color : #ffd700;'>PACIENTE AISLADO</p>");
                            control = (contenido.estado == 1) ? '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-success" title = "Asignar cama"  onclick = "asignarPaciente(' + contenido.id + ', false)"><i class = "fa fa-check"></i></button></div>' : '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-danger" title = "Liberar cama" onclick = "liberarCama(' + contenido.id + ', false)"><i class = "fa fa-trash-o"></i></button><button type="button" class="btn btn-info" title  = "Ver detalles de paciente" onclick = "verPacienteByCama(' + contenido.id + ')"><i class = "fa fa-eye"></i></button></div>';
                            $("#sala-" + contenido.idSala).append('<div class="alert alert-success alert-white rounded" style="font-weight: bold;font-size:13px; width: 30%; margin-right: 15px; padding-right: 2px;"><label2>Número de cama: </label>' + contenido.numeroCama + ' ' + contenido.sala + '<br/><label>Estado: </label>' + estado + '<br/><br/>' + control + '<div class="icon" style = "background-color : ' + colorCama(contenido.diasInternacion) + '"></div></div>');
                            //$("#sala-" + contenido.idSala).append('<div class="card" style="font-weight: bold;font-size:13px;"><label2>Número de cama: </label>' + contenido.numeroCama + ' ' + contenido.sala + '<br/><label>Estado: </label>' + estado + '<br/><br/>' + control + '</div>');
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

function colorCama(diasInternacion) {
    if (diasInternacion >= 1 && diasInternacion <= 7) {
        return "#57a257";
    }

    if (diasInternacion >= 8 && diasInternacion <= 14) {
        return "#d35400";
    }

    if (diasInternacion >= 15 && diasInternacion <= 21) {
        return "#bd1e1e";
    }
    if (diasInternacion > 21) {
        return "#771c1c";
    }

    if (diasInternacion <= 0) {
        return "#fff";
    }
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
            //console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                var estado = "";
                var total = 0;
                var bloque = "";
                $.each(arr, function (index, contenido) {
                    total += parseInt(contenido.cantidad);
                    bloque = nombreBloque.replace(" ", "");
                    bloque = bloque.toLowerCase();
                    (contenido.estado == 1) ? $("#camasLibres-" + bloque).text(contenido.cantidad) : ((contenido.estado == 2) ? $("#camasOcupadas-" + bloque).text(contenido.cantidad) : $("#camasAisladas-" + bloque).text(contenido.cantidad));
                })
                $("#totalCamas-" + bloque).text(total);

            }

        }
    })
}

var idActual = 0;

function buscarPaciente() {
    var bandera = true;
    if ($("input[name='MatriculaoCi']").val() == "") {
        $("input[name='MatriculaoCi']").css("border", "2px solid red");
        bandera = false;
    }

    if (!bandera) {
        $("#msgAsignar").css("display", "block");
    } else {
        var datos = $("input[name='MatriculaoCi']").val();
        $.ajax({
            type: 'GET',
            url: "http://172.25.0.10:8080/siis/index.php/welcome/obtenerPacientes/" + datos,
            //url: "http://172.25.0.10:8080/siis/index.php/welcome/obtenerPacientes/"+datos+"/"+datos,
            success: function (data, textStatus, jqXHR) {
                //console.log(data);
                if (data != "null") {
                    var arr = JSON.parse(data);
                    //console.log(data);
                    $.each(arr, function (index, contenido) {
                        $("#listAsegurados").append("<li style = 'margin-bottom: 15px; width: 500px;' id = 'li-" + contenido.idpaciente + "'>" + contenido.nombres + "<i style='padding: 110px; text-align: left;' >" + contenido.codcns + "</i><a style = 'float : right;' class = 'btn btn-default btn-xs' title='Elegir Asegurado' onclick = 'cargarPaciente(" + contenido.idpaciente + ")'><i class = 'fa fa-plus'></i></a></li>");

                    });
                    /*if (data.length > 0) {
                     $("input[name='nombres']").val(data[0].nombres);
                     $("input[name='matricula']").val(data[0].nro_registro);
                     $("input[name='cie10']").val(data[0].cie10);
                     $("input[name='diagnostico']").val(data[0].diagnostico);
                     $("input[name='medico']").val(data[0].medico);
                     $("input[name='especialidad']").val(data[0].especialidad);
                     $("input[name='id_historial']").val(data[0].id_historial);
                     $("input[name='edad']").val(data[0].edad);
                     $("input[name='sexo']").val(data[0].id_tipo_sexo);
                     $("input[name='empresa']").val(data[0].nempresa);
                     $("input[name='patronal']").val(data[0].codigoempresa);*/

                } else {
                    swal({
                        //className: "red-bg",
                        title: "IMPORTANTE",
                        text: "No existe registro en el sistema del paciente, revise si la matrícula es la correcta o consultar a vigencia si el acceso del paciente fue por conducto regular!!!.",
                        icon: "warning",
                        //buttons: true,
                        dangerMode: true,
                    })
                    limpiarAsignarPaciente();

                    //alert("No se encontro datos relacionados al asegurado");
                }
            }
        });
    }
}

function cargarPaciente(idpaciente) {
    /*idActual=idpaciente;
     bandera=true;
     validarInternacion(idpaciente);
     if
     redirect("http://172.25.0.10:8080/siis/index.php/welcome/obtenerAsegurado/".$_POST['idcama'])*/
    var datos = idpaciente;
    $.ajax({
        type: 'GET',
        url: "http://172.25.0.10:8080/siis/index.php/welcome/obtenerAsegurado/" + datos,
        //url: "http://172.25.0.10:8080/siis/index.php/welcome/obtenerPacientes/"+datos+"/"+datos,
        success: function (data, textStatus, jqXHR) {
            //console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                if (arr.length > 0) {
                    $("input[name='nombres']").val(arr[0].nombres);
                    $("input[name='matricula']").val(arr[0].nro_registro);
                    $("input[name='cie10']").val(arr[0].cie10);
                    $("input[name='diagnostico']").val(arr[0].diagnostico);
                    $("input[name='medico']").val(arr[0].medico);
                    $("input[name='especialidad']").val(arr[0].especialidad);
                    $("input[name='id_historial']").val(arr[0].id_historial);
                    $("input[name='fec_nacimiento']").val(arr[0].fec_nacimiento);
                    $("input[name='sexo']").val(arr[0].id_tipo_sexo);
                    $("input[name='empresa']").val(arr[0].nempresa);
                    $("input[name='patronal']").val(arr[0].codigoempresa);
                    $("input[name='codcns']").val(arr[0].codcns);
                    $("input[name='edad']").val(arr[0].edad);

                }
            } else {
                swal({
                    //className: "red-bg",
                    title: "IMPORTANTE",
                    text: "El paciente no tiene registro de atención en el hospital Obrero #3, debe informar a Vigencia para regularizar el acceso al establecimiento y posterior atención!!!.",
                    icon: "warning",
                    //buttons: true,
                    dangerMode: true
                })

                //alert("El paciente no tiene registro de atención en el hospital Obrero #3, debe informar a Vigencia para regularizar el acceso al establecimiento y posterior atención.");
            }
        }
    });
    $("#listAsegurados").empty();
    //limpiarAsignarPaciente();

}
function cargarPaciente12(idpaciente) {
    /*idActual=idpaciente;
     bandera=true;
     validarInternacion(idpaciente);
     if
     redirect("http://172.25.0.10:8080/siis/index.php/welcome/obtenerAsegurado/".$_POST['idcama'])*/
    var datos = idpaciente;
    $.ajax({
        data: datos,
        type: 'POST',
        url: base_url() + "Cama/validarPaciente/",
        //url: "http://172.25.0.10:8080/siis/index.php/welcome/obtenerPacientes/"+datos+"/"+datos,
        success: function (data, textStatus, jqXHR) {
            //console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                if (arr.length > 0) {
                    $("input[name='nombres']").val(arr[0].nombres);
                    $("input[name='matricula']").val(arr[0].nro_registro);
                    $("input[name='cie10']").val(arr[0].cie10);
                    $("input[name='diagnostico']").val(arr[0].diagnostico);
                    $("input[name='medico']").val(arr[0].medico);
                    $("input[name='especialidad']").val(arr[0].especialidad);
                    $("input[name='id_historial']").val(arr[0].id_historial);
                    $("input[name='edad']").val(arr[0].edad);
                    $("input[name='sexo']").val(arr[0].id_tipo_sexo);
                    $("input[name='empresa']").val(arr[0].nempresa);
                    $("input[name='patronal']").val(arr[0].codigoempresa);

                }
            } else {
                swal({
                    //className: "red-bg",
                    title: "IMPORTANTE",
                    text: "El paciente no tiene registro de atención en el hospital Obrero #3, debe informar a Vigencia para regularizar el acceso al establecimiento y posterior atención!!!.",
                    icon: "warning",
                    //buttons: true,
                    dangerMode: true
                })

                //alert("El paciente no tiene registro de atención en el hospital Obrero #3, debe informar a Vigencia para regularizar el acceso al establecimiento y posterior atención.");
            }
        }
    });
    $("#listAsegurados").empty();
    //limpiarAsignarPaciente();

}

function asignarPaciente(id, flag) {
    //console.log(id);
    if (!flag) {
        idActual = id;
        limpiarAsignarPaciente();
        //cargarPersona(id);

        $("#modalAsignarPaciente").modal("show");


    } else {
        var bandera = true;
        if ($("input[name='MatriculaoCi']").val() == "") {
            $("input[name='MatriculaoCi']").css("border", "1px solid red");
            bandera = false;
        }

        if (!bandera) {
            $("#msgAsignar").css("display", "block");
        } else {
            let nomal = document.getElementById("normal").checked;
            let aislado = document.getElementById("aislado").checked;
            let radio = 0;
            if (normal) {
                radio = 2;
            }
            if (aislado) {
                radio = 3;
            }
            var param = {
                idCama: idActual,
                nombres: $("input[name='nombres']").val(),
                matricula: $("input[name='matricula']").val(),
                fecnacimiento: $("input[name='fec_nacimiento']").val(),
                cie10: $("input[name='cie10']").val(),
                diagnostico: $("input[name='diagnostico']").val(),
                medico: $("input[name='medico']").val(),
                especialidad: $("input[name='especialidad']").val(),
                idhistorial: $("input[name='id_historial']").val(),
                edad: $("input[name='edad']").val(),
                sexo: $("input[name='sexo']").val(),
                codcns: $("input[name='codcns']").val(),
                empresa: $("input[name='empresa']").val(),
                patronal: $("input[name='patronal']").val(),
                diagnosticoenfermeria: $("input[name='diagnosticoEnfermeria']").val(),
                tipoingreso: radio
            }
            console.log(param);
            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Cama/asignarCama/",
                beforeSend: function (xhr) {
                }, success: function (data, textStatus, jqXHR) {
                    //console.log(data);
                    if (data > 0) {
                        swal({
                            icon: "success",
                            Title: "Asignación de cama con Exito!!",
                            dangerMode: true,
                        })
                        //alert("Asignación de cama con Exito!!");
                        location.href = base_url() + "test";
                        $("#modalAsignarPaciente").modal("hide");


                    } else {
                        var arr = JSON.parse(data);
                        $.each(arr, function (index, contenido) {
                            nombres = contenido.nombres;
                            matricula = contenido.matricula;
                            piso = contenido.numero_piso;
                            cama = contenido.numero_cama;
                        });
                        swal(
                                "Paciente: " + nombres,
                                //"Matricula: "+matricula,
                                "Esta internado en: " + piso + " - Cama: " + cama,
                                {icon: "warning", dangerMode: true, });
                        //alert();
                    }
                }
            })
        }
    }
}

function verPacienteByCama(id) {
    //console.log(id);
    var datos = {
        "idcama": id
    }

    $.ajax({
        data: datos,
        type: 'POST',
        url: base_url() + "Cama/verPacienteByCama/",
        beforeSend: function (xhr) {
            //console.log(data);
        },
        success: function (data, textStatus, jqXHR) {
            if (data != "null") {

                var arr = JSON.parse(data);
                var sexo = "";
                console.log(arr);
                $.each(arr, function (index, contenido) {
                    sexo = (contenido.sexo == 1) ? "Mujer" : "Hombre";
                    //console.log(sexo);
                    $("input[name='nombres']").val(contenido.nombres);
                    $("input[name='matricula']").val(contenido.matricula);
                    $("input[name='cie10']").val(contenido.cie10);
                    $("input[name='diagnostico']").val(contenido.diagnostico);
                    $("input[name='medico']").val(contenido.medico);
                    $("input[name='especialidad']").val(contenido.especialidad);
                    $("#fecha").val(contenido.fecha);
                    $("#edad").val(contenido.edad);
                    $("#usuario").val(contenido.usuario);
                    $("#sexo").val(sexo);
                });
            } else {
                alert("no hay datos");

            }
        }
    });
    $("#modalPacienteByCama").modal("show");

}

function liberarCama(id, flag) {
    console.log(id);
    if (!flag) {
        idActual = id;
        $("#modalAltaPaciente").modal("show");

    } else {
        var param = {
            idCama: idActual
                    //estado:1
        }
        $.ajax({
            data: param,
            type: 'POST',
            url: base_url() + "Cama/liberarCama/",
            beforeSend: function (xhr) {

            }, success: function (data, textStatus, jqXHR) {
                if (data == 1) {
                    location.href = base_url() + "test";
                    $("#modalAltaPaciente").modal("hide");
                } else {
                    alert("Ocurrio un problemas al Liberar la cama");
                }
            }
        })
    }

}


function limpiarAsignarPaciente() {
    $("#formAsignar input").val("");
    ;
    $("#formAsignar input").css("border", "1px solid #ccc");
    $(".msgAlertas").css("display", "none");
    $("#formVerPaciente input").val("");
    ;
    $("#formVerPaciente input").css("border", "1px solid #ccc");
    //$("#listAsegurados").empty();

}