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
        $query = $this->db->query("SELECT p.id_piso as id_piso, p.numero_piso as numero_piso, COUNT(c.id_cama) as cantidadCamas FROM piso p LEFT JOIN cama c ON p.id_piso = c.id_piso GROUP by p.id_piso");
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

    function cargarDetalleByBloque($piso, $bloque) {
        $query = $this->db->query("SELECT c.estado as estado, c.numero_cama as numeroCama, COUNT(c.estado) as cantidad FROM cama c, bloque b WHERE b.id_bloque = c.id_bloque AND b.nombre_bloque = '$bloque' and c.id_piso = $piso GROUP BY c.estado");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarSalas() {
        $query = $this->db->query("SELECT * FROM sala WHERE estado = 1");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function nuevaCama($numeroCama, $bloque, $piso, $sector, $sala) {
        if ($this->validarCamaExistente($numeroCama, $piso) == null) {
            $fechaActual = date("Y-m-d H:i:s");
            $ip = $this->input->ip_address();
            $query = $this->db->query("insert into cama values (null, '$numeroCama', $piso, $bloque, $sala, $sector, '$fechaActual', '$ip', 1)");
            return $query;
        } else {
            return "-1";
        }
    }

    function nuevoBloque($nombreBloque) {
        $fechaActual = date("Y-m-d H:i:s");
        $ip = $this->input->ip_address();
        $query = $this->db->query("insert into bloque values (null, '$nombreBloque', '$fechaActual', '$ip', 1)");
        return $query;
    }

    function nuevaSala($nombreSala) {
//        $fechaActual = date("Y-m-d H:i:s");
//        $ip = $this->input->ip_address();
        $query = $this->db->query("insert into sala values (null, '$nombreSala', 1)");
        return $query;
    }

    function validarCamaExistente($numeroCama, $piso) {
        $query = $this->db->query("SELECT * FROM cama WHERE numero_cama = '$numeroCama' and id_piso = $piso");
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

    function cargarSalaById($idSala) {
        $query = $this->db->query("SELECT * FROM sala WHERE id_sala = $idSala");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarBloques() {
        $query = $this->db->query("SELECT * FROM bloque WHERE estado = 1");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cambiarEstadoCama($idCama, $estado) {
        return $this->db->query("update cama set estado = $estado where id_cama = $idCama");
    }

    function asignarCama($matricula,$nombres,$edad,$sexo,$diagnostico,$cie10,$medico,$especialidad,$idhistorial,$idcama){
        $usuarioActual = json_decode($_SESSION["usuario"]);
            $usuarioActual = $usuarioActual[0]->id_usuario;
            $ip=$this->input->ip_address();
            $hoy=date("Y-m-d H:i:s");
        $query2=$this->cambiarEstadoCama($idcama,2);
        $query=$this->db->query("INSERT INTO asignacion_cama (matricula,nombres,edad,sexo,diagnostico,cie10,medico,especialidad,fecha_asignacion,id_historial,id_cama,id_usuario,fecha_registro,ip_registro) VALUES('$matricula','$nombres','$edad',$sexo,'$diagnostico','$cie10','$medico','$especialidad','$hoy','$idhistorial',$idcama,$usuarioActual,'$hoy','$ip')");
        return $query;
    }

    function verPacienteByCama($idcama){
        $query = $this->db->query("SELECT ac.matricula as matricula,ac.nombres as nombres,edad,sexo,diagnostico,cie10,medico,especialidad,fecha_asignacion,concat(p.nombres,' ',p.apellidos) as usuario FROM asignacion_cama ac
                                   JOIN usuario u ON ac.id_usuario=u.id_usuario
                                   JOIN persona p ON u.id_persona=p.id_persona
                                   WHERE id_cama=$idcama");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}
