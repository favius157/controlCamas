<?php

defined('BASEPATH') or exit('No direct script access allowed');
session_start();

/**
 * Description of test
 *
 * @author Favius
 */
class test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        if (!isset($_SESSION["usuario"])) {
            redirect("login", "refresh");
        }
    }

    public function index() {

        $this->load->view('test');
    }

}
