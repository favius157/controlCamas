<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Persona
 *
 * @author Favius
 */
class Persona extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('persona_model');
        $this->load->model('cargo_model');
        $this->load->model('establecimiento_model');
    }

    public function index() {

        $this->load->view('personas', compact("lista"));
    }

    function nuevaPersona() {
        echo $this->persona_model->nuevaPersona($_POST["nombres"], $_POST["apellidos"], $_POST["ci"], $_POST["matricula"], $_POST["telefono"], $_POST["cargo"], $_POST["establecimiento"]);
    }

    function cargarPersonas() {
        $personas = $this->persona_model->getPersonas();
        $lista = array();

        if ($personas != null) {
            foreach ($personas as $personas) {
                $datos["id"] = $personas["id_persona"];
                $datos["nombres"] = $personas["nombres"];
                $datos["apellidos"] = $personas["apellidos"];
                $datos["ci"] = $personas["ci"];
                $datos["matricula"] = $personas["matricula"];
                $datos["telefono"] = $personas["telefono"];
                $datos["cargo"] = $this->cargo_model->cargarCargoById($personas["id_cargo"])[0]["cargo"];
                $datos["establecimiento"] = $this->establecimiento_model->cargarEstablecimientoById($personas["id_establecimiento"])[0]["centro"];
                $datos["fechaRegistro"] = $personas["fecha_registro"];
                $datos["estado"] = $personas["estado"];

                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

}

?>