<?php

class DigitalSoluions extends SideMenu {

    var $namespace = 'digital_soluions';

    public function setUp() {
        parent::setUp();
        $this->setUpColumn(
                array(
                    'name' => 'url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_DIGITAL_SOLUTIONS),
        ));
    }

}
