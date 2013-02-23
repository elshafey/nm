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
class Subcategory extends CMSController{
    
    protected $_model='SubCategories';
    protected $_controller='subcategory';
    
    public function __construct() {
        parent::__construct();
    }
    
}

?>