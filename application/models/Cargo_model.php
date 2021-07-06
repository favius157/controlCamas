<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Cargo_model
 *
 * @author Favius
 */
class Cargo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function cargarCargosActivos() {
        $query = $this->db->query("select * from cargo");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
    
    function cargarCargoById($idCargo) {
        $query = $this->db->query("select * from cargo where id_cargo = $idCargo");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}
