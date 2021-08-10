<?php

defined('BASEPATH') or exit('No direct script access allowed');
session_start();

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
        if (!isset($_SESSION["usuario"])) {
            redirect("login", "refresh");
        }
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
        $privilegios = "";
        if ($roles != null) {
            foreach ($roles as $roles) {
                $privilegios = $this->privilegio_model->cargarPermisoByRol($roles["id_rol"]);
                $datos["id"] = $roles["id_rol"];
                $datos["rol"] = $roles["rol"];
                $datos["estado"] = $roles["estado"];
                @$datos["cantidadAcceso"] = count($privilegios);
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
                $datos["menu"] = $this->privilegio_model->cargarMenuById($permisos["id_menu"])[0]["menu"];
                $datos["rol"] = $this->privilegio_model->cargarRolById($permisos["id_rol"])[0]["rol"];
                $datos["idMenu"] = $permisos["id_menu"];
                $datos["idRol"] = $permisos["id_rol"];
                $datos["menu"] = $this->privilegio_model->cargarMenuById($permisos["id_menu"])[0]["menu"];
                $datos["rol"] = $this->privilegio_model->cargarRolById($permisos["id_rol"])[0]["rol"];
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

    function cargarRolById() {
        $rol = $this->privilegio_model->cargarRolById($_POST["idRol"]);
        $lista = array();
        if ($rol != null) {

            $datos["id"] = $rol[0]["id_rol"];
            $datos["rol"] = $rol[0]["rol"];
            $datos["estado"] = $rol[0]["estado"];


            $lista[] = $datos;


            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function editarRol() {
        echo $this->privilegio_model->editarRol($_POST["idRol"], $_POST["nombreRol"]);
    }

    function borrarRol() {
        echo $this->privilegio_model->borrarRol($_POST["idRol"]);
    }

    function permisosByItem() {
        $permisos = $this->privilegio_model->permisoByItem($_POST["item"], json_decode($_SESSION["usuario"])[0]->id_usuario);
        if ($permisos != null) {
            $permisos = explode(",", $permisos[0]["permisos"]);
            $lista = array();
            foreach ($permisos as $permisos) {
                $permiso = explode(":", $permisos);
                $datos["clave"] = $permiso[0];
                $datos["valor"] = $permiso[1];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function permisosByUsuario() {
        $permisos_usuario = $this->privilegio_model->permisoByUsuario($_POST["usuario"]);
        $lista = array();
        if ($permisos_usuario != null) {

            foreach ($permisos_usuario as $permisos_usuario) {
                $listaPermisos = explode(",", $permisos_usuario["permisos"]);
                $listaAux = array();
                for ($i = 0; $i < count($listaPermisos); $i++) {
                    $thePermiso = explode(":", $listaPermisos[$i]);
                    $datosPermiso["clave"] = $thePermiso[0];
                    $datosPermiso["valor"] = $thePermiso[1];
                    $listaAux[] = $datosPermiso;
                }
                $datos["usuario"] = $permisos_usuario["idUsuario"];
                $datos["idMenu"] = $permisos_usuario["idMenu"];
                $datos["menu"] = $this->privilegio_model->cargarMenuById($permisos_usuario["idMenu"])[0]["menu"];
                $datos["permisos"] = json_encode($listaAux);

                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

}
