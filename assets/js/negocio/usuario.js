$(document).ready(function () {
    cargarUsuarios();

})
var idActual=0;


function cargarUsuarios() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Usuario/cargarUsuarios",
        beforeSend: function (xhr) {
            $("#tablaUsuario>tbody").empty();
        }, success: function (data, textStatus, jqXHR) {
            //console.log(data);
            if (data != "null") {
                var arr = JSON.parse(data);
                var estado = "";
                $.each(arr, function (index, contenido) {
                    estado = (contenido.estado == 0) ? "Inactivo" : "Activo";
                    //console.log(contenido.id);
                    $("#tablaUsuario>tbody").append('<tr><td>' + contenido.nombres + ' ' + contenido.apellidos + '</td><td>' + contenido.establecimiento + '</td><td>' + contenido.rol + '</td><td>' + contenido.usuario + '</td><td>' + estado + '</td><td><a class="btn btn-warning" onclick = "editarUsuario('+contenido.id+', false)"><i class="fa fa-pencil"></i></a><a class="btn btn-info" onclick = "editarContrasena('+contenido.id+', false)"><i class="fa fa-key"></i></a><a class="btn btn-danger" onclick = "eliminarPersona('+contenido.id+', false)"><i class="fa fa-trash-o"></i></a></td></tr>');
                });

                function fnFormatDetails(oTable, nTr)
                {
                    var aData = oTable.fnGetData(nTr);
                    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
                    sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
                    sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
                    sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
                    sOut += '</table>';

                    return sOut;
                }
                var nCloneTh = document.createElement('th');
                var nCloneTd = document.createElement('td');
                nCloneTd.innerHTML = '<img class="toggle-details" src="images/plus.png" />';
                nCloneTd.className = "center";

                $('#datatable2 thead tr').each(function () {
                    this.insertBefore(nCloneTh, this.childNodes[0]);
                });

                $('#datatable2 tbody tr').each(function () {
                    this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
                });
                var oTable = $('#datatable2').dataTable({

                    "aoColumnDefs": [

                        {"bSortable": false, "aTargets": [0]}

                    ],

                    "aaSorting": [[1, 'asc']]

                });


                $('#datatable2').delegate('tbody td img', 'click', function () {

                    var nTr = $(this).parents('tr')[0];

                    if (oTable.fnIsOpen(nTr))

                    {

                        /* This row is already open - close it */

                        this.src = "images/plus.png";

                        oTable.fnClose(nTr);

                    } else

                    {

                        /* Open this row */

                        this.src = "images/minus.png";

                        oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');

                    }

                });



                $('.dataTables_filter input').addClass('form-control').attr('placeholder', 'Buscar...');

                $('.dataTables_length select').addClass('form-control');



                //Horizontal Icons dataTable

                $('#tablaUsuario').dataTable();
            } else {
                $("#tablaUsuario>tbody").append('<tr><td style = "text-align: center;" colspan = "9">No se encontraron resultados</td></tr>');
            }



        }
    })
}



function nuevoUsuario(flag) {
    if (!flag) {
        limpiarDatosUsuario();
        $("#btnEditarUsuario").show();
        $("#modalNuevoUsuario").modal("show");
    } else {
        var bandera = true;
        if ($("input[name='usuario']").val() == "") {
            $("input[name='usuario']").css("border", "1px solid red");
            bandera = false;
        }

        if ($("input[name='contraseña']").val() == "") {
            $("input[name='contraseña']").css("border", "1px solid red");
            bandera = false;
        }

        if ($("input[name='rContraseña']").val() == "") {
            $("input[name='rContraseña']").css("border", "1px solid red");
            bandera = false;
        }

        if ($("#cmbPersonas").val() == 0) {
            $("#s2id_cmbPersonas").css("border", "1px solid red");
            bandera = false;
        }

         if ($("#cmbRoles").val() == 0) {
            $("#s2id_cmbRoles").css("border", "1px solid red");
            bandera = false;
        }

        if (!bandera) {
            $("#msgUsuarios").css("display", "block");
        } else {
            if($("input[name='contraseña']").val()==$("input[name='rContraseña']").val()){
                var param = {
                    usuario: $("input[name='usuario']").val(),
                    contrasena: $("input[name='contraseña']").val(),
                    persona: $("#cmbPersonas").val(),
                    rol: $("#cmbRoles").val()
                }

                $.ajax({
                    data: param,
                    type: 'POST',
                    url: base_url() + "/Usuario/nuevoUsuario/",
                    beforeSend: function (xhr) {
                        $("#btnGuardarUsuario").prop("disabled", true);
                        $("#btnGuardarUsuario").text("Guardando...");
                    }, success: function (data, textStatus, jqXHR) {
                        
                        if (data == 1) {
                            $("#btnGuardarUsuario").prop("disabled", false);
                            $("#btnGuardarUsuario").text("Guardar");
                            cargarUsuarios();
                            $("#modalNuevoUsuario").modal("hide");
                            alert("El Usuario se registro exitosamente");
                            
                        } else {
                            alert("Ocurrio un problemas al registrar el Usuario");
                        }
                    }
                })
            }else{
                alert("La contraseña de verificación no coincide. ");
            }
        }


    }
}

