<?php

class Portfolios extends CMS {

    var $namespace = 'portfolios';

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
                    'name' => 'page_url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_PORTFOLIO_DETAILS),
        ));
        array_unshift($this->render_fields, 'page_url');
        array_unshift($this->render_fields, 'img_title');
        array_unshift($this->render_fields, 'img_alt');
        array_unshift($this->render_fields, 'img');
        array_unshift($this->render_fields, 'page_content');
        array_unshift($this->render_fields, 'page_title');
        
        
    }

}
