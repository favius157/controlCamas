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
        $query = $this->db->query("SELECT id_piso,numero_piso FROM piso WHERE estado=1");
        /* $query = $this->db->query("SELECT p.id_piso as id_piso, p.numero_piso as numero_piso, COUNT(c.id_cama) as cantidadCamas FROM piso p LEFT JOIN cama c ON p.id_piso = c.id_piso GROUP by p.id_piso"); */
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
        $query = $this->db->query("SELECT c.estado as estado, c.numero_cama as numeroCama, COUNT(c.estado) as cantidad  FROM cama c
                                JOIN bloque b ON c.id_bloque=b.id_bloque
                                JOIN sala s ON c.id_sala=s.id_sala
                                JOIN piso p ON s.id_piso=p.id_piso
                                WHERE b.nombre_bloque = '$bloque' and p.id_piso = $piso GROUP BY c.estado");
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
        $query = $this->db->query("SELECT id_cama,numero_cama,p.id_piso as id_piso,numero_piso,c.id_bloque as id_bloque,nombre_bloque,c.id_sala as id_sala,sala,sector,c.estado as estado FROM cama c
                                    JOIN sala s on c.id_sala=s.id_sala
                                    JOIN piso p ON s.id_piso=p.id_piso
                                    JOIN bloque b ON c.id_bloque=b.id_bloque
                                    WHERE p.id_piso = $idPiso");
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
        return $this->db->query("UPDATE cama set estado = $estado where id_cama = $idCama");
    }

    function validarAlta($idhistorial) {
        $query = $this->db->query("SELECT nombres,matricula,edad,diagnostico_enfermeria,numero_piso,numero_cama FROM asignacion_cama ac
                                    JOIN cama c ON ac.id_cama=c.id_cama
                                    JOIN sala s ON c.id_sala=c.id_sala
                                    JOIN piso p ON s.id_piso=p.id_piso
                                    WHERE id_historial=$idhistorial AND ac.estado=1 limit 1");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function asignarCama($matricula, $nombres, $codcns, $fecnacimiento, $edad, $sexo, $diagnostico, $cie10,$cie10literal, $equipamiento, $empresa, $patronal, $medico, $especialidad, $diagnosticoenfermeria, $tipoingreso, $idhistorial, $idCama) {

        $usuarioActual = json_decode($_SESSION["usuario"]);
        $usuarioActual = $usuarioActual[0]->id_usuario;
        $ip = $this->input->ip_address();
        $hoy = date("Y-m-d H:i:s");
        $this->cambiarEstadoCama($idCama, $tipoingreso);
        $query = $this->db->query("INSERT INTO asignacion_cama (matricula,nombres,codcns,fec_nacimiento,edad,sexo,diagnostico,cie10,cie10_literal,equipamiento,empresa,patronal,medico,especialidad,diagnostico_enfermeria,tipoingreso,fecha_asignacion,id_historial,id_cama,id_usuario,fecha_registro,ip_registro) VALUES('$matricula','$nombres','$codcns','$fecnacimiento','$edad',$sexo,'$diagnostico','$cie10','$cie10literal','$equipamiento','$empresa','$patronal','$medico','$especialidad','$diagnosticoenfermeria',$tipoingreso,'$hoy','$idhistorial',$idCama,$usuarioActual,'$hoy','$ip')");
        return $query;
    }

    function verPacienteByCama($idcama) {
        $query = $this->db->query("SELECT id_historial,ac.nombres as nombres,ac.matricula as matricula,codcns,fec_nacimiento,TIMESTAMPDIFF(YEAR,fec_nacimiento,CURDATE()) AS edad,sexo,patronal,empresa,diagnostico,cie10,medico,especialidad,fecha_asignacion,pi.id_piso as id_piso,concat(p.nombres,' ',p.apellidos) as usuario FROM asignacion_cama ac
                                   JOIN cama c ON ac.id_cama=c.id_cama
                                   JOIN sala s ON c.id_sala=s.id_sala
                                   JOIN piso pi ON s.id_piso=pi.id_piso
                                   JOIN usuario u ON ac.id_usuario=u.id_usuario
                                   JOIN persona p ON u.id_persona=p.id_persona
                                   WHERE ac.id_cama=$idcama AND ac.estado=1");
        //WHERE id_cama=$idcama ORDER BY fecha_asignacion desc LIMIT 1");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function liberarCama($idCama, $tipo, $usuario) {
        $hoy = date("Y-m-d H:i:s");
        $this->cambiarEstadoCama($idCama, 1);
        return $this->db->query("update asignacion_cama set fecha_alta = '$hoy',estado=2, id_tipoalta = $tipo, idusuario_alta = $usuario where id_cama = $idCama");
    }

    function cargarAsignacionByCama($idCama) {
//        echo "SELECT *, MAX(fecha_asignacion) fAsignacion FROM asignacion_cama WHERE id_cama = $idCama";
        $query = $this->db->query("SELECT * FROM asignacion_cama WHERE id_cama = $idCama ORDER by id_asignacioncama DESC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarTiposAlta() {
        $query = $this->db->query("SELECT * FROM tipo_alta");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function listarCamas($idpiso) {
        $query = $this->db->query("SELECT c.id_cama as id_cama, numero_cama,c.estado FROM cama c
                                    JOIN sala s ON c.id_sala=s.id_sala
                                    JOIN piso p ON s.id_piso=p.id_piso
                                    Where p.id_piso=$idpiso AND c.estado = 1 order by c.id_cama asc");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarDetalleCama($idCama) {
        $query = $this->db->query("SELECT * FROM cama c, piso p, bloque b, sala s WHERE b.id_bloque = c.id_bloque and s.id_sala = c.id_sala and s.id_piso = p.id_piso and c.id_cama = $idCama");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function estadoCamas() {
        $query = $this->db->query("SELECT (SELECT COUNT(estado) from cama WHERE estado = 1) as camasLibres, (SELECT COUNT(estado) from cama WHERE estado = 2) as camasOcupadas, COUNT(*) as total FROM `cama`");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function asignacionesFechaActual() {
        $fechaActual = date("Y-m-d");
        $query = $this->db->query("SELECT id_asignacioncama,CONCAT(cie10,' ',cie10_literal) as cie10,tipoingreso,id_cama FROM `asignacion_cama` WHERE fecha_asignacion like '$fechaActual%'");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function pacientesCriticos() {

        $fecha = date("Y-m-d");
        $fecha = date("Y-m-d", strtotime($fecha . "- 14 days"));

        $query = $this->db->query("SELECT * FROM `asignacion_cama` WHERE fecha_asignacion < '$fecha' and estado = 1");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarAsignacionesByTipoIngreso($tIngreso) {

        $query = $this->db->query("SELECT * FROM `asignacion_cama` WHERE estado = 1 and tipoingreso = $tIngreso");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function actividadDelDia($fecha) {
        $query = $this->db->query("SELECT * FROM `asignacion_cama` WHERE fecha_asignacion like '$fecha%' or fecha_alta like '$fecha%' ORDER by fecha_registro DESC");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarInternacionesByPiso($idPiso, $fecha) {
        $query = "SELECT ac.matricula as matricula, ac.nombres as nombres, ac.fec_nacimiento as fechaNacimiento, ac.sexo as sexo, s.sala as sala, c.numero_cama as cama, ac.diagnostico as diagnostico FROM asignacion_cama ac, piso p, cama c, sala s WHERE ac.id_cama = c.id_cama and c.id_sala = s.id_sala and s.id_piso = p.id_piso and ac.fecha_alta LIKE '$fecha%' and p.id_piso = $idPiso";
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

    function cargarAltasByPiso($idPiso, $fecha) {
        $query = "SELECT ac.matricula as matricula, ac.nombres as nombres, ac.fec_nacimiento as fechaNacimiento, ac.sexo as sexo, s.sala as sala, c.numero_cama as cama, ac.fecha_asignacion as fechaAsignacion, ac.diagnostico as diagnostico, ta.tipoalta as tipoAlta FROM asignacion_cama ac, piso p, cama c, sala s, tipo_alta ta WHERE ta.id_tipoalta = ac.id_tipoalta AND ac.id_cama = c.id_cama and c.id_sala = s.id_sala and s.id_piso = p.id_piso and ac.estado = 2 and ac.fecha_alta LIKE '$fecha%' and p.id_piso = $idPiso";
        
        $query = $this->db->query($query);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }

}
