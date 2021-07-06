<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Establecimiento_model
 *
 * @author Favius
 */
class Establecimiento_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function cargarEstablecimientosActivos() {
        $query = $this->db->query("select * from establecimiento where estado = 1");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarEstablecimientoById($idEstablecimiento) {
        $query = $this->db->query("select * from establecimiento where id_establecimiento = $idEstablecimiento");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}
