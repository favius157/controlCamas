<?php

defined('BASEPATH') or exit('No direct script access allowed');
session_start();

/**
 * Description of Permisos
 *
 * @author Favius
 */
class Permisos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('persona_model');
        $this->load->model('cargo_model');
        $this->load->model('establecimiento_model');
    }

    public function index() {

        $this->load->view('permisos');
    }

}
