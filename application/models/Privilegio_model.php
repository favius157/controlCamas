<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Persona_model
 *
 * @author Favius
 */
class Privilegio_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function nuevoRol($nombreRol) {
        $query = $this->db->query("insert into rol values (null, '$nombreRol', 1)");
        return $query;
    }

    function nuevoPermiso($idRol, $idMenu) {
        $fechaActual = date("Y-m-d H:i:s");
        $query = $this->db->query("insert into privilegios values (null, $idMenu, $idRol, '$fechaActual', '', 1)");
        return $query;
    }

    public function cargarPermisos() {
        $query = $this->db->query("select * from privilegios");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    public function cargarRolById($idRol) {
        $query = $this->db->query("select * from rol where id_rol = $idRol");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    public function cargarMenuById($idMenu) {
        $query = $this->db->query("select * from menu where id_menu = $idMenu");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarMenu() {
        $query = $this->db->query("SELECT * from menu where estado = 1");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function validarRolVsMenu($idRol, $idMenu) {
        $query = $this->db->query("SELECT * from privilegios where id_rol = $idRol and id_menu = $idMenu");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarRoles() {
        $query = $this->db->query("select * from rol");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarPermisoByRol($idRol) {
        $query = $this->db->query("select * from privilegios where id_rol = $idRol");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
    
    function cargarPermisoByRol2($idRol) {
        $query = $this->db->query("SELECT g.grupo as grupo, m.menu as menu, m.url as url FROM menu m, rol r, privilegios p, grupo g WHERE m.id_grupo = g.id_grupo and p.id_menu = m.id_menu and p.id_rol = r.id_rol and r.id_rol = $idRol ORDER by g.grupo");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function borrarAccesoByRol($idRol) {
        return $this->db->query("delete from privilegios where id_rol = $idRol");
    }
    
    function editarRol($idRol, $rol) {
        return $this->db->query("update rol set rol = '$rol' where id_rol = $idRol");
    }
    
    function borrarRol($idRol) {
        return $this->db->query("update rol set estado = 0 where id_rol = $idRol");
    }

}
