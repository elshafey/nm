<?php

class Careers extends CMS {

    var $namespace = 'careers';

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
                    'name' => 'job_code',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));
        $this->setUpColumn(
                array(
                    'name' => 'job_title',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'multi' => true,
                    'value' => $value,
        ));
        $this->setUpColumn(
                array(
                    'name' => 'job_description',
                    'validation' => 'required',
                    'required' => true,
                    'outType' => 'content',
                    'multi' => true,
                    'value' => $value,
        ));
        $this->setUpColumn(
                array(
                    'name' => 'job_url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_CAREERS_DETAILS),
        ));

        array_unshift($this->render_fields, 'job_url');
        array_unshift($this->render_fields, 'job_description');
        array_unshift($this->render_fields, 'job_title');
        array_unshift($this->render_fields, 'job_code');
    }

}
