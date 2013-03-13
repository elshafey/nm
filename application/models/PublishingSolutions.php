<?php

class PublishingSolutions extends SideMenu {

    var $namespace = 'publishing_solutions';

    public function setUp() {
        parent::setUp();
        $this->setUpColumn(
                array(
                    'name' => 'url',
                    'outType' => 'url',
                    'value' => new Urls(Urls::URL_PREFIX_PUBLISHING_SOLUTIONS),
        ));
    }

}
