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
class Category extends CMSController{
    
    protected $_model='Categories';
    protected $_controller='category';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function deactivate($id) {
        parent::deactivate($id);
    }
    
}

?>