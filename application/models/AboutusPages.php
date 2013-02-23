<?php

class AboutusPages extends CMS {

    var $namespace = 'aboutus';

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
                    'name' => 'page_url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_ABOUTUS_PAGE),
        ));
        $this->setUpColumn(
                array(
                    'name' => 'is_home',
                    'validation' => 'xss_clean',
                    'required' => false,
                    'outType' => 'checkbox',
                    'value' => '',
                )
        );
        array_unshift($this->render_fields, 'is_home');
        array_unshift($this->render_fields, 'page_title');
        array_unshift($this->render_fields, 'page_content');
        array_unshift($this->render_fields, 'page_url');
    }

}
