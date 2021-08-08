$(document).ready(function () {
    //opcion1();
    URLactual = window.location.href;
    $("#nombrePiso").text("Piso "+ URLactual);
    URLactual = URLactual.split("/");
    URLactual = parseInt(URLactual[URLactual.length-1]);
    $("#nombrePiso").text("Piso "+ URLactual);
    $(".card-body").click(function () {
        var id = $(this).attr("id");
        var nombreBolque = $(this).find("h1").text();
        $("#nombreBloque").text(nombreBolque + " ");
        
        opcion2(nombreBolque);
        cargarTipoAltas();
        //alert();
    })
    
    $(".card-body").each(function (i, obj) {
        var id = $(this).attr("id");
        //$(this).append('<ul class="list-inline" style="text-align: center;font-size: 15px; font-weight:bold;"><li class="detalleCama" style="background-color: white;height: 15px;width: 15px;" title="Total de camas" ></li><span id="totalCamas-' + id + '"></span><li class="detalleCama" style="background-color: green;height: 15px;width: 15px;" title="Camas libres"></li><span id="camasLibres-' + id + '"></span><li class="detalleCama" style="background-color: red;height: 15px;width: 15px;" title="Camas Ocupadas"></li><span id="camasOcupadas-' + id + '"></span></ul>');
        $(this).append('<ul class="list-inline" ><span class="detalleCama badge badge-primary" style="text-align: left;font-size: 20px; font-weight:bold;height: 28px;width: 30px; color:white;"id="totalCamas-' + id + '" title="Total de camas" ></span><li class="detalleCama" style="background-color: green;height: 15px;width: 15px;" title="Camas libres"></li><span id="camasLibres-' + id + '"></span><li class="detalleCama" style="background-color: red;height: 15px;width: 15px;" title="Camas Ocupadas"></li><span id="camasOcupadas-' + id + '"></span><span class="detalleCama badge badge-warning" style="text-align: left;font-size: 20px; font-weight:bold;height: 28px;width: 30px; color:white;" title="Camas Aisladas" id="camasAisladas-' + id + '"  ></span></ul>');
        cargarDetalleByBloque($(this).find("h1").text());
    })
    
    cargarPisos();
    $("#pisos").change(function () {
        listarCamas($(this).val());
    });
})
var idActual = 0;
var URLActual = "";

function mostrarEquipamiento() {
        element = document.getElementById("listEquipamiento");
        riesgo = document.getElementById("riesgo");
        

        if (riesgo.checked) {
            element.style.display='block';
            $("#normal").attr('disabled','disabled');
            $("#normal").attr('checked', false);
            $("#aislado").attr('disabled','disabled');
            $("#aislado").attr('checked', false);
        }
        else {
            element.style.display='none';
            $("#normal").removeAttr('disabled');
            $("#aislado").removeAttr('disabled');
        }
    }

function cargarTipoAltas() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Cama/cargarTipoAltas",
        beforeSend: function (xhr) {
            $("#cmbAlta").empty();
        }, success: function (data, textStatus, jqXHR) {
            //console.log(data);
            $("#cmbAlta").append("<option value = 0 selected>Elija el tipo de alta</option>");
            if (data != "null") {
                var arr = JSON.parse(data);
                $.each(arr, function (i, c) {
                    $("#cmbAlta").append("<option value = " + c.id + ">" + c.tipoAlta + "</option>");
                })
                
            } else {
            }
            $("#cmbAlta").change();
        }
    })
}

function cargarCamas() {
    
}

function cargarDetalleCamasByBloques() {
    
}

