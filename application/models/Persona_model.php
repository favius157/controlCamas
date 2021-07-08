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
        $ip =$this->input->ip_address();
        $query = $this->db->query("insert into persona values (null, '$nombres', '$apellidos', '$ci', '$matricula', '$telefono', $cargo, $establecimiento, '$fechaActual', '$ip', 1)");
        return $query;
    }

    public function getPersonas() {
        $query = $this->db->query("SELECT * FROM persona");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function editarPersona($id,$nombres,$apellidos,$ci,$matricula,$telefono,$cargo,$establecimiento){
         $fechaActual = date("Y-m-d H:i:s");
         $ip =$this->input->ip_address();
         $query=$this->db->query("UPDATE persona SET nombres='$nombres',apellidos='$apellidos',ci='$ci',matricula='$matricula',id_cargo=$cargo,id_establecimiento=$establecimiento WHERE id_persona=$id");
         return $query;
    }

    public function getPersona($idpersona) {
        $query = $this->db->query("SELECT * FROM persona WHERE id_persona=$idpersona");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function eliminarPersona($id){
         $fechaActual = date("Y-m-d H:i:s");
         $ip =$this->input->ip_address();
         $query=$this->db->query("UPDATE persona SET estado=0 WHERE id_persona=$id");
         return $query;
    }

}
