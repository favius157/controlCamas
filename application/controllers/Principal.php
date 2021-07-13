<?php

defined('BASEPATH') or exit('No direct script access allowed');

session_start();

class Principal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model("persona_model");
        if(!isset($_SESSION["usuario"])){
            redirect("login", "refresh");
        }
    }

    public function index() {
        $this->load->view('principal');
    }

}

?>