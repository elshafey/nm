<?php

class CustomSolutions extends SideMenu {

    var $namespace = 'custom_solutions';

    public function setUp() {
        parent::setUp();
        $this->setUpColumn(
                array(
                    'name' => 'url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_CUSTOM_SOLUTIONS),
        ));
    }

}
