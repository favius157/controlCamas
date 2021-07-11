<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Persona_model
 *
 * @author Favius
 */
class Usuario_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


    function validarUsuario($usuario){
        $query=$this->db->query("SELECT * FROM usuario WHERE usuario='$usuario'");

            if($query->num_rows()>0){
                return $query->result_array();
            }else{
                return null;
            }
    }

    function nuevoUsuario($usuario, $contrasena, $persona, $rol) {
        $fechaActual = date("Y-m-d H:i:s");
        $ip =$this->input->ip_address();
        if($this->validarUsuario($usuario)==null){
            $query = $this->db->query("INSERT usuario (usuario,contrasena,id_persona,id_rol,fecha_registro,ip_registro) VALUES ('$usuario', '$contrasena', $persona, $rol, '$fechaActual', '$ip')");
            return $query;
         }else{
            return "El funcionario ya tiene un usuario registrado.";
        }
    }

    public function getUsuarios() {
        $query = $this->db->query("SELECT id_usuario,nombres,apellidos,establecimiento,rol, usuario,u.estado as estado FROM usuario u
                                    JOIN persona p ON u.id_persona=p.id_persona
                                    JOIN establecimiento e ON p.id_establecimiento=e.id_establecimiento
                                    JOIN rol r ON u.id_rol=r.id_rol");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }


    public function getUsuario($idusuario) {
        $query = $this->db->query("SELECT * FROM usuario WHERE id_usuario=$idusuario");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }


    function editarRol($id,$rol){
         $fechaActual = date("Y-m-d H:i:s");
         $ip =$this->input->ip_address();
         $query=$this->db->query("UPDATE usuario SET id_rol=$rol WHERE id_usuario=$id");
         return $query;
    }


    function editarContrasena($id,$contrasena){
         $fechaActual = date("Y-m-d H:i:s");
         $ip =$this->input->ip_address();
         $query=$this->db->query("UPDATE usuario SET contrasena='$contrasena' WHERE id_usuario=$id");
         return $query;
    }


    function eliminarUsuario($id){
         $fechaActual = date("Y-m-d H:i:s");
         $ip =$this->input->ip_address();
         $query=$this->db->query("UPDATE usuario SET estado=0 WHERE id_usuario=$id");
         return $query;
    }
}
?>