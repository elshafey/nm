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
class Media_center extends CMSController{
    
    protected $_model='News';
    protected $_controller='media_center';
    
    public function __construct() {
        parent::__construct();
        $seg=$this->uri->segment(2);
        $this->_model=  ucfirst($seg);
//        $this->lang->load($seg);
        $this->data['controller']=$seg;
        $this->_redirect=$this->uri->segment(2);
    }
    
}

?>
