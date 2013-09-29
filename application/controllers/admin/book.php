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
            $this->form_validation->set_rules('is_active', '', 'xss_clean');
            $this->form_validation->set_rules('is_latest_release', '', 'xss_clean');
            $this->form_validation->set_rules('is_most_popular', '', 'xss_clean');
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

    public function export() {
        $pages = BooksTable::advancedSearch($_GET,'','',FALSE);
        require_once 'PHPExcel-1.7.7/PHPExcel.php';
        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_to_phpTemp;
        $cacheSettings = array('memoryCacheSize' => '8GB');
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
        PHPExcel_Cell::setValueBinder(new PHPExcel_Cell_AdvancedValueBinder());
        $phpExcell = new PHPExcel();

        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(0, 1), 'ISBN');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(1, 1), 'Category name in Arabic');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(2, 1), 'Category name in English');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(3, 1), 'Subcategory1 name in Arabic');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(4, 1), 'Subcategory 1 name in English');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(5, 1), 'Subcategory2 name in Arabic');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(6, 1), 'Subcategory 2 name in English');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(7, 1), 'Number of pages');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(8, 1), 'Title in English');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(9, 1), 'Title in Arabic');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(10, 1), 'Author name in English');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(11, 1), 'Author name in Arabic');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(12, 1), 'Brief description in English ');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(13, 1), 'Brief description in Arabic');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(14, 1), 'Preview PDF');
        $phpExcell->getActiveSheet()->setCellValue(get_cell_name(15, 1), 'Book Cover Thumbnail');
