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
                $datos["cantidad"] = $camas["cantidadCamas"];
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

    function asignarCama(){
        echo $this->cama_model->asignarCama($_POST['matricula'],$_POST['nombres'],$_POST['edad'],$_POST['sexo'],$_POST['diagnostico'],$_POST['cie10'],$_POST['medico'],$_POST['especialidad'],$_POST['idhistorial'],$_POST['idcama']);
    }

    function verPacienteByCama(){
        
        $verPaciente= $this->cama_model->verPacienteByCama($_POST['idcama']);
        $lista=array();
        if($verPaciente!=null){
            foreach ($verPaciente as $listaPaciente) {
                $datos['nombres']=$listaPaciente['nombres'];
                $datos['matricula']=$listaPaciente['matricula'];
                $datos['cie10']=$listaPaciente['cie10'];
                $datos['edad']=$listaPaciente['edad'];
                $datos['sexo']=$listaPaciente['sexo'];
                $datos['diagnostico']=$listaPaciente['diagnostico'];
                $datos['medico']=$listaPaciente['medico'];
                $datos['especialidad']=$listaPaciente['especialidad'];
                $datos['fecha']=$listaPaciente['fecha_asignacion'];
                $datos['usuario']=$listaPaciente['usuario'];
                $lista[]=$datos;
            }
            echo json_encode($lista);
        }else{
                echo null;
        }
    }   

}
