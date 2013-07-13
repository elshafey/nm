<?php

class Parteners extends CMS {

    var $namespace = 'parteners';

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
                    'name' => 'type',
                    'outType' => 'select',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'select_list' => array(
                        array('id'=>'1',
                            'name' => lang($this->namespace . '_content')),
                        array(
                            'id'=>'2',
                            'name' => lang($this->namespace . '_business'))
                    ),
                    'select_txt_field' => 'name',
                    'value'=>''
                )
        );
        $this->setUpColumn(
                array(
                    'name' => 'name',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'multi' => true,
                    'value' => $value,
        ));

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

        $this->setUpColumn(array(
            'name' => 'description',
            'outType' => 'textarea',
            'validation' => 'required|xss_clean',
            'required' => true,
            'multi' => true,
            'value' => $value,
        ));
        array_unshift($this->render_fields, 'title');
        array_unshift($this->render_fields, 'alt');
        array_unshift($this->render_fields, 'path');
        array_unshift($this->render_fields, 'type');
        array_unshift($this->render_fields, 'description');
        array_unshift($this->render_fields, 'name');
    }

}
