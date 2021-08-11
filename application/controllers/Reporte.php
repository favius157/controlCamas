<?php

defined('BASEPATH') or exit('No direct script access allowed');
session_start();

/**
 * Description of Reporte
 *
 * @author Favius
 */
class Reporte extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('cama_model');
        $this->load->library('pdf');
        if (!isset($_SESSION["usuario"])) {
            redirect("login", "refresh");
        }
    }

    public function index() {

        //$this->load->view('camas');
    }

    public function cargarDashBoard() {
        $estadoCamas = $this->cama_model->estadoCamas();
        $lista = array();
        if ($estadoCamas != null) {
            $datos["camasLibres"] = $estadoCamas[0]["camasLibres"];
            $datos["camasOcupadas"] = $estadoCamas[0]["camasOcupadas"];
        } else {
            $datos["camasLibres"] = 0;
            $datos["camasOcupadas"] = 0;
        }
        $asignacionesHoy = $this->cama_model->asignacionesFechaActual();
        if ($asignacionesHoy != null) {
            $listaAsignaciones = array();
            foreach ($asignacionesHoy as $asignacionesHoy) {
                $datoAsignacion["cie10"] = $asignacionesHoy["cie10"];
                switch ($asignacionesHoy["tipoingreso"]) {
                    case 2:
                        $datoAsignacion["tipoIngreso"] = "Sala común";
                        break;
                    case 3:
                        $datoAsignacion["tipoIngreso"] = "Sala aislada";
                        break;
                    case 4:
                        $datoAsignacion["tipoIngreso"] = "Paciente de riesgo";
                        break;
                }

                $detalleCama = $this->cama_model->cargarDetalleCama($asignacionesHoy["id_cama"]);
                $datoAsignacion["cama"] = $detalleCama[0]["numero_cama"];
                $datoAsignacion["piso"] = $detalleCama[0]["numero_piso"];
                $datoAsignacion["bloque"] = $detalleCama[0]["nombre_bloque"];
                $listaAsignaciones[] = $datoAsignacion;
            }
            $datos["asignacionesHoy"] = json_encode($listaAsignaciones);
        } else {
            $datos["asignacionesHoy"] = "null";
        }
        /* Pacientes criticos > 14 dias */
        $pacientesCriticos = $this->cama_model->pacientesCriticos();
        if ($pacientesCriticos != null) {
            $listaPacientesCriticos = array();
            foreach ($pacientesCriticos as $pacientesCriticos) {
                $fechaActual = date('Y-m-d');
                $datetime1 = date_create($pacientesCriticos["fecha_asignacion"]);
                $datetime2 = date_create($fechaActual);
                $contador = date_diff($datetime1, $datetime2);
                $differenceFormat = '%a';
                $datosPacientesCriticos["diasInternados"] = $contador->format($differenceFormat);
                $datosPacientesCriticos["matricula"] = $pacientesCriticos["matricula"];
                $datosPacientesCriticos["cama"] = $this->cama_model->cargarDetalleCama($pacientesCriticos["id_cama"])[0]["numero_cama"];
                $datosPacientesCriticos["cie10"] = $pacientesCriticos["cie10"];
                $datosPacientesCriticos["fechaInternacion"] = $pacientesCriticos["fecha_asignacion"];
                $listaPacientesCriticos[] = $datosPacientesCriticos;
            }
            $datos["pacientesCriticos"] = json_encode($listaPacientesCriticos);
        } else {
            $datos["pacientesCriticos"] = "null";
        }
        /* Pacientes aislados */
        $pacientesAislados = $this->cama_model->cargarAsignacionesByTipoIngreso(3);
        if ($pacientesAislados != null) {
            $listaPacientesAislados = array();
            foreach ($pacientesAislados as $pacientesAislados) {
                $fechaActual = date('Y-m-d');
                $datetime1 = date_create($pacientesAislados["fecha_asignacion"]);
                $datetime2 = date_create($fechaActual);
                $contador = date_diff($datetime1, $datetime2);
                $differenceFormat = '%a';
                $datosPacientesAislados["diasInternados"] = $contador->format($differenceFormat);
                $datosPacientesAislados["matricula"] = $pacientesAislados["matricula"];
                $datosPacientesAislados["cama"] = $this->cama_model->cargarDetalleCama($pacientesAislados["id_cama"])[0]["numero_cama"];
                $datosPacientesAislados["cie10"] = $pacientesAislados["cie10"];
                $datosPacientesAislados["fechaInternacion"] = $pacientesAislados["fecha_asignacion"];
                $listaPacientesAislados[] = $datosPacientesAislados;
            }
            $datos["pacientesAislados"] = json_encode($listaPacientesAislados);
        } else {
            $datos["pacientesAislados"] = "null";
        }
        /* Pacientes riesgosos */
        $pacientesRiesgosos = $this->cama_model->cargarAsignacionesByTipoIngreso(4);
        if ($pacientesRiesgosos != null) {
            $listaPacientesRiesgosos = array();
            foreach ($pacientesRiesgosos as $pacientesRiesgosos) {
                $fechaActual = date('Y-m-d');
                $datetime1 = date_create($pacientesRiesgosos["fecha_asignacion"]);
                $datetime2 = date_create($fechaActual);
                $contador = date_diff($datetime1, $datetime2);
                $differenceFormat = '%a';
                $datosPacientesRiesgosos["diasInternados"] = $contador->format($differenceFormat);
                $datosPacientesRiesgosos["matricula"] = $pacientesRiesgosos["matricula"];
                $datosPacientesRiesgosos["cama"] = $this->cama_model->cargarDetalleCama($pacientesRiesgosos["id_cama"])[0]["numero_cama"];
                $datosPacientesRiesgosos["cie10"] = $pacientesRiesgosos["cie10"];
                $datosPacientesRiesgosos["fechaInternacion"] = $pacientesRiesgosos["fecha_asignacion"];
                $listaPacientesRiesgosos[] = $datosPacientesRiesgosos;
            }
            $datos["pacientesRiesgosos"] = json_encode($listaPacientesRiesgosos);
        } else {
            $datos["pacientesRiesgosos"] = "null";
        }
        $lista[] = $datos;
        echo json_encode($lista);
    }

    function ultimosRegistros() {
        $fechaActual = date("Y-m-d");
        $actividades = $this->cama_model->actividadDelDia($fechaActual);
        $lista = array();
        if ($actividades != null) {
            foreach ($actividades as $actividades) {
                $datos["fechaAsignacion"] = $actividades["fecha_asignacion"];
                $datos["fechaAlta"] = $actividades["fecha_alta"];
                $datos["tipoIngreso"] = $actividades["tipoingreso"];
                $detalleCama = $this->cama_model->cargarDetalleCama($actividades["id_cama"]);
                $datos["cama"] = $detalleCama[0]["numero_cama"];
                $datos["piso"] = $detalleCama[0]["numero_piso"];
                $datos["bloque"] = $detalleCama[0]["nombre_bloque"];
                $datos["estado"] = $actividades["estado"];
                $lista[] = $datos;
            }
            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function generarReporteDiario() {
        $internaciones = $this->cama_model->cargarInternacionesByPiso($_POST["idPiso"], $_POST["fecha"]);
        $altas = $this->cama_model->cargarAltasByPiso($_POST["idPiso"], $_POST["fecha"]);
        $lista = array();
        /* Internaciones */
        if ($internaciones != null) {
            $listaInternaciones = array();
            foreach ($internaciones as $internaciones) {
                $datosInternaciones["matricula"] = $internaciones["matricula"];
                $datosInternaciones["nombres"] = $internaciones["nombres"];
                $datosInternaciones["fechaNacimiento"] = $internaciones["fechaNacimiento"];
                $datosInternaciones["sexo"] = $internaciones["sexo"];
                $datosInternaciones["sala"] = $internaciones["sala"];
                $datosInternaciones["cama"] = $internaciones["cama"];
                $datosInternaciones["diagnostico"] = $internaciones["diagnostico"];
                $listaInternaciones[] = $datosInternaciones;
            }
            $datos["internaciones"] = json_encode($listaInternaciones);
        } else {
            $datos["internaciones"] = "null";
        }
        /* Altas */
        if ($altas != null) {
            $listaAltas = array();
            foreach ($altas as $altas) {
                $datosAltas["matricula"] = $altas["matricula"];
                $datosAltas["nombres"] = $altas["nombres"];
                $datosAltas["fechaNacimiento"] = $altas["fechaNacimiento"];
                $datosAltas["sexo"] = $altas["sexo"];
                $datosAltas["sala"] = $altas["sala"];
                $datosAltas["cama"] = $altas["cama"];
                $datosAltas["tipoAlta"] = $altas["tipoAlta"];
                $datosAltas["diagnostico"] = $altas["diagnostico"];
                $datosAltas["fechaIngreso"] = $altas["fechaAsignacion"];
                $listaAltas[] = $datosAltas;
            }
            $datos["altas"] = json_encode($listaAltas);
        } else {
            $datos["altas"] = "null";
        }
        $lista[] = $datos;
        echo json_encode($lista);
    }

    function generarPDF() {

        $html = '<html>
    <head>
        <style>
            /** 
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Definir las reglas del encabezado **/
            header {
                --position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;

                /** Estilos extra personales **/
                text-align: center;
                line-height: 1cm;
            }

            /** Definir las reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 2cm; 
                right: 2cm;
                height: 2.5cm;

                /** Estilos extra personales **/
                text-align: center;
                line-height: 0.5cm;
            }
            table {
                            border-collapse: collapse;
                            width: 100%;
                        }
 
                        table,
                        th,
                        td {
                            border: 1px solid black;
                            text-align: center;
                        }
 
                        th,
                        td {
                        padding: 2px;
                        }
        </style>
    </head>
    <body>
        <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
        <header>
        <img src="./assets/img/cns.png" width = "100" height = "100" style = "float: left;"/>
            <h3>PARTE DE DIARIO DE <BR/> MOVIMIENTO DE PACIENTES</h3>
        </header>';
        $fecha = $this->uri->segment(3);
        $piso = $this->uri->segment(4);

        $internaciones = $this->cama_model->cargarInternacionesByPiso($piso, $fecha);
        $altas = $this->cama_model->cargarAltasByPiso($piso, $fecha);
        $estadoCamas = $this->cama_model->estadoCamas();
        $firstDate = new DateTime(date("Y-m-d"));
        $edad = 0;
        $sexo = "";

        if ($internaciones != null) {
            $html .= '
                    
                    INGRESOS
                    <table class="table-bordered" id="tblParteDiarioIngresos" style = "font-size: 8px; margin-top: 50px;">
                                    <thead>
                                        <tr>
                                            <th style = "width: 10%;">Matrícula</th>
                                            <th style = "width: 25%;">Nombre completo</th>
                                            <th style = "width: 2%;">Edad</th>
                                            <th style = "width: 2%;">Sexo</th>
                                            <th style = "width: 24%;">Transferido de</th>
                                            <th style = "width: 10%;">Sala</th>
                                            <th style = "width: 2%;">Cama</th>
                                            <th style = "width: 25%;">Dianóstico</th>
                                        </tr>
                                    </thead>
                                    <tbody>';


            foreach ($internaciones as $internaciones) {

                $secondDate = new DateTime($internaciones["fechaNacimiento"]);
                $edad = $firstDate->diff($secondDate);
                $sexo = ($internaciones["sexo"] == 1) ? "F" : "M";
                $html .= '<tr><td style = "border: 1px solid;">' . $internaciones["matricula"] . '</td><td style = "border: 1px solid;">' . $internaciones["nombres"] . '</td><td style = "border: 1px solid;">' . $edad->y . '</td><td style = "border: 1px solid;">' . $sexo . '</td><td style = "border: 1px solid;"></td><td>' . $internaciones["sala"] . '</td><td style = "border: 1px solid;">' . $internaciones["cama"] . '</td><td style = "border: 1px solid;">' . $internaciones["diagnostico"] . '</td></tr>';
            }
            $html .= '</tbody></table>';
        } else {
            $html .= '<table class="table-bordered" id="tblParteDiarioIngresos">
                                    <thead>
                                        <tr>
                                            <th style = "width: 10%;">Matrícula</th>
                                            <th style = "width: 25%;">Nombre completo</th>
                                            <th style = "width: 2%;">Edad</th>
                                            <th style = "width: 2%;">Sexo</th>
                                            <th style = "width: 24%;">Transferido de</th>
                                            <th style = "width: 10%;">Sala</th>
                                            <th style = "width: 2%;">Cama</th>
                                            <th style = "width: 25%;">Dianóstico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>';
        }
        
        if ($altas != null) {
            $html .= '
EGRESOS                
<table class="table-bordered" id="" style = "font-size: 8px;">
                                    <thead>
                                        <tr>
                                            <th style = "width: 10%;">Matrícula</th>
                                            <th style = "width: 25%;">Nombre completo</th>
                                            <th style = "width: 2%;">Edad</th>
                                            <th style = "width: 2%;">Sexo</th>
                                            <th style = "width: 12%;">Tipo de alta</th>
                                            <th style = "width: 12%;">Sala</th>
                                            <th style = "width: 2%;">Cama</th>
                                            <th style = "width: 10%;">Fecha de ingreso</th>
                                            <th style = "width: 25%;">Diagnóstico</th>
                                        </tr>
                                    </thead>
                                    <tbody>';


            foreach ($altas as $altas) {

                $secondDate = new DateTime($internaciones["fechaNacimiento"]);
                $edad = $firstDate->diff($secondDate);
                $sexo = ($internaciones["sexo"] == 1) ? "F" : "M";
                $html .= '<tr><td style = "border: 1px solid;">' . $altas["matricula"] . '</td><td style = "border: 1px solid;">' . $altas["nombres"] . '</td><td style = "border: 1px solid;">' . $edad->y . '</td><td style = "border: 1px solid;">' . $sexo . '</td><td style = "border: 1px solid;">' . $altas["tipoAlta"] . '</td><td>' . $altas["sala"] . '</td><td style = "border: 1px solid;">' . $altas["cama"] . '</td><td style = "border: 1px solid;">' . $altas["fechaAsignacion"] . '</td><td style = "border: 1px solid;">' . $altas["diagnostico"] . '</td></tr>';
            }
            $html .= '</tbody></table>';
        } else {
            $html .= '<table class="table-bordered" id="tblParteDiarioIngresos">
                                    <thead>
                                        <tr>
                                            <th style = "width: 10%;">Matrícula</th>
                                            <th style = "width: 25%;">Nombre completo</th>
                                            <th style = "width: 2%;">Edad</th>
                                            <th style = "width: 2%;">Sexo</th>
                                            <th style = "width: 24%;">Tipo de alta</th>
                                            <th style = "width: 10%;">Sala</th>
                                            <th style = "width: 2%;">Cama</th>
                                            <th>Fecha de ingreso</th>
                                            <th style = "width: 25%;">Diagnóstico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>';
        }
        
        $html .= '<footer><div style = "bottom: 0; float: left;">
                                    <label>Total de camas: </label>'.$estadoCamas[0]["total"].'<br/>
                                    <label>Camas ocupadas: </label>'.$estadoCamas[0]["camasOcupadas"].'<br/>
                                    <label>Camas libres: </label>'.$estadoCamas[0]["camasLibres"].'<br/>
                                </div>
                                <div style = "bottom: 0; float: right;">
                                    <label>Firma y sello de licenciada <br/> encargada del servicio </label>
                                </div></footer>

        <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
        <main>
            
        </main>
    </body>
</html>';


        $this->pdf->loadHtml($html);
        $this->pdf->render();
        $this->pdf->stream("Reporte diario de movimiento de pacientes.pdf", array("Attachment" => 0));
    }

}
