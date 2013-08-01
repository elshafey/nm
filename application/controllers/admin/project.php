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
class Project extends CMSController{
    
    protected $_model='Projects';
    protected $_controller='project';
    
    public function __construct() {
        parent::__construct();
    }
    
}

?>
