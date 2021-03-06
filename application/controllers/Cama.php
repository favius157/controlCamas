<?php

defined('BASEPATH') or exit('No direct script access allowed');
session_start();

/**
 * Description of Cama
 *
 * @author Favius
 */
class Cama extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('cama_model');
        if (!isset($_SESSION["usuario"])) {
            redirect("login", "refresh");
        }
    }

    public function index() {

        $this->load->view('camas');
    }

    function cargarPisos() {
        $camas = $this->cama_model->cargarPisos();
        $lista = array();
        if ($camas != null) {
            foreach ($camas as $camas) {
                $datos["id"] = $camas["id_piso"];
                $datos["numeroPiso"] = $camas["numero_piso"];
                //$datos["cantidad"] = $camas["cantidadCamas"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function cargarSalas() {
        $salas = $this->cama_model->cargarSalas();
        $lista = array();
        if ($salas != null) {
            foreach ($salas as $salas) {
                $datos["id"] = $salas["id_sala"];
                $datos["sala"] = $salas["sala"];
                $datos["estado"] = $salas["estado"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function nuevaCama() {
        $resultado = $this->cama_model->nuevaCama($_POST["numeroCama"], $_POST["bloque"], $_POST["piso"], $_POST["sector"], $_POST["sala"]);

        if ($resultado == 1) {
            echo "Registro exitoso";
        } else if ($resultado == 0) {
            echo "Se produjo un error al guardar los datos";
        } else {
            echo "La cama a registrar ya existe en el piso seleccionado";
        }
    }

    function nuevoBloque() {
        echo $this->cama_model->nuevoBloque($_POST["nombreBloque"]);
    }

    function nuevaSala() {
        echo $this->cama_model->nuevaSala($_POST["nombreSala"]);
    }

    function cargarBloques() {
        $bloques = $this->cama_model->cargarBloques();
        $lista = array();
        if ($bloques != null) {
            foreach ($bloques as $bloques) {
                $datos["id"] = $bloques["id_bloque"];
                $datos["nombreBloque"] = $bloques["nombre_bloque"];
                $datos["estado"] = $bloques["estado"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function cargarCamasByPiso() {
        $camas = $this->cama_model->cargarCamasByPiso($_POST["idPiso"]);
        $lista = array();
        if ($camas != null) {
            foreach ($camas as $camas) {
                $datos["id"] = $camas["id_cama"];
                $datos["numeroCama"] = $camas["numero_cama"];
                $datos["idPiso"] = $camas["id_piso"];
                $datos["piso"] = $camas["numero_piso"];
                $datos["idBloque"] = $camas["id_bloque"];
                $datos["bloque"] = $camas["nombre_bloque"];
                $datos["idSala"] = $camas["id_sala"];
                $datos["sala"] = $camas["sala"];
                $datos["sector"] = $camas["sector"];
                $datos["estado"] = $camas["estado"];
                /* Datos de asignacion */
                $asignacionByCama = $this->cama_model->cargarAsignacionByCama($camas["id_cama"]);
                $datos["asignacion"] = ($asignacionByCama != null) ? json_encode($asignacionByCama) : "null";
                if ($asignacionByCama != null && $asignacionByCama[0]["estado"] == 1) {
                    $datos["diasInternacion"] = $this->getDiferenciaDias($asignacionByCama[0]["fecha_asignacion"], date("Y-m-d H:i:s"));
                } else {
                    $datos["diasInternacion"] = -1;
                }

                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function getDiferenciaDias($fecha1, $fecha2) {
        $datetime1 = new DateTime($fecha1);
        $datetime2 = new DateTime($fecha2);
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%d');
        
    }

    function cargarDetalleByBloque() {
        $detalleCamas = $this->cama_model->cargarDetalleByBloque($_POST["idPiso"], $_POST["bloque"]);
        $lista = array();
        if ($detalleCamas != null) {
            foreach ($detalleCamas as $camas) {
                $datos["numeroCama"] = $camas["numeroCama"];
                $datos["estado"] = $camas["estado"];
                $datos["cantidad"] = $camas["cantidad"];

                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function cargarCamas() {
        $camas = $this->cama_model->cargarCamas();
        $lista = array();
        if ($camas != null) {
            foreach ($camas as $camas) {
                $datos["id"] = $camas["id_cama"];
                $datos["numeroCama"] = $camas["numero_cama"];
                $datos["idPiso"] = $camas["id_piso"];
                $datos["piso"] = $this->cama_model->cargarPisoById($camas["id_piso"])[0]["numero_piso"];
                $datos["idBloque"] = $camas["id_bloque"];
                $datos["bloque"] = $this->cama_model->cargarBloqueById($camas["id_bloque"])[0]["nombre_bloque"];
                $datos["idSala"] = $camas["id_sala"];
                $datos["sala"] = $this->cama_model->cargarSalaById($camas["id_sala"])[0]["sala"];
                $datos["sector"] = $camas["sector"];
                $datos["estado"] = $camas["estado"];

                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function cambiarEstadoCama() {
        echo $this->cama_model->cambiarEstadoCama($_POST["idCama"], $_POST["estado"]);
    }

    function asignarCama() {
        $respuesta = $this->cama_model->validarAlta($_POST['idhistorial']);
        if ($respuesta == null) {
            echo $this->cama_model->asignarCama($_POST['matricula'], utf8_decode($_POST['nombres']), $_POST['codcns'], $_POST['fecnacimiento'], $_POST['edad'], $_POST['sexo'], utf8_decode($_POST['diagnostico']), $_POST['cie10'],utf8_decode($_POST['cie10literal']), json_encode($_POST['equipamiento']),utf8_decode($_POST['empresa']), $_POST['patronal'], utf8_decode($_POST['medico']), $_POST['especialidad'], utf8_decode($_POST['diagnosticoenfermeria']), $_POST['tipoingreso'], $_POST['idhistorial'], $_POST['idCama']);
        } else {
            echo json_encode($respuesta);
        }
    }

     function pacienteTransferencia() {
        $idUsuario = json_decode($_SESSION["usuario"])[0]->id_usuario;
        $transferencia=11;
        $this->cama_model->liberarCama($_POST["idCama"], $transferencia, $idUsuario);
        $estado=1;
        $this->cama_model->cambiarEstadoCama($_POST["idCama"], $estado);
        
        echo $this->cama_model->pacienteTransferencia($_POST['matricula'], utf8_decode($_POST['nombres']), $_POST['codcns'], $_POST['fecnacimiento'], $_POST['edad'], $_POST['sexo'], utf8_decode($_POST['diagnostico']), $_POST['cie10'],utf8_decode($_POST['cie10literal']), json_encode($_POST['equipamiento']),utf8_decode($_POST['empresa']), $_POST['patronal'], utf8_decode($_POST['medico']), $_POST['especialidad'], utf8_decode($_POST['diagnosticoenfermeria']), $_POST['tipoingreso'], $_POST['idhistorial'], $_POST['cama'],$idUsuario);
    }

    function verPacienteByCama() {

        $verPaciente = $this->cama_model->verPacienteByCama($_POST['idcama']);
        $lista = array();
        if ($verPaciente != null) {
            foreach ($verPaciente as $listaPaciente) {
                $datos['idhistorial'] = $listaPaciente['id_historial'];
                $datos['nombres'] = $listaPaciente['nombres'];
                $datos['matricula'] = $listaPaciente['matricula'];
                $datos['codcns'] = $listaPaciente['codcns'];
                $datos['fecnacimiento'] = $listaPaciente['fec_nacimiento'];
                $datos['edad'] = $listaPaciente['edad'];
                $datos['sexo'] = $listaPaciente['sexo'];
                $datos['patronal'] = $listaPaciente['patronal'];
                $datos['empresa'] = $listaPaciente['empresa'];
                $datos['diagnostico'] = $listaPaciente['diagnostico'];
                $datos['cie10'] = $listaPaciente['cie10'];
                $datos['cie10literal'] = $listaPaciente['cie10_literal'];
                $datos['medico'] = $listaPaciente['medico'];
                $datos['especialidad'] = $listaPaciente['especialidad'];
                $datos['fecha'] = $listaPaciente['fecha_asignacion'];
                $datos['idpiso'] = $listaPaciente['id_piso'];
                $datos['usuario'] = $listaPaciente['usuario'];
                $lista[] = $datos;
            }
            echo json_encode($lista);
        } else {
            echo null;
        }
    }

    function liberarCama() {
        $idUsuario = json_decode($_SESSION["usuario"])[0]->id_usuario;
        echo $this->cama_model->liberarCama($_POST["idCama"], $_POST["tipoAlta"], $idUsuario);
    }

    function cargarTipoAltas() {
        $tipos = $this->cama_model->cargarTiposAlta();
        $lista = array();
        if ($tipos != null) {
            foreach ($tipos as $tipos) {
                $datos["id"] = $tipos["id_tipoalta"];
                $datos["tipoAlta"] = $tipos["tipoalta"];
                $datos["estado"] = $tipos["estado"];
                $lista[] = $datos;
            }
            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function listarCamas(){ 
        $camaid=$this->cama_model->listarCamas($_POST['idpiso']);
            if($camaid!=null){
                $lista=array();
                    foreach ($camaid as $listacama) {
                        $datos["idcama"]=$listacama["id_cama"];
                        $datos["numerocama"]=$listacama["numero_cama"];
                        $lista[]=$datos;
                    }
                    echo json_encode($lista);
            }else{
                    echo "null";
            }
    }

}
