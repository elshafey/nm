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
    }

}
