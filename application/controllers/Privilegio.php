<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Privilegio
 *
 * @author Favius
 */
class Privilegio extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('privilegio_model');
    }

    public function index() {

        $this->load->view('privilegios');
    }

    public function nuevoRol() {
        echo $this->privilegio_model->nuevoRol($_POST["nombreRol"]);
    }

    function nuevoPermiso() {
        $items = json_decode($_POST["permisos"]);
        $respuesta = 0;
        foreach ($items as $item) {
            $respuesta = $respuesta + $this->privilegio_model->nuevoPermiso($_POST["idRol"], $item);
        }
        echo "Se registraron " . $respuesta . " de " . count($items) . " registros";
    }

    function cargarPermisos() {
        $permisos = $this->privilegio_model->cargarPermisos();
        $lista = array();
        if ($permisos != null) {
            foreach ($permisos as $permisos) {
                $datos["id"] = $permisos["id_privilegios"];
                $datos["menu"] = $this->privilegio_model->cargarMenuById($permisos["id_menu"])[0]["menu"];
                $datos["rol"] = $this->privilegio_model->cargarRolById($permisos["id_rol"])[0]["rol"];
                $datos["idMenu"] = $permisos["id_menu"];
                $datos["idRol"] = $permisos["id_rol"];
                $datos["fechaRegistro"] = $permisos["fecha_registro"];
                $datos["ip"] = $permisos["ip_registro"];
                $datos["estado"] = $permisos["estado"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    public function cargarMenu() {
        $menus = $this->privilegio_model->cargarMenu();
        $lista = array();
        if ($menus != null) {
            foreach ($menus as $menus) {
                $permiso = $this->privilegio_model->validarRolVsMenu($_POST["idRol"], $menus["id_menu"]);
                if ($permiso == null) {
                    $datos["id"] = $menus["id_menu"];
                    $datos["menu"] = $menus["menu"];
                    $datos["url"] = $menus["url"];
                    $datos["estado"] = $menus["estado"];
                    $lista[] = $datos;
                }
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function cargarRoles() {
        $roles = $this->privilegio_model->cargarRoles();
        $lista = array();
        if ($roles != null) {
            foreach ($roles as $roles) {
                $datos["id"] = $roles["id_rol"];
                $datos["rol"] = $roles["rol"];
                $datos["estado"] = $roles["estado"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function editarPrivilegio() {
        $vaciarPermisos = $this->privilegio_model->borrarAccesoByRol($_POST["idRol"]);

        if ($vaciarPermisos == 1) {
            $items = json_decode($_POST["permisos"]);
            $respuesta = 0;
            foreach ($items as $item) {
                $respuesta = $respuesta + $this->privilegio_model->nuevoPermiso($_POST["idRol"], $item);
            }
            echo "Datos modificados con exito";
        } else {
            echo "Se produjo un problema";
        }
    }

    function cargarPermisoByRol() {
        $permisos = $this->privilegio_model->cargarPermisoByRol($_POST["idRol"]);
        $lista = array();
        if ($permisos != null) {
            foreach ($permisos as $permisos) {
                $datos["id"] = $permisos["id_privilegios"];
                $datos["idMenu"] = $permisos["id_menu"];
                $datos["idRol"] = $permisos["id_rol"];
                $datos["menu"] = $this->privilegio_model->cargarMenuById($permisos["id_menu"])[0]["menu"];
                $datos["rol"] = $this->privilegio_model->cargarRolById($permisos["id_rol"])[0]["rol"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

}
