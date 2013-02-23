<?php

class Books extends CMS {

    var $namespace = 'books';

    public function __construct($id = null) {
        parent::__construct($id);
        if ($id) {
            $this->setUpColumn(
                    array(
                        'name' => 'parent_id',
                        'select_list' => SubCategoriesTable::getListByCat($this->category),
                    )
            );
        }
//        pre_print($this);
    }

    public function setUp() {
        parent::setUp();
        $value = array();
        foreach (get_lang_list() as $key => $lang) {
            $value[$key] = '';
        }

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
                )
        );

        $this->setUpColumn(
                array(
                    'name' => 'title',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'multi' => true,
                    'value' => $value,
        ));

        $this->setUpColumn(
                array(
                    'name' => 'author',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'multi' => true,
                    'value' => $value,
        ));

        $this->setUpColumn(
                array(
                    'name' => 'isbn',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'img',
                    'validation' => 'required|xss_clean',
                    'required' => false,
                    'outType' => 'img_uploader',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'preview',
                    'validation' => 'required|xss_clean',
                    'required' => false,
                    'outType' => 'file_uploader',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'img_alt',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'img_title',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));

        $this->setUpColumn(
                array(
                    'name' => 'book_url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_BOOK),
        ));

        array_unshift($this->render_fields, 'book_url');
        array_unshift($this->render_fields, 'img_title');
        array_unshift($this->render_fields, 'img_alt');
        array_unshift($this->render_fields, 'img');
        array_unshift($this->render_fields, 'preview');
        array_unshift($this->render_fields, 'isbn');
        array_unshift($this->render_fields, 'author');
        array_unshift($this->render_fields, 'title');
        array_unshift($this->render_fields, 'parent_id');
        array_unshift($this->render_fields, 'category');
    }

}
