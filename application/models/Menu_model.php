<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Menu_model
 *
 * @author Favius
 */
class Menu_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function nuevoGrupo($nombreGrupo) {
        return $this->db->query("insert into grupo values (null, '$nombreGrupo', 1)");
    }
    
    function nuevoItem($nombreItem, $idGrupo, $url) {
        return $this->db->query("insert into menu values (null, '$nombreItem', '$url', $idGrupo, 1)");
    }
    
    function cargarMenu() {
        $query = $this->db->query("SELECT * from menu");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
    
    
    function editarItem($idMenu, $nombreItem, $idGrupo, $url) {
        return $this->db->query("update menu set menu = '$nombreItem', url = '$url', id_grupo = $idGrupo where id_menu = $idMenu");
    }
    
    function borrarItem($idMenu) {
        return $this->db->query("update menu set estado = 0 where id_menu = $idMenu");
    }

    function cargarGrupoById($idGrupo) {
        $query = $this->db->query("select * from grupo where id_grupo = $idGrupo");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarGrupos() {
        $query = $this->db->query("SELECT g.id_grupo as id_grupo, g.grupo as grupo, COUNT(m.id_menu) as cantidadItems, g.estado as estado FROM grupo g LEFT JOIN menu m ON g.id_grupo = m.id_grupo GROUP by g.id_grupo");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarMenuByGrupo($idGrupo) {
        $query = $this->db->query("SELECT * from menu where id_grupo = $idGrupo");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
    
    function cargarMenuById($idMenu) {
        $query = $this->db->query("SELECT * from menu where id_menu = $idMenu");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}
