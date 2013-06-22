<?php

require_once APPPATH.'controllers/admin/CMSController.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of achievement
 *
 * @author elshafey
 */
class Affiliated_companies extends CMSController{
    
    protected $_model='AffiliatedCompanies';
    protected $_controller='affiliated_companies';
    
    public function __construct() {
        parent::__construct();
    }
    
}

?>
