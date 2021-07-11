<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Persona
 *
 * @author Favius
 */
class Paciente extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('usuario_model');
    }

    public function index() {

        $this->load->view('paciente');
    }

}
?>