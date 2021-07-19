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
        $(this).append('<ul class="list-inline" style="text-align: center;font-size: 15px; font-weight:bold;"><li class="detalleCama" style="background-color: green;height: 15px;width: 15px;" title="Total de camas"></li><span id="totalCamas-' + id + '"></span><li class="detalleCama" style="background-color: white;height: 15px;width: 15px;" title="Camas libres"></li><span id="camasLibres-' + id + '"></span><li class="detalleCama" style="background-color: red;height: 15px;width: 15px;" title="Camas Ocupadas"></li><span id="camasOcupadas-' + id + '"></span></ul>');
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
            //console.log(arr);
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
                //console.log(arr);
                $.each(arr, function (index, contenido) {

                    if (contenido.bloque == dato) {
                        if (contenido.idSala != sala) {
                            resultado = 12 / aux;
                            $("#sala-" + sala + ">div").addClass("col-md-" + resultado);
                            sala = contenido.idSala;
                            bloque = contenido.bloque.replace(" ", "");
                            bloque = bloque.toLowerCase();
                            aux = 1;
                            estado = (contenido.estado == 1) ? "<p style = 'font-weight: 500;font-weight: bold;color : green;font-size:30px;'>Libre</p>" : "<p style = 'font-size:25px;font-weight: 800; color : red;'>Ocupado</p>";
                            control = (contenido.estado == 1) ? '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-success" title = "Asignar cama"  onclick = "asignarPaciente('+contenido.id+', false)"><i class = "fa fa-check"></i></button></div>' : '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-danger" title = "Liberar cama" onclick = "liberarCama('+contenido.id+', false)"><i class = "fa fa-trash-o"></i></button><button type="button" class="btn btn-info" title  = "Ver detalles de paciente"onclick = "verPacienteByCama('+contenido.id+')"><i class = "fa fa-eye"></i></button></div>';
                            $("#theBloque").append('<div class="row salas" id="sala-' + contenido.idSala + '" style="margin-top: 0px;"></div>');
                            $("#sala-" + contenido.idSala).append('<div class="card" style="font-weight: bold;font-size:13px;"><label>Número de cama: </label>' + contenido.numeroCama + ' ' + contenido.sala + '<br/><label>Estado: </label>'+estado+'<br/><br/>'+control+'</div>');
                        } else {
                            aux++;
                            estado = (contenido.estado == 1) ? "<p style = 'font-weight: 500;font-weight: bold;color : green;font-size:30px;'>Libre</p>" : "<p style = 'font-size:25px;font-weight: 800; color : red;'>Ocupado</p>";
                            control = (contenido.estado == 1) ? '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-success" title = "Asignar cama"  onclick = "asignarPaciente('+contenido.id+', false)"><i class = "fa fa-check"></i></button></div>' : '<div class="btn-group" role="group" aria-label="Basic example"><button type="button" class="btn btn-danger" title = "Liberar cama" onclick = "liberarCama('+contenido.id+', false)"><i class = "fa fa-trash-o"></i></button><button type="button" class="btn btn-info" title  = "Ver detalles de paciente" onclick = "verPacienteByCama('+contenido.id+')"><i class = "fa fa-eye"></i></button></div>';
                            $("#sala-" + contenido.idSala).append('<div class="card" style="font-weight: bold;font-size:13px;"><label2>Número de cama: </label>' + contenido.numeroCama + ' ' + contenido.sala + '<br/><label>Estado: </label>'+estado+'<br/><br/>'+control+'</div>');
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
                    (contenido.estado == 1) ? $("#camasLibres-" + bloque).text(contenido.cantidad) : $("#camasOcupadas-" + bloque).text(contenido.cantidad);
                })
                $("#totalCamas-" + bloque).text(total);

            }

        }
    })
}


