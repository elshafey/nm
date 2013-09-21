<?php

class Events extends News {

    var $namespace = 'events';

    public function __construct($id = null) {
        parent::__construct($id);
//        pre_print($this);
    }

    public function setUp() {
        parent::setUp();
        
        $this->setUpColumn(
                array(
                    'name' => 'page_url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_EVENT_DETAILS),
        ));
        
        $this->render_fields=array('page_title','page_content','pdf','img','img_alt','img_title','page_url','page_order','is_active');
    }

}
