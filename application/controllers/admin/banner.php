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
class Banner extends CMSController{
    
    protected $_model='Banners';
    protected $_controller='banner';
    
    public function __construct() {
        parent::__construct();
    }
    
}

?>
