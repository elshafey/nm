<?php

require_once APPPATH.'controllers/admin/CMSController.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of banner
 *
 * @author elshafey
 */
class Contactus extends CMSController{
    
    protected $_model='ContactusServices';
    protected $_controller='contactus';
    
    public function __construct() {
        parent::__construct();
    }
    
}

?>