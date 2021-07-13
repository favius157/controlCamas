<?php

defined('BASEPATH') or exit('No direct script access allowed');
session_start();
/**
 * Description of Establecimiento
 *
 * @author Favius
 */
class Establecimiento extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('establecimiento_model');
        if(!isset($_SESSION["usuario"])){
            redirect("login", "refresh");
        }
    }
    

    function cargarEstablecimientos() {
        $establecimientos = $this->establecimiento_model->cargarEstablecimientosActivos();

        if ($establecimientos != null) {
            $lista = array();
            foreach ($establecimientos as $establecimientos) {
                $datos["id"] = $establecimientos["id_establecimiento"];
                $datos["establecimiento"] = $establecimientos["establecimiento"];
                $datos["ubicacion"] = $establecimientos["ubicacion"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

}
