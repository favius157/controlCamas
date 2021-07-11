<?php

defined('BASEPATH') or exit('No direct script access allowed');

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
                $datos["sector"] = $camas["sector"];
                $datos["estado"] = $camas["estado"];

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
                $datos["sector"] = $camas["sector"];
                $datos["estado"] = $camas["estado"];

                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

}
