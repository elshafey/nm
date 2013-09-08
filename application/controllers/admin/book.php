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
        $this->lang->load('home');
        if ($_GET)
            $_POST = $_GET;

        if ($_POST) {

            $this->form_validation->set_rules('title', '', 'xss_clean');
            $this->form_validation->set_rules('author', '', 'xss_clean');
            $this->form_validation->set_rules('isbn', '', 'xss_clean');
            $this->form_validation->set_rules('category', '', 'xss_clean');
            $this->form_validation->set_rules('subcategory', '', 'xss_clean');
            $this->form_validation->set_rules('subcategory2', '', 'xss_clean');
            $this->form_validation->run();
            if ($_POST['category'])
                $this->data['subcategories'] = SubCategoriesTable::getListByCat($_POST['category'], true);

            if (isset($_POST['subcategory']) && $_POST['subcategory'])
                $this->data['subcategories2'] = SubCategories2Table::getListByCat($_POST['subcategory'], true);
        }
        $this->data['categories'] = CategoriesTable::getList(true);
        $this->data['page_title'] = lang($this->data['controller'] . '_index_page_title');
        load_grid_files();
        $this->template->write_view('content', 'admin/' . $this->_controller . '/index', $this->data, FALSE);
        $this->template->render();
    }

    public function books_list() {
         
        $pages = BooksTable::advancedSearch($_GET);

        $per_page = 10;
        $count = count($pages);
        $curPage = 1;
        $total_pages = ceil($count / $per_page);

        $responce = new stdClass();

        $responce->page = $curPage;
        $responce->total = $total_pages;
        $responce->records = $count;
//        pre_print($pages);
        foreach ($pages as $k => $page) {
            //$jobSeekers[$key]["rate"] = evaluate_rate($jobSeeker["js_id"]);
            $subcategory2 = SubCategories2Table::getOneBy('id', $page['parent_id']);
            $subcategory = SubCategoriesTable::getOneBy('id', $page['subcategory']);
            $category = CategoriesTable::getOneBy('id', $page['category']);
            $responce->rows[$k]['id'] = $page["id"];
            $responce->rows[$k]['cell'] = array(
                $page['title']['en-us'],
                $page['title']['ar-eg'],
                $subcategory2['name'][get_locale()],
                $subcategory['name'][get_locale()],
                $category['name'][get_locale()],
                ($page['is_latest_release']) ? lang('books_is_latest_release_view') : '-',
                $page['is_most_popular'] ? lang('books_is_most_popular_view') : '-',
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
        $this->data['controller'] = 'subcategory';
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
                '<a href="' . site_url("admin/{$this->data['controller']}/edit/{$page['id']}") . '">' . lang('global_edit') . ' </a>',
                '<a class="delete_lnk" href="' . site_url("admin/{$this->data['controller']}/delete/{$page['id']}") . '">' . lang('global_delete') . ' </a>'
            );
        }

        echo json_encode($responce);
    }

    public function subcategories2_list() {
        $this->data['controller'] = 'subcategory2';
        $pages = SubCategories2Table::getList();

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
                '<a href="' . site_url("admin/{$this->data['controller']}/edit/{$page['id']}") . '">' . lang('global_edit') . ' </a>',
                '<a class="delete_lnk" href="' . site_url("admin/{$this->data['controller']}/delete/{$page['id']}") . '">' . lang('global_delete') . ' </a>'
            );
        }

        echo json_encode($responce);
    }

    public function get_subcategories2($cat_id) {

        $cms = new CMS();
        $cms->namespace = 'books';
        $form = new Forms($cms);
        $form->addSelect(array(
            'name' => 'parent_id',
            'outType' => 'select',
            'validation' => 'required|xss_clean',
            'required' => true,
            'select_list' => SubCategories2Table::getListByCat($cat_id),
            'select_txt_field' => 'name',
            'value' => ''
        ));
        echo $form->getFieldHTML('parent_id');
    }

    public function get_subcategories($cat_id) {

        $cms = new CMS();
        $cms->namespace = 'books';
        $form = new Forms($cms);
        $form->addSelect(array(
            'name' => 'subcategory',
            'outType' => 'select',
            'validation' => 'required|xss_clean',
            'required' => true,
            'select_list' => SubCategoriesTable::getListByCat($cat_id),
            'select_txt_field' => 'name',
            'value' => ''
        ));

        echo $form->getFieldHTML('subcategory');
    }

}

?>