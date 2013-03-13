<?php

class EducationalSolutions extends SideMenu {

    var $namespace = 'educational_solutions';

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
