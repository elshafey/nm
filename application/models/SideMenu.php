<?php

class SideMenu extends CMS {

    var $namespace = '';

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
                    'name' => 'name',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'multi' => true,
                    'outType' => 'textbox',
                    'value' => $value,
        ));
        $this->setUpColumn(
                array(
                    'name' => 'title',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'multi' => true,
                    'outType' => 'textbox',
                    'value' => $value,
        ));
        $this->setUpColumn(
                array(
                    'name' => 'content',
                    'validation' => 'required',
                    'required' => true,
                    'outType' => 'content',
                    'multi' => true,
                    'value' => $value,
        ));

        array_unshift($this->render_fields, 'url');
        array_unshift($this->render_fields, 'content');
        array_unshift($this->render_fields, 'title');
        array_unshift($this->render_fields, 'name');
    }

}
