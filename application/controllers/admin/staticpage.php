<?php

require_once APPPATH . 'controllers/admin/CMSController.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of aboutus
 *
 * @author elshafey
 */
class Staticpage extends CMSController {

    protected $_model = 'StaticPages';
    protected $_controller = 'staticpage';
    var $url_prefix='';
    
    public function __construct() {
        parent::__construct();
        $this->_redirect = $this->uri->segment(2);
        switch ($this->uri->segment(2)) {
            case 'home':
                $this->_model = 'HomePage';
                break;
            case 'portfolio-main':
                $this->url_prefix=  Urls::URL_PREFIX_PORTFOLIO;
                $this->_model = 'HomePage';
                $this->_redirect='portfolio';
                break;
            default:
                break;
        }
    }

    function index($type = 'home') {
        $this->data['type'] = $type;

        $page = StaticPagesTable::getPage($type);
        if ($page)
            $this->edit($page['id']);
        else {
            $this->create();
        }
    }

}

?>
