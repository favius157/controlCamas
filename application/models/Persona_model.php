<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Persona_model
 *
 * @author Favius
 */
class Persona_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function nuevaPersona($nombres, $apellidos, $ci, $matricula, $telefono, $cargo, $establecimiento) {
        $fechaActual = date("Y-m-d H:i:s");
        //$ip = get_client_ip();
        $query = $this->db->query("insert into persona values (null, '$nombres', '$apellidos', '$ci', '$matricula', '$telefono', $cargo, $establecimiento, '$fechaActual', '', 1)");
        return $query;
    }

    public function getPersonas() {
        $query = $this->db->query("select * from persona");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}
