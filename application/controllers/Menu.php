<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Menu
 *
 * @author Favius
 */
class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('privilegio_model');
        $this->load->model('menu_model');
    }

    public function index() {

        $this->load->view('menus');
    }

    function nuevoGrupo() {
        echo $this->menu_model->nuevoGrupo($_POST["nombreGrupo"]);
    }

    function nuevoItem() {
        echo $this->menu_model->nuevoItem($_POST["nombreMenu"], $_POST["idGrupo"], $_POST["ruta"]);
    }

    function editarItem() {
        echo $this->menu_model->editarItem($_POST["idMenu"], $_POST["nombreMenu"], $_POST["idGrupo"], $_POST["ruta"]);
    }
    
    function borrarItem() {
        echo $this->menu_model->borrarItem($_POST["idMenu"]);
    }

    function cargarMenuById() {
        $menus = $this->privilegio_model->cargarMenuById($_POST["idMenu"]);
        $lista = array();
        if ($menus != null) {
            $datos["id"] = $menus[0]["id_menu"];
            $datos["menu"] = $menus[0]["menu"];
            $datos["url"] = $menus[0]["url"];
            $datos["grupo"] = $this->menu_model->cargarGrupoById($menus[0]["id_grupo"])[0]["grupo"];
            $datos["idGrupo"] = $menus[0]["id_grupo"];
            $datos["estado"] = $menus[0]["estado"];
            $lista[] = $datos;

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function cargarGrupos() {
        $grupos = $this->menu_model->cargarGrupos();
        $lista = array();
        if ($grupos != null) {
            foreach ($grupos as $grupos) {
                $datos["id"] = $grupos["id_grupo"];
                $datos["grupo"] = $grupos["grupo"];
                $datos["cantidad"] = $grupos["cantidadItems"];
                $datos["estado"] = $grupos["estado"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function cargarItemsByGrupo() {
        $menus = $this->menu_model->cargarMenuByGrupo($_POST["idGrupo"]);
        $lista = array();
        if ($menus != null) {
            foreach ($menus as $menus) {
                $datos["id"] = $menus["id_menu"];
                $datos["menu"] = $menus["menu"];
                $datos["url"] = $menus["url"];
                $datos["grupo"] = $this->menu_model->cargarGrupoById($menus["id_grupo"])[0]["grupo"];
                $datos["idGrupo"] = $menus["id_grupo"];
                $datos["estado"] = $menus["estado"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

    function cargarItems() {
        $menus = $this->menu_model->cargarMenu();
        $lista = array();
        if ($menus != null) {
            foreach ($menus as $menus) {
                $datos["id"] = $menus["id_menu"];
                $datos["menu"] = $menus["menu"];
                $datos["url"] = $menus["url"];
                $datos["grupo"] = $this->menu_model->cargarGrupoById($menus["id_grupo"])[0]["grupo"];
                $datos["idGrupo"] = $menus["id_grupo"];
                $datos["estado"] = $menus["estado"];
                $lista[] = $datos;
            }

            echo json_encode($lista);
        } else {
            echo "null";
        }
    }

}
