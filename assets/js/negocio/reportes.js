$(document).ready(function () {
    cargarDashboard();
    cargarUltimosMoviemientos();
    setInterval(function () {

        cargarDashboard();
        cargarUltimosMoviemientos();

    }, 1000 * 60);

})

function cargarDashboard() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Reporte/cargarDashBoard",
        beforeSend: function (xhr) {
            $(".tbl>thead").empty();
            $(".tbl>tbody").empty();
        }, success: function (data, textStatus, jqXHR) {
            //console.log(data);
            var arr = JSON.parse(data);
            $.each(arr, function (i, c) {
                $("#total_libres").text(c.camasLibres);
                $("#total_ocupadas").text(c.camasOcupadas);
                var internadosHoy = 0;
                if (c.asignacionesHoy != "null") {
                    internadosHoy = JSON.parse(c.asignacionesHoy);
                    $("#tblInternadosHoy>thead").append("<tr><th>CIE10</th><th>Tipo de ingreso</th><th>Cama</th><th>Piso</th><th>Bloque</th></tr>");
                    $.each(internadosHoy, function (indexInternados, internados) {
                        $("#tblInternadosHoy>tbody").append("<tr><td>" + internados.cie10 + "</td><td>" + internados.tipoIngreso + "</td><td>" + internados.cama + "</td><td>" + internados.piso + "</td><td>" + internados.bloque + "</td></tr>");
                    })
                    internadosHoy = internadosHoy.length;
                } else {
                    $("#tblInternadosHoy>tbody").append("No hay datos para mostrar");
                }
                $("#internados_hoy").text(internadosHoy);
                var pacientesCriticos = 0;
                if (c.pacientesCriticos != "null") {
                    pacientesCriticos = JSON.parse(c.pacientesCriticos);
                    $("#tblPacientesCriticos>thead").append("<tr><th>Días internados</th><th>Matrícula del asegurado</th><th>Cama</th><th>CIE10</th><th>Fecha de internación</th></tr>");
                    $.each(pacientesCriticos, function (indexCriticos, criticos) {
                        $("#tblPacientesCriticos>tbody").append("<tr><td>" + criticos.diasInternados + "</td><td>" + criticos.matricula + "</td><td>" + criticos.cama + "</td><td>" + criticos.cie10 + "</td><td>" + criticos.fechaInternacion + "</td></tr>");
                    })
                    pacientesCriticos = pacientesCriticos.length;
                } else {
                    $("#tblPacientesCriticos>tbody").append("No hay datos para mostrar");
                }
                $("#pacientes_criticos").text(pacientesCriticos);
                var pacientesAislados = 0;
                if (c.pacientesAislados != "null") {
                    pacientesAislados = JSON.parse(c.pacientesAislados);
                    $("#tblPacientesAislados>thead").append("<tr><th>Días internados</th><th>Matrícula del asegurado</th><th>Cama</th><th>CIE10</th><th>Fecha de internación</th></tr>");
                    $.each(pacientesAislados, function (indexAislados, aislados) {
                        $("#tblPacientesAislados>tbody").append("<tr><td>" + aislados.diasInternados + "</td><td>" + aislados.matricula + "</td><td>" + aislados.cama + "</td><td>" + aislados.cie10 + "</td><td>" + aislados.fechaInternacion + "</td></tr>");
                    })
                    pacientesAislados = pacientesAislados.length;
                } else {
                    $("#tblPacientesAislados>tbody").append("No hay datos para mostrar");
                }
                $("#total_aislados").text(pacientesAislados);
                var pacientesRiesgosos = 0;
                if (c.pacientesRiesgosos != "null") {
                    pacientesRiesgosos = JSON.parse(c.pacientesRiesgosos);
                    $("#tblPacientesRiesgosos>thead").append("<tr><th>Días internados</th><th>Matrícula del asegurado</th><th>Cama</th><th>CIE10</th><th>Fecha de internación</th></tr>");
                    $.each(pacientesRiesgosos, function (indexRiesgosos, riesgosos) {
                        $("#tblPacientesRiesgosos>tbody").append("<tr><td>" + riesgosos.diasInternados + "</td><td>" + riesgosos.matricula + "</td><td>" + riesgosos.cama + "</td><td>" + riesgosos.cie10 + "</td><td>" + riesgosos.fechaInternacion + "</td></tr>");
                    })
                    pacientesRiesgosos = pacientesRiesgosos.length;
                } else {
                    $("#tblPacientesRiesgosos>tbody").append("No hay datos para mostrar");
                }
                $("#total_riesgosos").text(pacientesRiesgosos);
            })
        }
    })
}

function cargarInformeElegido(id) {
    $(".tbl").css("display", "none");
    switch (id) {
        case "criticos":
            $("#txtReporte").text("Pacientes críticos");
            $("#tblPacientesCriticos").css("display", "inline-table");
            break;
        case "aislados":
            $("#txtReporte").text("Pacientes aislados");
            $("#tblPacientesAislados").css("display", "inline-table");
            break;
        case "riesgosos":
            $("#txtReporte").text("Pacientes en estado de riesgo");
            $("#tblPacientesRiesgosos").css("display", "inline-table");
            break;

        default:
            $("#txtReporte").text("Internaciones hoy");
            $("#tblInternadosHoy").css("display", "inline-table");
            break;
    }
}

function cargarUltimosMoviemientos() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Reporte/ultimosRegistros",
        beforeSend: function (xhr) {
            $("#ultimasNoticias").empty();
        }, success: function (data, textStatus, jqXHR) {
            console.log(data);
            if (data != null) {
                var arr = JSON.parse(data);
                $.each(arr, function (i, c) {
                    if (c.estado == 2) {
                        $("#ultimasNoticias").append('<div class="alert alert-success"><i class="fa fa-check sign"></i><strong>Cama liberada!</strong> La cama N° ' + c.cama + ' del piso ' + c.piso + ' bloque ' + c.bloque + ' ahora esta disponible</div>');
                    } else {
                        switch (c.tipoIngreso) {
                            case "2":
                                $("#ultimasNoticias").append('<div class="alert alert-danger"><i class="fa fa-times-circle sign"></i><strong>Cama ocupada!</strong> La cama N° ' + c.cama + ' del piso ' + c.piso + ' bloque ' + c.bloque + ' ha sido ocupada por un ingreso común</div>');
                                break;
                            case "3":
                                $("#ultimasNoticias").append('<div class="alert alert-warning"><i class="fa fa-warning sign"></i><strong>Cama ocupada!</strong> La cama N° ' + c.cama + ' del piso ' + c.piso + ' bloque ' + c.bloque + ' ha sido ocupada, el paciente esta en estado de aislamiento</div>');
                                break;
                            case "4":
                                $("#ultimasNoticias").append('<div class="alert alert-info"><i class="fa fa-info-circle sign"></i><strong>Cama ocupada!</strong> La cama N° ' + c.cama + ' del piso ' + c.piso + ' bloque ' + c.bloque + ' ha sido ocupada por un paciente en estado de riesgo</div>');
                                break;
                        }
                    }
                })
            } else {
                $("#ultimasNoticias").append("No hay datos para mostrar");
            }
        }
    })

}