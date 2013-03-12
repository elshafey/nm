<?php

class Users extends CMS {

    var $namespace = 'users';

    public function __construct($id = null) {
        parent::__construct($id);
//        pre_print($this);
    }
    
    public function setUp() {
        parent::setUp();
        
        $this->setUpColumn(
                array(
                    'name' => 'name',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));
        
        $this->setUpColumn(
                array(
                    'name' => 'username',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'textbox',
                    'value' => '',
        ));
        
        $this->setUpColumn(
                array(
                    'name' => 'password',
                    'validation' => 'required|xss_clean',
                    'required' => true,
                    'outType' => 'password',
                    'value' => '',
        ));
        
        $this->render_fields=array('name','username','password','is_active');
        
    }

    

}
