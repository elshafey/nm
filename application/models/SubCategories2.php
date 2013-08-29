<?php

class SubCategories2 extends Categories {

    var $namespace = 'subcategories2';

    public function __construct($id = null) {
        parent::__construct($id);
//        pre_print($this);
        if ($id) {
            $this->setUpColumn(
                    array(
                        'name' => 'parent_id',
                        'select_list' => SubCategoriesTable::getListByCat($this->category),
                    )
            );
        }
    }

    public function setUp() {
        parent::setUp();

        $this->setUpColumn(
                array(
                    'name' => 'category',
                    'outType' => 'select',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'select_list' => CategoriesTable::getList(),
                    'select_txt_field' => 'name',
                    'value' => '',
                )
        );
        
         $this->setUpColumn(
                array(
                    'name' => 'parent_id',
                    'outType' => 'select',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'select_list' => array(),
                    'select_txt_field' => 'name',
                    'value' => '',
                )
        );
        
        
        array_unshift($this->render_fields, 'parent_id');
        array_unshift($this->render_fields, 'category');
    }

}
