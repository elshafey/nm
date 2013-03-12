<?php

/**
 * @property $routed 
 * @property $url_prefix 
 * @property meta_title 
 * @property meta_keywords 
 * @property meta_description 
 */
class StaticUrls extends Urls {
    
    public function __construct($url_prefix = null) {
        /* @var $CI My_Controller */
        $CI=  get_instance();
        if($CI->uri->segment(2)=='home'){
            $url_prefix=  self::URL_PREFIX_HOME_PAGE;
        }elseif(isset ($CI->url_prefix)){
            $url_prefix=$CI->url_prefix;
        }
        parent::__construct($url_prefix);
    }
    
    function setUp() {
//        array_unshift($this->render_fields, 'img');
//        array_unshift($this->render_fields, 'img_alt');
//        array_unshift($this->render_fields, 'img_title');
        parent::setUp();
//        $this->setUpColumn(
//                array(
//                    'name' => 'img_alt',
//                    'validation' => 'required|xss_clean',
//                    'required' => true,
//                    'outType' => 'textbox',
//                    'value' => '',
//        ));
//
//        $this->setUpColumn(
//                array(
//                    'name' => 'img_title',
//                    'validation' => 'required|xss_clean',
//                    'required' => true,
//                    'outType' => 'textbox',
//                    'value' => '',
//        ));
//        
//        $this->setUpColumn(
//                array(
//                    'name' => 'img',
//                    'validation' => 'required|xss_clean',
//                    'required' => false,
//                    'outType' => 'img_uploader',
//                    'value' => '',
//        ));
        
        
    }


    protected function onFlush(\Entities\Pages &$page) {
        save_url();
    }

}
