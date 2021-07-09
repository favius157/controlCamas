<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of Rol
 *
 * @author Favius
 */
class Rol extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('privilegio_model');
    }

    public function index() {

        $this->load->view('roles');
    }

}
