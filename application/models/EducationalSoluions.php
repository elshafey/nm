<?php

class EducationalSoluions extends SideMenu {

    var $namespace = 'educational_soluions';

    public function setUp() {
        parent::setUp();
        $this->setUpColumn(
                array(
                    'name' => 'url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_EDUCATIONAL_SOLUTIONS),
        ));
    }

}
