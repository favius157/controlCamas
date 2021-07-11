<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Cama_model
 *
 * @author Favius
 */
class Cama_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function cargarPisos() {
        $query = $this->db->query("SELECT p.id_piso as id_piso, p.numero_piso as numero_piso, COUNT(c.id_cama) as cantidadCamas FROM cama c, piso p WHERE p.id_piso = c.id_piso GROUP by p.id_piso");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarPisoById($idPiso) {
        $query = $this->db->query("SELECT * FROM piso WHERE id_piso = $idPiso");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarCamas() {
        $query = $this->db->query("SELECT * FROM cama");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarCamasByPiso($idPiso) {
        $query = $this->db->query("SELECT * FROM cama WHERE id_piso = $idPiso");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarBloqueById($idBloque) {
        $query = $this->db->query("SELECT * FROM bloque WHERE id_bloque = $idBloque");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}
