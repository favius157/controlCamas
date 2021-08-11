<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pdf_helper
 *
 * @author Favius
 */
class pdf_helper {

    function tcpdf() {
        require_once('tcpdf/config/lang/eng.php');
        require_once('tcpdf/tcpdf.php');
    }

}
