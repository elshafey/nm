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
class Educational_solutions extends Side_menu{
    
    protected $_model='EducationalSolutions';
    protected $_controller='educational_solutions';
    
    public function __construct() {
        parent::__construct();
    }
    
}

?>
