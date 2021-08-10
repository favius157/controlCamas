<?php

defined('BASEPATH') or exit('No direct script access allowed');
session_start();

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
        $this->load->model('privilegio_model');
        $this->load->model('rol_model');
        if (!isset($_SESSION["usuario"])) {
            redirect("login", "refresh");
        }
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
                $datos["rol"] = ($usuarios["rol"]);
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
        $usuarioInsertado = $this->usuario_model->nuevoUsuario($_POST["usuario"], sha1(md5($_POST["contrasena"])), $_POST["persona"], $_POST["rol"]);
        $items = $this->privilegio_model->cargarPermisoByRol($_POST["rol"]);
        foreach ($items as $items) {
            $this->privilegio_model->asignarPermisos($usuarioInsertado, $items["id_menu"]);
        }
        echo 1;
    }

    function getUsuario() {
        $usuario = $this->usuario_model->getUsuario($_POST["idusuario"]);
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

    function editarRol() {
        $rolAnterior = json_decode($_SESSION["usuario"])[0]->id_rol;
        $editarRol = $this->usuario_model->editarRol($_POST["id"], $_POST["rol"]);
        if ($editarRol == 1) {
            $borrarPermisos = $this->privilegio_model->borrarPermisosByUsuario(json_decode($_SESSION["usuario"])[0]->id_usuario);
            if ($borrarPermisos == 1) {

                $items = $this->privilegio_model->cargarPermisoByRol($_POST["rol"]);
                foreach ($items as $items) {
                    $this->privilegio_model->asignarPermisos(json_decode($_SESSION["usuario"])[0]->id_usuario, $items["id_menu"]);
                }
            }
        }
        echo 1;
    }

    function editarContrasena() {
        echo $this->usuario_model->editarContrasena($_POST["id"], sha1(md5($_POST["contrasena"])));
    }

    function eliminarUsuario() {
        $this->privilegio_model->borrarPermisosByUsuario(json_decode($_POST["id"]));
        echo $this->usuario_model->eliminarUsuario($_POST["id"]);
    }

}

?>