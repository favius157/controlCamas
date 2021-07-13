<?php

defined('BASEPATH') or exit('No direct script access allowed');
session_start();

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("usuario_model");
        $this->load->model("privilegio_model");
    }

    public function index() {

        $data = array(
            'title' => 'Login'
        );

        if (isset($_POST["password"])) {
            $result = $this->usuario_model->login($_POST["username"], sha1(md5($_POST["password"])));
            $data = array(
                'title' => 'Login'
            );
            if ($result != null) {
                $_SESSION["usuario"] = json_encode($result);
//                $usuarioActual = json_decode($_SESSION["usuario"]);
//                $usuarioActual = $usuarioActual[0]->idTipoUsuario;
                //$this->crearMenu();
                redirect("principal", "refresh");
            } else {

                $data = array(
                    'title' => 'Clave incorrecta'
                );
            }
        }


        $this->load->view('login', $data);
    }

    function devolverMenu() {
        $idRol = json_decode($_SESSION["usuario"])[0]->id_rol;
        echo json_encode($this->privilegio_model->cargarPermisoByRol2($idRol));
    }

    function logOut() {
        session_destroy();
        session_unset();
        redirect("login", "refresh");
    }

}
