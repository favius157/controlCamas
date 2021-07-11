<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Rol
 *
 * @author Favius
 */
class Rol extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('privilegio_model');
        $this->load->model('usuario_model');
        $this->load->model('rol_model');
    }

    public function index() {

        $this->load->view('roles');
    }

     public function cargarRoles(){
        $roles = $this->rol_model->getRoles();
        $lista = array();

        if ($roles != null) {
            foreach ($roles as $roles) {
                $datos["id"] = $roles["id_rol"];
                $datos["rol"] = $roles["rol"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

}
