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
class Portfolio extends CMSController{
    
    protected $_model='Portfolios';
    protected $_controller='portfolio';
    
    public function __construct() {
        parent::__construct();
    }
    
}

?>