function opcion1() {
    var param = {
        idPiso: URLactual
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
        idPiso: URLactual
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
                    //console.log(contenido.asignacion);
                    var detalleAsignacion = "";
                    var diasInternado = "";
                    var nombrePaciente = ""
                    if (contenido.asignacion != "null") {
                        detalleAsignacion = JSON.parse(contenido.asignacion);
                        if (contenido.diasInternacion >= 0) {
                            diasInternado = contenido.diasInternacion;
                            nombrePaciente = detalleAsignacion[0]["nombres"];
                        }
                        
                    }
                    estadocama = contenido.estado;
                    //console.log(estadocama);
                    if (contenido.bloque == dato) {
                        //console.log("numero de cama: " + contenido.numeroCama + " dias de internacion: " + contenido.diasInternacion + " idAsignacion: " + contenido.asignacion);
                        if (contenido.idSala != sala) {
                            resultado = 12 / aux;
                            $("#sala-" + sala + ">div").addClass("col-md-" + resultado);
                            sala = contenido.idSala;
                            bloque = contenido.bloque.replace(" ", "");
                            bloque = bloque.toLowerCase();
                            aux = 1;
                            estadopaciente = (estadocama == 2) ? '<p style = "font-size:15px;font-weight: 800; color : black;-webkit-text-stroke: 1px black;">INTERNADO POR:<a style="color:red; font-size:18px;">' + diasInternado + ' días</a></p>' : ((estadocama == 3) ? '<p style = "font-size:15px;font-weight: 800; color : yellow;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">AISLADO POR:<a style="color:red; font-size:18px;">' + diasInternado + ' días</a> </p>' : '<p></p>');
                            control = (contenido.estado == 1) ? '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-success" title = "Asignar cama"  onclick = "asignarPaciente(' + contenido.id + ', false)">Asignar paciente</button></div>' : '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-danger" title = "Liberar cama" onclick = "liberarCama(' + contenido.id + ', false)"><i class = "fa fa-trash-o"></i></button><button type="button" class="btn btn-info" title  = "Ver detalles de paciente"onclick = "verPacienteByCama(' + contenido.id + ')"><i class = "fa fa-eye"></i></button><button type="button" class="btn btn-warning" title  = "Transferir Paciente"onclick = "transferirPaciente(' + contenido.id + ',false)"><i class = "fa fa-exchange"></i></button></div>';
                            $("#theBloque").append('<div class="row salas" id="sala-' + contenido.idSala + '" style="margin-top: 0px;"></div>');
                            if (contenido.estado == 1) {
                                $("#sala-" + contenido.idSala).append('<div><div class="alert alert-success alert-white rounded" style="font-weight: bold;font-size:13px; margin-right: 15px; padding-right: 2px;background-color : ' + colorPaciente(estadocama) + '"><p>Número de cama: ' + contenido.numeroCama + ' ' + contenido.sala + '</p><br/><br/><br/>' + control + '<div class="icon" style = "background-color : ' + colorCama(contenido.diasInternacion) + '"></div></div></div>');
                            } else {
                                $("#sala-" + contenido.idSala).append('<div><div class="alert alert-success alert-white rounded" style="font-weight: bold;font-size:13px; margin-right: 15px; padding-right: 2px;background-color : ' + colorPaciente(estadocama) + '"><p>Número de cama: ' + contenido.numeroCama + ' ' + contenido.sala + '</p><p style = "font-size:15px;font-weight: 800; color : black;">INTERNADO POR:<a style="color:red; font-size:18px;">' + diasInternado + ' días</a></p><p>Nombre del paciente: ' + nombrePaciente + '</p><br/><br/>' + control + '<div class="icon" style = "background-color : ' + colorCama(contenido.diasInternacion) + '"></div></div></div>');
                            }   
                            //$("#sala-" + contenido.idSala).append('<div><div class="alert alert-success alert-white rounded" style="font-weight: bold;font-size:13px; margin-right: 15px; padding-right: 2px;background-color : ' + colorPaciente(estadocama) + '"><p>Número de cama: ' + contenido.numeroCama + ' ' + contenido.sala + '</p><p>'+estadopaciente+'<a style="color:red; font-size:13px;">' + diasInternado + ' días</a> </p><p>Nombre del paciente: ' + nombrePaciente + '</p><br/><br/>' + control + '<div class="icon" style = "background-color : ' + colorCama(contenido.diasInternacion) + '"></div></div></div>');
                            //$("#sala-" + contenido.idSala).append('<div class="card" style="font-weight: bold;font-size:13px;"><label>Número de cama: </label>' + contenido.numeroCama + ' ' + contenido.sala + '<br/><label>Estado: </label>' + estado + '<br/><br/>' + control + '</div>');
                        } else {
                            aux++;
                            //estado = (contenido.estado == 1) ? "<p style = 'font-weight: 500;font-weight: bold;color : green;font-size:20px;'>CAMA LIBRE</p>" : ((contenido.estado == 2) ? "<p style = 'font-size:20px;font-weight: 800; color : red;'>CAMA OCUPADA</p>" : "<p style = 'font-size:20px;font-weight: 800; color : #ffd700;'>PACIENTE AISLADO</p>");
                            control = (contenido.estado == 1) ? '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-success" title = "Asignar cama"  onclick = "asignarPaciente(' + contenido.id + ', false)">Asignar paciente</button></div>' : '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-danger" title = "Liberar cama" onclick = "liberarCama(' + contenido.id + ', false)"><i class = "fa fa-trash-o"></i></button><button type="button" class="btn btn-info" title  = "Ver detalles de paciente" onclick = "verPacienteByCama(' + contenido.id + ')"><i class = "fa fa-eye"></i></button><button type="button" class="btn btn-warning" title  = "Transferir Paciente"onclick = "transferirPaciente(' + contenido.id + ',false)"><i class = "fa fa-exchange"></i></button></div>';
                            if (contenido.estado == 1) {
                                $("#sala-" + contenido.idSala).append('<div><div class="alert alert-success alert-white rounded" style="font-weight: bold;font-size:13px; margin-right: 15px; padding-right: 2px;background-color : ' + colorPaciente(estadocama) + '"><p>Número de cama: ' + contenido.numeroCama + ' ' + contenido.sala + '</p><br/><br/><br/>' + control + '<div class="icon" style = "background-color : ' + colorCama(contenido.diasInternacion) + '"></div></div></div>');
                            } else {
                                $("#sala-" + contenido.idSala).append('<div><div class="alert alert-success alert-white rounded" style="font-weight: bold;font-size:13px; margin-right: 15px; padding-right: 2px;background-color : ' + colorPaciente(estadocama) + '"><p>Número de cama: ' + contenido.numeroCama + ' ' + contenido.sala + '</p><p style = "font-size:15px;font-weight: 800; color : black;">INTERNADO POR:<a style="color:red; font-size:18px;">' + diasInternado + ' días</a></p><p>Nombre del paciente: ' + nombrePaciente + '</p><br/><br/>' + control + '<div class="icon" style = "background-color : ' + colorCama(contenido.diasInternacion) + '"></div></div></div>');
                            }
                            
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
    if (diasInternacion >= 0 && diasInternacion <= 7) {
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

function colorPaciente(estadocama) {
    if (estadocama == 1) {
        return "#fff";
    }
    if (estadocama == 2) {
        return "#ffdaca";
    }
    if (estadocama == 3) {
        return"#ffffbf";
    }
     if (estadocama == 4) {
        return"#85c1e9";
    }
}

function cargarDetalleByBloque(nombreBloque) {
    console.log(URLactual);
    var param = {
        idPiso: URLactual,
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
            let riesgo = document.getElementById("riesgo").checked;

            let radio = 0;
            if (normal) {
                radio = 2;
            }
            if (aislado) { 
                radio = 3;
            }
            if (riesgo){
                radio=4;

                var arr = [];

                $("input:checkbox[name=check]:checked").each(function(){
                    arr.push($(this).val());
                    console.log(arr);
                });
                var equipamiento=json_encode(arr);
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
                tipoingreso: radio,
                equipamiento:equipamiento
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
                        location.href = window.location.href;
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
                //console.log(arr);
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
    //console.log(id);
    if (!flag) {
        idActual = id;
        $("#modalAltaPaciente").modal("show");
        
    } else {
        if ($("#cmbAlta").val() != 0) {
            var param = {
                idCama: idActual,
                tipoAlta: $("#cmbAlta").val()
                        //estado:1
            }
            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Cama/liberarCama/",
                beforeSend: function (xhr) {
                    
                }, success: function (data, textStatus, jqXHR) {
                    //console.log(data);
                    if (data == 1) {
                        location.href = window.location.href;
                        $("#modalAltaPaciente").modal("hide");
                    } else {
                        alert("Ocurrio un problemas al Liberar la cama");
                    }
                }
            })
        } else {
            swal({
                icon: "danger",
                Title: "Alerta!!",
                dangerMode: true,
            })
            swal(
                    "Escoje un tipo de alta valida",
                    {icon: "warning", dangerMode: true, });
        }
    }
    
}

function transferirPaciente(id,flag) {
     //console.log(id);
    if (!flag) {
        idActual = id;
        obtenerPaciente(id);
         $("#modalTransferirPaciente").modal("show");
        
    } else {
        if ($("#cmbAlta").val() != 0) {
            var param = {
                idCama: idActual,
                tipoAlta: $("#cmbAlta").val()
                        //estado:1
            }
            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Cama/liberarCama/",
                beforeSend: function (xhr) {
                    
                }, success: function (data, textStatus, jqXHR) {
                    console.log(data);
                    if (data == 1) {
                        location.href = window.location.href;
                        $("#modalAltaPaciente").modal("hide");
                    } else {
                        alert("Ocurrio un problemas al Liberar la cama");
                    }
                }
            })
        } else {
            swal({
                icon: "danger",
                Title: "Alerta!!",
                dangerMode: true,
            })
            swal(
                    "Escoje un tipo de alta valida",
                    {icon: "warning", dangerMode: true, });
        }
    }    
    limpiarAsignarPaciente();
}

function obtenerPaciente(id) {
    //console.log(id);
    var datos = {
        "idcama": id
    }
    
    $.ajax({
        data: datos,
        type: 'POST',
        url: base_url() + "Cama/verPacienteByCama/",
        beforeSend: function (xhr) {
            console.log("aqui");
        },
        success: function (data, textStatus, jqXHR) {
            console.log(data);
            if (data != "null") {
                
                var arr = JSON.parse(data);
                var sexo = "";
                
                $.each(arr, function (index, contenido) {
                    sexo = (contenido.sexo == 1) ? "Mujer" : "Hombre";
                    //console.log(sexo);
                    $("input[name='nombres']").val(contenido.nombres);
                    $("input[name='diagnostico']").val(contenido.diagnostico);
                    $("input[name='medico']").val(contenido.medico);
                    $("input[name='especialidad']").val(contenido.especialidad);
                    $("input[name='idhistorial']").val(contenido.idhistorial);
                    $("input[name='codcns']").val(contenido.codcns);
                    $("input[name='matricula']").val(contenido.matricula);
                    $("input[name='cie10']").val(contenido.cie10);
                    $("input[name='fecnacimiento']").val(contenido.fecnacimiento);
                    $("input[name='empresa']").val(contenido.empresa);
                    $("input[name='patronal']").val(contenido.patronal);
                    $("#edad").val(contenido.edad);
                    $("#sexo").val(sexo);
                    $("#pisos").val(contenido.idpiso);
                });
            } else {
                alert("no hay datos");
                
            }
            $("#pisos").change();
        }
    });    
}


function cargarPisos() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Cama/cargarPisos/",
        beforeSend: function () {
            $("#pisos").empty();
        },
        success: function (response) {
            //console.log(response);
            if (response != null && response != "") {
                
                var arr = JSON.parse(response);
                if (arr.length > 0) {
                    $("#pisos").append("<option value='0' selected >Seleccione Piso</option>");
                    $.each(arr, function (index, contenido) {
                        $("#pisos").append("<option value='" + contenido.id + "'>" + contenido.numeroPiso + "</option>");
                    })
                } else {
                    alert("No se pudieron cargar los funcionarios de la CNS");
                }
            } else {
                alert("No se pudieron cargar los funcionarios de la CNS");
            }
            $("#pisos").change();
        }
    })
}
function listarCamas(pisos) {
    
    var datos = {
        idpiso: pisos
    }
    //console.log(datos);
    $.ajax({
        data: datos,
        type: 'POST',
        url: base_url() + "Cama/listarCamas",
        beforeSend: function () {
            $("#camas").empty();
        },
        success: function (response) {
            //console.log(response);
            try {
                var arr = JSON.parse(response);
                $("#camas").append("<option value = '0' selected>Seleccione Cama</option>");
                //$("#equipotransferido").empty();
                $.each(arr, function (index, contenido) {
                    $("#camas").append("<option value = '" + contenido.idcama + "'>" + contenido.numerocama + "</option>");
                })
                
                $("#camas").change();
            } catch (e) {
                
            }
            
        }
    });
}

function limpiarAsignarPaciente() {
    $("#formAsignar input").val("");
    ;
    $("#formAsignar input").css("border", "1px solid #ccc");
    $(".msgAlertas").css("display", "none");
    $("#formVerPaciente input").val("");
    ;
    $("#formVerPaciente input").css("border", "1px solid #ccc");
    $(".modal .select2").change();
    $(".modal .select2").val(0);
    //$("#listAsegurados").empty();
    $("#modalTransferirPaciente input").val("");
    
}