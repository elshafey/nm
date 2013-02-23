<?php

class StaticPages extends CMS {

    var $namespace = 'staticpages';

    public function __construct($id = null) {
        parent::__construct($id);
//        pre_print($this);
    }

    protected function setUp() {
        parent::setUp();
        $value = array();
        foreach (get_lang_list() as $key => $lang) {
            $value[$key] = '';
        }
        
        $this->setUpColumn(
                array(
                    'name' => 'page_url',
                    'outType' => 'url',
                    'value' => new StaticUrls(),
        ));
        $this->setUpColumn(
                array(
                    'name' => 'type',
                    'validation' => 'required',
                    'outType' => 'hidden',
                    'value' => '',
        ));
        
        array_pop($this->render_fields);
        array_pop($this->render_fields);
        array_unshift($this->render_fields, 'page_url');
        array_unshift($this->render_fields, 'type');
        
        
    }

}