function asignarPaciente(id,flag){
     if (!flag) {
        idActual=id;
        limpiarAsignarPaciente();
        //cargarPersona(id);

        $("#modalAsignarPaciente").modal("show");
        
    }else{
         var bandera = true;
        if ($("input[name='MatriculaoCi']").val() == "") {
            $("input[name='MatriculaoCi']").css("border", "1px solid red");
            bandera = false;
        }

         if (!bandera) {
            $("#msgAsignar").css("display", "block");
        }else{
            var param = {
                idcama:idActual,
                nombres: $("input[name='nombres']").val(),
                matricula: $("input[name='matricula']").val(),
                cie10: $("input[name='cie10']").val(),
                diagnostico: $("input[name='diagnostico']").val(),
                medico: $("input[name='medico']").val(),
                especialidad: $("input[name='especialidad']").val(),
                idhistorial: $("input[name='id_historial']").val(),
                edad: $("input[name='edad']").val(),
                sexo: $("input[name='sexo']").val()
            }
            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Cama/asignarCama/",
                beforeSend: function (xhr) {
                    
                }, success: function (data, textStatus, jqXHR) {
                    if (data == 1) {
                        alert("Asignación de cama con Exito!!");
                        location.href=base_url()+"test";
                        $("#modalAsignarPaciente").modal("hide");
                        
                        
                    } else {
                        alert("Ocurrio un problemas al registrar a la persona");
                    }
                }
            })
        }
    }
}

var idActual=0;

function buscarPaciente(){   
      var bandera = true;
        if ($("input[name='MatriculaoCi']").val() == "") {
            $("input[name='MatriculaoCi']").css("border", "2px solid red");
            bandera = false;
        }

         if (!bandera) {
            $("#msgAsignar").css("display", "block");
        }else{
           var datos = $("input[name='MatriculaoCi']").val();
            $.ajax({
                type: 'GET',
                url: "http://172.25.0.10:8080/rfdi/index.php/welcome/obtenerPacientes/"+datos+"/"+datos,
                success: function (data,textStatus,jqXHR) {
                    //console.log(data);
                    if(data!="null"|| data==""){
                       if (data.length > 0) {
                           $("input[name='nombres']").val(data[0].nombres);
                           $("input[name='matricula']").val(data[0].nro_registro);
                           $("input[name='cie10']").val(data[0].cie10);
                           $("input[name='diagnostico']").val(data[0].diagnostico);
                           $("input[name='medico']").val(data[0].medico);
                           $("input[name='especialidad']").val(data[0].especialidad);
                           $("input[name='id_historial']").val(data[0].id_historial);
                           $("input[name='edad']").val(data[0].edad);
                           $("input[name='sexo']").val(data[0].id_tipo_sexo);
                       }else{ $("#msgAsignar").css("display", "block");}
                    }else{
                        alert("No se encontro datos relacionados al asegurado");
                    }
                }
             });
        }
}

function verPacienteByCama(id){

    var datos={
            "idcama":id
        }
        
        $.ajax({
            data: datos,
            type: 'POST',
            url: base_url()+"Cama/verPacienteByCama/",
            beforeSend:function(xhr){
                //console.log(data);
            },
            success:function(data,textStatus,jqXHR){
                if(data!="null"){
                    
                        var arr=JSON.parse(data);
                        var sexo = "";
                        console.log(arr);
                    $.each(arr,function(index, contenido) {
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
                }else{
                    alert("no hay datos");
                    
                }
            }
        });
    $("#modalPacienteByCama").modal("show");

}

function liberarCama(id,flag){
    if (!flag) {
        idActual=id;
        $("#modalAltaPaciente").modal("show");
        
    }else{
        var param = {
                idCama:idActual,
                estado:1
            }
            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Cama/cambiarEstadoCama/",
                beforeSend: function (xhr) {
                    
                }, success: function (data, textStatus, jqXHR) {
                    if (data == 1) {
                        location.href=base_url()+"test";
                        $("#modalAltaPaciente").modal("hide");
                    } else {
                        alert("Ocurrio un problemas al Liberar la cama");
                    }
                }
            })
        }
    
}


function limpiarAsignarPaciente() {
    $("#formAsignar input").val("");;
    $("#formAsignar input").css("border", "1px solid #ccc");
    $(".msgAlertas").css("display", "none");
    $("#formVerPaciente input").val("");;
    $("#formVerPaciente input").css("border", "1px solid #ccc");

}