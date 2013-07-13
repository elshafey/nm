<?php

class Downloads extends CMS {

    var $namespace = 'downloads';

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
                    'name' => 'path',
                    'validation' => 'required|xss_clean',
                    'required' => false,
                    'outType' => 'file_uploader',
                    'value' => '',
        ));
        
        $this->setUpColumn(
                array(
                    'name' => 'name',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'multi' => true,
                    'value' => $value,
        ));
        $this->setUpColumn(array(
            'name' => 'description',
            'outType' => 'textarea',
            'validation' => 'required|xss_clean',
            'required' => true,
            'multi' => true,
            'value' => $value,
        ));
        array_unshift($this->render_fields, 'path');
        array_unshift($this->render_fields, 'description');
        array_unshift($this->render_fields, 'name');
    }

}
