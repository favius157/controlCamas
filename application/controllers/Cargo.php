<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Cargo
 *
 * @author Favius
 */
class Cargo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('cargo_model');
    }

    function cargarCargos() {
        $cargos = $this->cargo_model->cargarCargosActivos();

        if ($cargos != null) {
            $lista = array();
            foreach ($cargos as $cargos) {
                $datos["id"] = $cargos["id_cargo"];
                $datos["cargo"] = $cargos["cargo"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

}
