<?php

require_once APPPATH . 'controllers/admin/CMSController.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of banner
 *
 * @author elshafey
 */
class Book extends CMSController {

    protected $_model = 'Books';
    protected $_controller = 'book';

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['page_title'] = lang($this->data['controller'] . '_index_page_title');
        load_grid_files();
        $this->template->write_view('content', 'admin/' . $this->_controller . '/index', $this->data, FALSE);
        $this->template->render();
    }

    public function books_list() {
        $pages = BooksTable::getList();

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
            //$jobSeekers[$key]["rate"] = evaluate_rate($jobSeeker["js_id"]);

            $responce->rows[$k]['id'] = $page["id"];
            $responce->rows[$k]['cell'] = array(
                $page['title']['en-us'],
                $page['title']['ar-eg'],
                $page['Subcategories']['name'][get_locale()],
                $page['Subcategories']['Categories']['name'][get_locale()],
                order_icon($page['page_order'], $this->data['controller'], $page['id']),
                active_icon($page['is_active'], $this->data['controller'], $page['id']),
                '<a href="' . site_url("admin/{$this->data['controller']}/edit/{$page['id']}") . '">' . lang('global_edit') . ' </a>',
                '<a class="delete_lnk" href="' . site_url("admin/{$this->data['controller']}/delete/{$page['id']}") . '">' . lang('global_delete') . ' </a>'
            );
        }
        
        echo json_encode($responce);
    }

    public function categories_list() {
        $pages = CategoriesTable::getList();

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
            //$jobSeekers[$key]["rate"] = evaluate_rate($jobSeeker["js_id"]);

            $responce->rows[$k]['id'] = $page["id"];
            $responce->rows[$k]['cell'] = array(
                $page['name']['en-us'],
                $page['name']['ar-eg'],
                order_icon($page['page_order'], 'category', $page['id']),
                active_icon($page['is_active'], 'category', $page['id']),
                '<a href="' . site_url("admin/category/edit/{$page['id']}") . '">' . lang('global_edit') . ' </a>',
                '<a class="delete_lnk" href="' . site_url("admin/category/delete/{$page['id']}") . '">' . lang('global_delete') . ' </a>'
            );
        }
        
        echo json_encode($responce);
    }

    public function subcategories_list() {
        $this->data['controller']='subcategory';
        $pages = SubCategoriesTable::getList();
        
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
            //$jobSeekers[$key]["rate"] = evaluate_rate($jobSeeker["js_id"]);

            $responce->rows[$k]['id'] = $page["id"];
            $responce->rows[$k]['cell'] = array(
                $page['name']['en-us'],
                $page['name']['ar-eg'],
                order_icon($page['page_order'], $this->data['controller'], $page['id']),
                active_icon($page['is_active'], $this->data['controller'], $page['id']),
                $page['Categories']['name'][get_locale()],
                '<a href="' . site_url("admin/{$this->data['controller']}/edit/{$page['id']}") . '">' . lang('global_edit') . ' </a>',
                '<a class="delete_lnk" href="' . site_url("admin/{$this->data['controller']}/delete/{$page['id']}") . '">' . lang('global_delete') . ' </a>'
            );
        }
        
        echo json_encode($responce);
    }

    public function get_subcategories($cat_id) {

        $cms = new CMS();
        $cms->namespace = 'books';
        $form = new Forms($cms);
        $form->addSelect(array(
            'name' => 'parent_id',
            'outType' => 'select',
            'validation' => 'required|xss_clean',
            'required' => true,
            'select_list' => SubCategoriesTable::getListByCat($cat_id),
            'select_txt_field' => 'name',
            'value' => ''
        ));
        echo $form->getFieldHTML('parent_id');
    }

}

?>