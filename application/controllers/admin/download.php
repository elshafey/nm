<?php

require_once APPPATH.'controllers/admin/CMSController.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of aboutus
 *
 * @author elshafey
 */
class Download extends CMSController{
    
    protected $_model='Downloads';
    protected $_controller='download';
    
    public function __construct() {
        parent::__construct();
    }
    
}

?>
