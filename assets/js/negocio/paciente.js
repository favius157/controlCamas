$(document).ready(function () {
    //cargarUsuarios();

})
var idActual=0;

function buscarPaciente()
{
   var datos = $("input[name='MatriculaoCi']").val();
    $.ajax({
        type: 'GET',
        url: "http://172.25.0.10:8080/rfdi/index.php/welcome/obtenerPacientes/"+datos+"/"+datos,
        success: function (data,textStatus,jqXHR) {
            if(data!="null"|| data==""){
               if (data.length > 0) {
                   $("input[name='nombres']").val(data[0].nombres);
                   $("input[name='matricula']").val(data[0].nro_registro);
               }else{ alert("No existe el paciente");}
            }
        }
     });
 }