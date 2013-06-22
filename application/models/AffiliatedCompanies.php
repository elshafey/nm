<?php

class AffiliatedCompanies extends AboutusPages {

    var $namespace = 'affiliated_companies';

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
                    'value' => new Urls(Urls::URL_PREFIX_AFFILIATED_COMPANIES),
        ));
        
        $this->render_fields=array('page_title','page_content','page_url','page_order','is_active');
    }

}
