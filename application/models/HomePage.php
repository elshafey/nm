<?php

class HomePage extends StaticPages {

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
                    'name' => 'page_title',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'multi' => true,
                    'value' => $value,
        ));
        $this->setUpColumn(
                array(
                    'name' => 'page_content',
                    'validation' => 'required',
                    'required' => true,
                    'outType' => 'content',
                    'multi' => true,
                    'value' => $value,
        ));
        
        $this->setUpColumn(
                array(
                    'name' => 'type',
                    'validation' => 'required',
                    'outType' => 'hidden',
                    'value' => '',
        ));
        
        $this->setUpColumn(
                array(
                    'name' => 'video_image',
                    'validation' => 'required|xss_clean',
                    'required' => false,
                    'outType' => 'img_uploader',
                    'value' => '',
        ));
        
        $this->setUpColumn(
                array(
                    'name' => 'video_path',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));
        
        
        $this->setUpColumn(
                array(
                    'name' => 'side_banner',
                    'validation' => 'required|xss_clean',
                    'required' => false,
                    'outType' => 'img_uploader',
                    'value' => '',
        ));
        
        
        $this->setUpColumn(
                array(
                    'name' => 'ajax_banner',
                    'validation' => 'required|xss_clean',
                    'required' => false,
                    'outType' => 'img_uploader',
                    'value' => '',
        ));
        
        array_unshift($this->render_fields, 'video_image');
        array_unshift($this->render_fields, 'video_path');
        array_unshift($this->render_fields, 'page_content');
        array_unshift($this->render_fields, 'page_title');
        
        
    }

}
