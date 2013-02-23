<?php

class SubCategories extends Categories {

    var $namespace = 'subcategories';

    public function __construct($id = null) {
        parent::__construct($id);
//        pre_print($this);
    }

    public function setUp() {
        parent::setUp();

        $this->setUpColumn(
                array(
                    'name' => 'parent_id',
                    'outType' => 'select',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'select_list' => CategoriesTable::getList(),
                    'select_txt_field' => 'name',
                )
        );

        $this->setUpColumn(
                array(
                    'name' => 'url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_BOOK_SUBCATEGORY),
        ));
        
        array_unshift($this->render_fields, 'parent_id');
    }

}
