<?php

class News extends CMS {

    var $namespace = 'news';

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
                    'name' => 'img',
                    'validation' => 'required|xss_clean',
                    'required' => false,
                    'outType' => 'img_uploader',
                    'value' => '',
        ));
        
        $this->setUpColumn(
                array(
                    'name' => 'pdf',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'file_uploader',
                    'multi' => true,
                    'value' => $value,
        ));
        
        $this->setUpColumn(
                array(
                    'name' => 'img_alt',
                    'validation' => 'xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));
        $this->setUpColumn(
                array(
                    'name' => 'img_title',
                    'validation' => 'xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));
        $this->setUpColumn(
                array(
                    'name' => 'page_url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_NEWS_DETAILS),
        ));
        
        
        $this->setUpColumn(
                array(
                    'name' => 'is_home',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'checkbox',
                    'value' => '',
        ));
        
        
        
        $this->render_fields=array('page_title','page_content','pdf','img','img_alt','img_title','page_url','page_order','is_home','is_active');
    }

}
