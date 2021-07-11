<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Persona_model
 *
 * @author Favius
 */
class Rol_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function cargarRolById($idrol) {
        $query = $this->db->query("SELECT * FROM rol WHERE id_rol=$idrol");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    public function getRoles(){
         $query = $this->db->query("SELECT * FROM rol");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
}

?>