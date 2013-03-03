<?php

class PublishingSoluions extends SideMenu {

    var $namespace = 'publishing_soluions';

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
