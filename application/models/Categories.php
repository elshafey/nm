<?php

class Categories extends CMS {

    var $namespace = 'categories';

    public function __construct($id = null) {
        parent::__construct($id);
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
                    'name' => 'name',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'multi' => true,
                    'value' => $value,
        ));
        
        $this->setUpColumn(
                array(
                    'name' => 'url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_BOOK_CATEGORY),
        ));
        array_unshift($this->render_fields, 'url');
        array_unshift($this->render_fields, 'name');
        
    }

    

}
