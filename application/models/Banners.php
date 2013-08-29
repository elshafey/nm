<?php

class Banners extends CMS {

    var $namespace = 'banners';

    public function __construct($id = null) {
        parent::__construct($id);
//        pre_print($this);
    }

    protected function setUp() {
        parent::setUp();
        
        $this->setUpColumn(
                array(
                    'name' => 'path',
                    'validation' => 'required|xss_clean',
                    'required' => false,
                    'outType' => 'img_uploader',
                    'value' => '',
        ));
        $this->setUpColumn(
                array(
                    'name' => 'link',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));
        $this->setUpColumn(
                array(
                    'name' => 'alt',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));
        $this->setUpColumn(
                array(
                    'name' => 'title',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));
        
        array_unshift($this->render_fields, 'title');
        array_unshift($this->render_fields, 'alt');
        array_unshift($this->render_fields, 'link');
        array_unshift($this->render_fields, 'path');
        
    }

}
