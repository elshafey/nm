<?php

class Faqs extends CMS {

    var $namespace = 'faqs';

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
                    'name' => 'question',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'multi' => true,
                    'value' => $value,
        ));
        $this->setUpColumn(
                array(
                    'name' => 'answer',
                    'validation' => 'required',
                    'required' => true,
                    'outType' => 'textarea',
                    'multi' => true,
                    'value' => $value,
        ));
        
        array_unshift($this->render_fields, 'answer');
        array_unshift($this->render_fields, 'question');
        
    }

}
