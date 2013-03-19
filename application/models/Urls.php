<?php

/**
 * @property $routed 
 * @property $url_prefix 
 * @property meta_title 
 * @property meta_keywords 
 * @property meta_description 
 */
class Urls extends CMS {

    var $namespace = 'url';

    const URL_PREFIX_ABOUTUS_PAGE       = 'home/aboutus/';
    const URL_PREFIX_ABOUTUS            = 'home/aboutus/';
    const URL_PREFIX_BOOK               = 'home/preview_book/';
    const URL_PREFIX_BOOK_CATEGORY      = 'home/view_category/';
    const URL_PREFIX_BOOK_SUBCATEGORY   = 'home/view_subcategory/';
    const URL_PREFIX_NEWS_DETAILS       = 'home/news_details/';
    const URL_PREFIX_EVENT_DETAILS      = 'home/event_details/';
    const URL_PREFIX_PRESS_DETAILS      = 'home/press_details/';
    const URL_PREFIX_HOME_PAGE          = 'home/index/';
    const URL_PREFIX_NEWS_LIST          = 'home/news/';
    const URL_PREFIX_EVENTS_LIST        = 'home/events/';
    const URL_PREFIX_PRESS_LIST         = 'home/press/';
    const URL_PREFIX_PORTFOLIO_DETAILS  = 'home/portfolio_details/';
    const URL_PREFIX_PORTFOLIO          = 'home/portfolio/';
    const URL_PREFIX_PARTNERS          = 'home/partners/';
    const URL_PREFIX_CAREERS            = 'home/careers/';
    const URL_PREFIX_CAREERS_DETAILS    = 'home/career_details/';
    const URL_PREFIX_DOWNLOADS          = 'home/downloads/';
    const URL_PREFIX_FAQS               = 'home/faqs/';
    const URL_PREFIX_ACHIEVEMENTS       = 'home/achievements/';
    const URL_PREFIX_PUBLISHING_SOLUTIONS       = 'home/publishing_solutions/';
    const URL_PREFIX_DIGITAL_SOLUTIONS       = 'home/digital_solutions/';
    const URL_PREFIX_EDUCATIONAL_SOLUTIONS       = 'home/educational_solutions/';
    const URL_PREFIX_CUSTOM_SOLUTIONS    = 'home/custom_solutions/';
    const URL_PREFIX_CONTACT_US       = 'home/contact_us/';
    
    public function __construct($url_prefix = null) {
        $this->url_prefix = $url_prefix;
        $this->routed = $url_prefix;
        parent::__construct();
    }

    protected function setUp() {
        parent::setUp();
        $this->setUpColumn(array(
            'name' => 'routed',
            'outType' => 'textbox',
            'validation' => 'required|uniqe_url[%s]|valid_url_segment|xss_clean',
            'required' => true,
        ));
        $this->setUpColumn(array(
            'name' => 'meta_title',
            'outType' => 'textbox',
            'validation' => 'xss_clean',
            'value' => '',
        ));
        $this->setUpColumn(array(
            'name' => 'meta_keywords',
            'outType' => 'textbox',
            'validation' => 'xss_clean',
            'value' => '',
        ));
        $this->setUpColumn(array(
            'name' => 'meta_description',
            'outType' => 'textarea',
            'validation' => 'xss_clean',
            'value' => '',
        ));
        $this->setUpColumn(array(
            'name' => 'url_prefix',
            'outType' => 'content',
            'validation' => 'xss_clean',
        ));
        $this->render_fields=array('routed','meta_title','meta_keywords','meta_description');
        unset($this->columns['page_order']);
        unset($this->columns['is_active']);
    }

    protected function onFlush(\Entities\Pages &$page) {

        foreach ($page->getPages() as $value) {
            if ($value->getNamespace() == $this->namespace) {
                /* @var $url \Entities\Pages */
                $url = $value;
                break;
            }
        }
//        pre_print($url,false);
        if (trim($this->url_prefix, '/') == trim(trim($this->routed), '/')&&!$this->id) {
            /* @var $CI My_Controller */
            $CI = get_instance();
            foreach ($url->getPageDetails() as $field) {
                if ($field->getName() == 'routed') {
                    /* @var $routed \Entities\PageDetails */
                    $routed = $field;
                    $routed->setValue($this->url_prefix . $routed->getPages()->getParent()->getId());
                    $CI->doctrine->em->persist($routed);
                    continue;
                }
                if ($field->getName() == 'url_prefix') {
                    /* @var $url_prefix \Entities\PageDetails */
                    $url_prefix = $field;
                    $url_prefix->setValue($this->url_prefix . $url_prefix->getPages()->getParent()->getId());
                    $CI->doctrine->em->persist($url_prefix);
                    continue;
                }
            }

            $CI->doctrine->em->flush();
        }
        save_url();
    }

}
