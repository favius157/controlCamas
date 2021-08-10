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

}
