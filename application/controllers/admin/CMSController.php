<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CMSController
 *
 * @author elshafey
 */
class CMSController extends My_Controller {

    protected $_model = '';
    protected $_controller = '';
    protected $_redirect = '';

    public function __construct() {
        parent::__construct();
        if (
                $this->uri->segment(1) == 'admin'
                &&
                $this->uri->rsegment(1) != 'login'
        ) {
            if (!$this->session->userdata('is_login')) {

                redirect('admin/login');

                exit;
            }
        }
        $this->template->set_template('admin_template');
        $this->data['controller'] = $this->_controller;
        $this->_redirect = $this->_controller;
    }

    function index() {
        $table = $this->_model . 'Table';
        $pages = $table::getList();

        $this->data['responce'] = $this->getRespnce($pages);
        $this->data['page_title'] = lang($this->data['controller'] . '_index_page_title');
        load_grid_files();

        $this->load_view('index');
    }

    protected function getRespnce($pages) {
        $responce = array();
        if ($pages) {
            foreach ($pages as $k => $page) {
                foreach ($page as $field => $value) {
                    if (is_array($value)) {
                        foreach ($value as $key => $v) {
                            $responce[$k][$field . "_$key"] = $v;
                        }
                    } elseif ($field == 'page_order') {
                        $responce[$k][$field] = order_icon($value, $this->data['controller'], $page['id']);
                    } elseif ($field == 'is_active') {
                        $responce[$k][$field] = active_icon($value, $this->data['controller'], $page['id']);
                    } else {
                        $responce[$k][$field] = $value;
                    }
                }
                $responce[$k]['edit'] =
                        '<a class="edit_lnk" rel="' . $page['id'] . '"  href="' . site_url("admin/{$this->data['controller']}/edit/{$page['id']}") . '">' . lang('global_edit') . ' </a>';
                $responce[$k]['delete'] =
                        '<a class="delete_lnk" href="' . site_url("admin/{$this->data['controller']}/delete/{$page['id']}") . '">' . lang('global_delete') . ' </a>';
            }
        }
        return $responce;
    }

    protected function load_view($view) {
        $this->template->write_view('content', 'admin/' . $this->_controller . '/' . $view, $this->data, FALSE);
        $this->template->render();
    }

    protected function create_logic() {
        $model = $this->_model;

        /* @var $form Forms */
        $form = new Forms(new $model());
        if ($form->process()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('global_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/' . $this->_redirect);
        }
        $this->data['form'] = $form;
    }

    protected function render_form_file() {
        
    }

    public function create() {

        $this->data['page_title'] = lang($this->data['controller'] . '_form_create_page_title');

        $this->create_logic();

        $this->load_view('form');
    }

    protected function edit_logic($id) {
        $model = $this->_model;
        
        /* @var $form Forms */
        $form = new Forms(new $model($id));

        if ($form->process()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('global_edited_successfully')
            );

            $this->session->set_flashdata("message", $message);
            if (is_ajax()) {
                echo 'success';
                exit;
            } else {
                redirect('admin/' . $this->_redirect);
            }
        }
        $this->data['id'] = $id;
        $this->data['form'] = $form;
    }

    public function edit($id) {
        $this->data['page_title'] = lang($this->data['controller'] . '_form_edit_page_title');
        $this->edit_logic($id);
        $this->load_view('form');
    }

    public function orderup($id) {
        $model = $this->_model;

        /* @var $cms CMS */
        $cms = new $model($id);
        $cms->page_order = $cms->page_order - 1;
        $cms->save();
        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('global_order_changed_successfully')
        );

        $this->session->set_flashdata("message", $message);
        redirect('admin/' . $this->_redirect);
    }

    public function orderdown($id) {
        $model = $this->_model;

        /* @var $cms CMS */
        $cms = new $model($id);
        $cms->page_order = $cms->page_order + 1;
        $cms->save();
        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('global_order_changed_successfully')
        );

        $this->session->set_flashdata("message", $message);
        redirect('admin/' . $this->_redirect);
    }

    public function activate($id) {
        $model = $this->_model;

        /* @var $cms CMS */
        $cms = new $model($id);
        $cms->is_active = 1;
        $cms->save();
        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('global_activated_successfully')
        );

        $this->session->set_flashdata("message", $message);
        redirect('admin/' . $this->_redirect);
    }

    public function deactivate($id) {
        $model = $this->_model;

        /* @var $cms CMS */
        $cms = new $model($id);
        $cms->is_active = 0;
        $cms->save();
        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('global_deactivated_successfully')
        );

        $this->session->set_flashdata("message", $message);
        redirect('admin/' . $this->_redirect);
    }

    public function delete($id) {
        $model = $this->_model;

        /* @var $cms CMS */
        $cms = new $model($id);
        $cms->delete();
        $message = array(
            'msg_type' => 'success',
            'msg_text' => lang('global_deleted_successfully')
        );

        $this->session->set_flashdata("message", $message);
        redirect('admin/' . $this->_redirect);
    }

}

?>
