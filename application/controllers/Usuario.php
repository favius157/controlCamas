<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Persona
 *
 * @author Favius
 */
class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('usuario_model');
        $this->load->model('rol_model');
    }

    public function index() {

        $this->load->view('usuarios', compact("lista"));
    }

    function cargarUsuarios() {
        $usuarios = $this->usuario_model->getUsuarios();
        $lista = array();

        if ($usuarios != null) {
            foreach ($usuarios as $usuarios) {
                $datos["id"] = $usuarios["id_usuario"];
                $datos["nombres"] = $usuarios["nombres"];
                $datos["apellidos"] = $usuarios["apellidos"];
                $datos["establecimiento"] = $usuarios["establecimiento"];
                $datos["rol"] =($usuarios["rol"]);
                $datos["usuario"] = $usuarios["usuario"];
                $datos["estado"] = $usuarios["estado"];

                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function nuevoUsuario() {
        echo $this->usuario_model->nuevoUsuario($_POST["usuario"], sha1(md5($_POST["contrasena"])), $_POST["persona"], $_POST["rol"]);
    }


    function getUsuario(){
        $usuario=$this->usuario_model->getUsuario($_POST["idusuario"]);
        $lista = array();
        if ($usuario != null) {
            foreach ($usuario as $usuarios) {
                $datos["id"] = $usuarios["id_usuario"];
                $datos["usuario"] = $usuarios["usuario"];
                $datos["idrol"] = $usuarios["id_rol"];

                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }

    }
}

?>