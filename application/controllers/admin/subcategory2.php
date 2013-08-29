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
class Subcategory2 extends CMSController{
    
    protected $_model='SubCategories2';
    protected $_controller='subcategory2';
    
    public function __construct() {
        parent::__construct();
    }
    
}

?>