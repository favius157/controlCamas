$(function () {
    
    consultarSesion();

    var textfield = $("input[name=user]");
    $('button[type="submit"]').click(function (e) {
        e.preventDefault();
        //little validation just to check username
        if (textfield.val() != "") {
            //$("body").scrollTo("#output");
            $("#output").addClass("alert alert-success animated fadeInUp").html("Welcome back " + "<span style='text-transform:uppercase'>" + textfield.val() + "</span>");
            $("#output").removeClass(' alert-danger');
            $("input").css({
                "height": "0",
                "padding": "0",
                "margin": "0",
                "opacity": "0"
            });
            //change button text 
            $('button[type="submit"]').html("continue")
                    .removeClass("btn-info")
                    .addClass("btn-default").click(function () {
                $("input").css({
                    "height": "auto",
                    "padding": "10px",
                    "opacity": "1"
                }).val("");
            });

            //show avatar
            $(".avatar").css({
                "background-image": "url('https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRL1uzmgyrfPwUC7UwnOFHFtkAhQrAUYufbLzWvOt9N8pRt1zlV')"
            });
        } else {
            //remove success mesage replaced with error message
            $("#output").removeClass(' alert alert-success');
            $("#output").addClass("alert alert-danger animated fadeInUp").html("sorry enter a username ");
        }
        //console.log(textfield.val());

    });

    $('.btnInsert').click(function () {
        limpiar();
    });

    $("#loginForm input").keypress(function (e) {
        if (e.which == 13) {
            if (validarCampos()) {
                startSession($("input[name='user']").val(), $("input[name='clave']").val());
            }
            else {
                $('#error').remove();
                $("#loginForm").append("<h1 id='error' style = 'color:red; width:70%; font-size: 20px;'>Debe llenar todos los campos</h1>");
            }
        }

    });

    $('#sub').click(function () {
        if (validarCampos()) {

            startSession($("input[name='user']").val(), $("input[name='clave']").val());
        }
        else {
            $('#error').remove();
            $("#loginForm").append("<h1 id='error' style = 'color:red; width:70%; font-size: 20px;'>Debe llenar todos los campos</h1>");
        }
    });

});


function validarCampos() {
    if ($('input[type=text]').val().length < 1 || $('input[type=password]').val().length < 1) {
        return false;
    }
    else {
        return true;
    }
}


function startSession(user, pss) {
    var parametros = {
        "usuario": user,
        "password": pss
    };
    $.ajax({
        data: parametros,
        url: './Ajax/Login.php',
        type: 'post',
        beforeSend: function () {
            //$("#resultado").html("Procesando, espere por favor...");
        },
        success: function (response) {
            if (response == "Error") {
                $('#error').remove();
                $("#loginForm").append("<h1 id='error' style = 'color:red; width:70%;  font-size: 20px;'>Usuario y/o clave erroneas</h1>");
            }
            else {
                if (localStorage.getItem("ultimaVisitada") == null) {
                    location.href = "Instalaciones.html";
                }
                else{
                    location.href = localStorage.getItem("ultimaVisitada");
                }
                
            }

        }
    });
}
function limpiar() {
    $('input[type="text"]').val('');
    $('input[type="number"]').val('');
    $('input[type="email"]').val('');
    $('select> option[value=0]').attr('selected', 'selected');
    $('input[name="task"]').val("insert");
    $('#desc').val('');
}

function consultarSesion() {
    var sessionIniciada = false;
    var parametros = {
        "funcion": 'consultaSession'
    };

    $.ajax({
        data: parametros,
        url: "./Ajax/UsuarioAjax.php",
        type: 'POST',
        beforeSend: function (xhr) {

        },
        success: function (response) {
            if (response != 0) {
                window.location = localStorage.getItem("ultimaVisitada");
            }
        }
    });
}