function cargarUsuario(id){
    var datos ={
        "idusuario":id
    }
    $.ajax({
        
        data: datos,
        type: 'POST',
        url: base_url()+"Usuario/getUsuario/",
        beforeSend:function(xhr){
            
            
        },
        success: function (data,textStatus, jqXHR) {
                    console.log(data);
                    if(data!="null"){
                        var arr=JSON.parse(data);
                        $.each(arr,function(index,contenido){
                            $("input[name='usuario']").val(contenido.usuario);
                            //$("input[name='contraseña']").val(contenido.contrasena);
                            $("#cmbRoles").val(contenido.idrol);
                        })     
                    }else{

                    }
                    $("#cmbRoles").change();
                    $('#btnGuardarUsuario').hide();
                    $("#btnEditarUsuario").show();
                    $("input[name='rContraseña']").hide();
                    $("#cmbPersonas").hide();
                }
    });         
}

function editarUsuario(id,flag) {
    if (!flag) {
        idActual=id;
        limpiarDatosUsuario();
        cargarUsuario(id);

        $("#modalNuevoUsuario").modal("show");
        
    } else {
        var bandera = true;
        if ($("input[name='usuario']").val() == "") {
            $("input[name='usuario']").css("border", "1px solid red");
            bandera = false;
        }

        if ($("input[name='contraseña']").val() == "") {
            $("input[name='contraseña']").css("border", "1px solid red");
            bandera = false;
        }

        if ($("input[name='rContraseña']").val() == "") {
            $("input[name='rContraseña']").css("border", "1px solid red");
            bandera = false;
        }

        if ($("#cmbPersonas").val() == 0) {
            $("#s2id_cmbPersonas").css("border", "1px solid red");
            bandera = false;
        }

         if ($("#cmbRoles").val() == 0) {
            $("#s2id_cmbRoles").css("border", "1px solid red");
            bandera = false;
        }

        if (!bandera) {
            $("#msgUsuarios").css("display", "block");
        } else {
            var param = {
                id:idActual,
                nombres: $("input[name='nPersona']").val(),
                apellidos: $("input[name='aPersona']").val(),
                ci: $("input[name='ci']").val(),
                matricula: $("input[name='matricula']").val(),
                telefono: $("input[name='telefono']").val(),
                cargo: $("#cmbCargos").val(),
                establecimiento: $("#cmbEstablecimientos").val()
            }
            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Persona/editarPersona/",
                beforeSend: function (xhr) {
                    
                }, success: function (data, textStatus, jqXHR) {
                    //console.log(data);
                    if (data == 1) {
                        cargarPersonas();
                        $("#modalNuevaPersona").modal("hide");
                        alert("Se modificaron los datos exitosamente");
                        
                    } else {
                        alert("Ocurrio un problemas al registrar a la persona");
                    }
                }
            })
        }
    }
}


function eliminarPersona(id,flag){
    if(!flag){
        idActual=id;
        var bandera = true;
        $("#myModalConfirmacion").modal("show");
        

    }else{
           var param = {
                id:idActual,
            }
            $.ajax({
                data: param,
                type: 'POST',
                url: base_url() + "Persona/eliminarPersona/",
                beforeSend: function (xhr) {
                    
                }, success: function (data, textStatus, jqXHR) {
                    //console.log(data);
                    if (data == 1) {
                        cargarPersonas();
                        $("#myModalConfirmacion").modal("hide");
                        alert("Se Elimino el registro!!!!!");
                        
                    } else {
                        alert("Ocurrio un problemas al registrar a la persona");
                    }
                }
            }) 
    }
}


/*Seccion Personas*/

function cargarPersonas() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Persona/cargarPersonasU",
        beforeSend: function (xhr) {
            $("#cmbPersonas").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                $("#cmbPersonas").append("<option value = 0 selected>Selecione a la Persona</option>");
                $.each(arr, function (index, contenido) {
                    $("#cmbPersonas").append("<option value = " + contenido.id + ">"+ contenido.nombres + ' ' + contenido.apellidos +"</option>");
                })
            } else {
                $("#cmbPersonas").append("<option value = 0 selected>No hay datos para mostrar</option>");
            }
            $("#cmbPersonas").change();
        }
    })
}


/*Seccion Roles*/

function cargarRoles() {
    $.ajax({
        type: 'POST',
        url: base_url() + "Rol/cargarRoles",
        beforeSend: function (xhr) {
            $("#cmbRoles").empty();
        }, success: function (data, textStatus, jqXHR) {
            if (data != "null") {
                var arr = JSON.parse(data);
                $("#cmbRoles").append("<option value = 0 selected>Asigne el Establecimiento de la persona</option>");
                $.each(arr, function (index, contenido) {
                    $("#cmbRoles").append("<option value = " + contenido.id + ">" + contenido.rol + "</option>");
                })
            } else {
                $("#cmbRoles").append("<option value = 0 selected>No hay datos para mostrar</option>");
            }
            $("#cmbRoles").change();
        }
    })
}


function limpiarDatosUsuario() {
    $("#formPersona input").val("");
    cargarPersonas();
    cargarRoles();
    $("#btnEditarPersona").css("display", "none");
    $("#btnGuardarPersona").css("display", "inline");
    $("#formPersona .select2").css("border", "1px solid #ccc");
    $("#formPersona input").css("border", "1px solid #ccc");
    $(".msgAlertas").css("display", "none");

}