//        pre_print($pages);
        foreach ($pages as $key => $book) {
            $subcategory2 = SubCategories2Table::getOneBy('id', $book['parent_id']);
            $subcategory = SubCategoriesTable::getOneBy('id', $book['subcategory']);
            $category = CategoriesTable::getOneBy('id', $book['category']);
            $url=  UrlsTable::getOneBy('parent', $book['id']);
            $book['meta_title']=$url['meta_title'];
            $book['meta_keywords']=$url['meta_keywords'];
            $book['meta_description']=$url['meta_description'];
            $preview=  array_pop(explode('/', $book['preview']));
            $img=  array_pop(explode('/', $book['img']));
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(0, $key + 2), $book['isbn']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(1, $key + 2), $category['name']['ar-eg']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(2, $key + 2), $category['name']['en-us']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(3, $key + 2), $subcategory['name']['ar-eg']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(4, $key + 2), $subcategory['name']['en-us']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(5, $key + 2), $subcategory2['name']['ar-eg']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(6, $key + 2), $subcategory2['name']['en-us']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(7, $key + 2), $book['pages_count']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(8, $key + 2), $book['title']['en-us']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(9, $key + 2), $book['title']['ar-eg']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(10, $key + 2), $book['author']['en-us']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(11, $key + 2), $book['author']['ar-eg']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(12, $key + 2), $book['brief_description']['en-us']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(13, $key + 2), $book['brief_description']['ar-eg']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(14, $key + 2), $preview);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(15, $key + 2), $img);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(16, $key + 2), $book['meta_title']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(17, $key + 2), $book['meta_keywords']);
            $phpExcell->getActiveSheet()->setCellValue(get_cell_name(18, $key + 2), $book['meta_description']);
        }

        //setting column width
        $phpExcell->getActiveSheet()->getDefaultColumnDimension()->setWidth(30);

        $xlsx_file_name = md5(date('ymdHis'));
        $objWriter = new PHPExcel_Writer_Excel2007($phpExcell);
        $objWriter->save('uploads/exports/' . $xlsx_file_name . '.xlsx');

        redirect('uploads/exports/' . $xlsx_file_name . '.xlsx');
    }

    public function import() {
        set_time_limit(0);
        require 'PHPExcel-1.7.7/PHPExcel.php';
        $objPHPExcelReader=new PHPExcel_Reader_Excel2007();
        $sheetInfo=($objPHPExcelReader->listWorksheetInfo($_FILES['file']['tmp_name']));

        $objPHPExcel=$objPHPExcelReader->load($_FILES['file']['tmp_name']);
        
        $k = 1;
        foreach ($objPHPExcel->getSheet()->getRowIterator(2) as $i => $row) {
            $_POST = array();
            $book_post = array();
            if($i>$sheetInfo[0]['totalRows'])
                break;
//            echo $row->getRowIndex() . '<br>';
            foreach ($row->getCellIterator() as $cell) {
                if ($cell->getColumn() == 'A') {
                    $book_post['isbn'] = $cell->getValue();
                }
                if ($cell->getColumn() == 'B') {
                    $cat['ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'C') {
                    $cat['en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'D') {
                    $subcat['ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'E') {
                    $subcat['en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'F') {
                    $subcat2['ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'G') {
                    $subcat2['en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'H') {
                    $book_post['pages_count'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'I') {
                    $book_post['title_en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'J') {
                    $book_post['title_ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'K') {
                    $book_post['author_en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'L') {
                    $book_post['author_ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'M') {
                    $book_post['brief_description_en-us'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'N') {
                    $book_post['brief_description_ar-eg'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'O' && $cell->getValue() != '') {
                    $book_post['preview'] = 'uploads/files/' . $cell->getValue();
                }

                if ($cell->getColumn() == 'P' && $cell->getValue() != '') {
                    $book_post['img'] = 'uploads/images/' . $cell->getValue();
                }

                if ($cell->getColumn() == 'Q' && $cell->getValue() != '') {
                    $book_post['meta_title'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'R' && $cell->getValue() != '') {
                    $book_post['meta_keywords'] = $cell->getValue();
                }

                if ($cell->getColumn() == 'S' && $cell->getValue() != '') {
                    $book_post['meta_description'] = $cell->getValue();
                }
            }

            $this->form_validation = new My_Form_validation();
            $category = CategoriesTable::getOneBy('name', $cat['en-us']);
            $category_id = '';
            if ($category) {
                $category_id = $category['id'];
            } else {
                $category_post['name_en-us'] = $cat['en-us'];
                $category_post['name_ar-eg'] = $cat['ar-eg'];
                $category_post['page_order'] = $k;
                $category_post['is_active'] = 1;
                $_POST = $category_post;
                $form = new Forms(new Categories());
                if ($form->process()) {
                    $category = CategoriesTable::getOneBy('name', $cat['en-us']);
                    $category_id = $category['id'];
                } else {
//                    pre_print($this->form_validation->_error_array,false);
                    echo $form->renderFields();
                }
            }

            $this->form_validation = new My_Form_validation();
            $subcategory = SubCategoriesTable::getOneBy('name', $subcat['en-us']);
            $subcategory_id = '';
            if ($subcategory) {
                $subcategory_id = $subcategory['id'];
            } else {
                $subcategory_post['name_en-us'] = $subcat['en-us'];
                $subcategory_post['name_ar-eg'] = $subcat['ar-eg'];
                $subcategory_post['page_order'] = $k;
                $subcategory_post['is_active'] = 1;
                $subcategory_post['parent_id'] = $category_id;
                $_POST = $subcategory_post;
                $form = new Forms(new SubCategories());
                if ($form->process()) {
                    $subcategory = SubCategoriesTable::getOneBy('name', $subcat['en-us']);
                    $subcategory_id = $subcategory['id'];
                } else {
//                    echo $form->renderFields();
                }
//                        pre_print($form->cms->page);
            }

            $this->form_validation = new My_Form_validation();
            $subcategory2 = SubCategories2Table::getOneBy('name', $subcat2['en-us']);
            $subcategory2_id = '';
            if ($subcategory2) {
                $subcategory2_id = $subcategory2['id'];
            } else {
                $subcategory2_post['name_en-us'] = $subcat2['en-us'];
                $subcategory2_post['name_ar-eg'] = $subcat2['ar-eg'];
                $subcategory2_post['page_order'] = $k;
                $subcategory2_post['is_active'] = 1;
                $subcategory2_post['parent_id'] = $subcategory_id;
                $subcategory2_post['category'] = $category_id;
                $_POST = $subcategory2_post;
                $form = new Forms(new SubCategories2());
                if ($form->process()) {
                    $subcategory2 = SubCategories2Table::getOneBy('name', $subcat2['en-us']);
                    $subcategory2_id = $subcategory2['id'];
                } else {
//                    echo $form->renderFields();
                }
//                        pre_print($form->cms->page);
            }


            $book_post['img_alt'] = $book_post['img'];
            $book_post['img_title'] = $book_post['title_en-us'];
            $book_post['meta_title'] = $book_post['meta_title'] ;
            $book_post['meta_keywords'] = $book_post['meta_keywords'] ;
            $book_post['meta_description'] = $book_post['meta_description'];
            $book_post['is_active'] = 1;
            $book_post['is_latest_release'] = 0;
            $book_post['is_most_popular'] = 0;

            $book_post['category'] = $category_id;
            $book_post['subcategory'] = $subcategory_id;
            $book_post['parent_id'] = $subcategory2_id;
            $book_post['page_order'] = $k;
            
            $this->form_validation = new My_Form_validation();
            $obj = BooksTable::getOneBy('isbn', $book_post['isbn']);
            if ($obj) {
                $form = new Forms(new Books($obj['id']));
                $book_post['routed'] = $form->cms->book_url->routed;
                $book_post['is_latest_release'] = $form->cms->is_latest_release;
                $book_post['is_most_popular'] = $form->cms->is_most_popular;
            } else {
                $book_post['routed'] = Urls::URL_PREFIX_BOOK;
                $form = new Forms(new Books());
            }
            $_POST = $book_post;
            if (!$form->process()) {
                $errors[] = $book_post;
            }

            $k++;
        }

        if (isset($errors) && $errors)
            file_put_contents('non-uploded.txt', serialize($errors));
        
        redirect('admin/book');
    }

    public function books_list() {

        $pages = BooksTable::advancedSearch($_GET,'','',FALSE);

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