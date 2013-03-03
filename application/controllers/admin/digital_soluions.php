<?php

require_once APPPATH.'controllers/admin/side_menu.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of aboutus
 *
 * @author elshafey
 */
class Digital_soluions extends Side_menu{
    
    protected $_model='DigitalSoluions';
    protected $_controller='digital_soluions';
    
    public function __construct() {
        parent::__construct();
    }
    
}

?>
