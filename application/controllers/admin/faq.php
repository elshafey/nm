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
class Faq extends CMSController {

    protected $_model = 'Faqs';
    protected $_controller = 'faq';

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->create_logic();
        parent::index();
    }

    public function edit($id) {
        $this->edit_logic($id);
        echo '<ul>';
        $this->data['form']->renderFields();
        echo '<li class="btns"><input type="submit" value="' . lang('global_btn_save') . '" /></li>';
        echo '</ul>';
    }

}

?>
