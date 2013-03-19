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
class Custom_solutions extends Side_menu{
    
    protected $_model='CustomSolutions';
    protected $_controller='custom_solutions';
    
    public function __construct() {
        parent::__construct();
    }
    
}

?>
