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
class Side_menu extends CMSController {

    public function __construct() {
        parent::__construct();
    }

    protected function load_view($view) {
        $this->template->write_view('content', 'admin/side_menu/' . $view, $this->data, FALSE);
        $this->template->render();
    }

    public function downloads($id) {
        $pages = CMSTable::getListBy('parent', $id, false, 'side_menu_downloads');

        $per_page = 10;
        $count = count($pages);
        $curPage = 1;
        $total_pages = ceil($count / $per_page);

        $responce = new stdClass();

        $responce->page = $curPage;
        $responce->total = $total_pages;
        $responce->records = $count;
//        pre_print($jobSeekers);
        foreach ($pages as $k => $page) {

            $responce->rows[$k]['id'] = $page["id"];
            $responce->rows[$k]['cell'] = array(
                $page['name']['en-us'],
                $page['name']['ar-eg'],
                order_icon($page['page_order'], $this->data['controller'] . '/downloads', $page['id']),
                active_icon($page['is_active'], $this->data['controller'] . '/downloads', $page['id']),
                '<a href="' . site_url("admin/{$this->data['controller']}/edit_download/{$page['id']}") . '">' . lang('global_edit') . ' </a>',
                '<a class="delete_lnk" href="' . site_url("admin/{$this->data['controller']}/delete_download/{$page['id']}") . '">' . lang('global_delete') . ' </a>'
            );
        }

        echo json_encode($responce);
    }

    public function add_download($id) {
        $this->data['page_title'] = lang($this->data['controller'] . '_downloads_form_create_page_title');
        
        $model = new Downloads();
        $model->namespace='side_menu_downloads';
        $model->setUpColumn(
                array(
                    'name' => 'parent_id',
                    'validation' => 'xss_clean',
                    'required' => true,
                    'outType' => 'hidden',
                    'value' => $id,
                )
        );
        array_unshift($model->render_fields, 'parent_id');
        /* @var $form Forms */
        $form = new Forms($model);
        if ($form->process()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('global_added_successfully')
            );

            $this->session->set_flashdata("message", $message);
            redirect('admin/' . $this->_redirect.'/edit/'.$id);
        }
        $this->data['form'] = $form;
        $this->data['controller']=$this->_redirect.'/edit/'.$id;
        $this->template->write_view('content', 'admin/download/form', $this->data, FALSE);
        $this->template->render();
    }
    
    function edit_download($id){
        $this->data['page_title'] = lang($this->data['controller'] . '_downloads_form_edit_page_title');
        $model = new Downloads($id);
        $model->namespace='side_menu_downloads';
//        $model->setUpColumn(
//                array(
//                    'name' => 'parent_id',
//                    'validation' => 'xss_clean',
//                    'required' => true,
//                    'outType' => 'hidden',
//                    'value' => $id,
//                )
//        );
        array_unshift($model->render_fields, 'parent_id');

        /* @var $form Forms */
        $form = new Forms($model);

        if ($form->process()) {
            $message = array(
                'msg_type' => 'success',
                'msg_text' => lang('global_edited_successfully')
            );

            $this->session->set_flashdata("message", $message);
            if (is_ajax()) {
                echo 'success';exit;
            } else {
                redirect('admin/' . $this->_redirect.'/edit/'.$model->parent_id->getId());
            }
        }
        $this->data['id']=$id;
        $this->data['form'] = $form;
        $this->data['controller']=$this->_redirect.'/edit/'.$model->parent_id->getId();
        $this->template->write_view('content', 'admin/download/form', $this->data, FALSE);
        $this->template->render();
    }

}

?>
