<?php

defined('BASEPATH') or exit('No direct script access allowed');
session_start();

/**
 * Description of ParteDiario
 *
 * @author Favius
 */
class ParteDiario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('cama_model');
        if (!isset($_SESSION["usuario"])) {
            redirect("login", "refresh");
        }
    }

    public function index() {

        $this->load->view('parteDiario');
    }

}
